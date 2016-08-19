<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Systemconfig;
use common\components\Myhelpers;
use common\models\Album;
use common\models\Gallery;
use common\models\ProductGallery;


/**
 * ToolController implements the CRUD actions for Test model.
 */
class ToolController extends AController
{
	// $enableCsrfValidation test
	public $enableCsrfValidation = false;
	
	/**
	 * tool index
	 * @return mixed
	 */
	public function actionIndex(){
		return $this->render('index');
	}

	/**
	 * 上传到upyun，极简模式，可用于弹窗
	 * @return [type] [description]
	 */
	public function actionUploadupyun(){
		require_once(Yii::getAlias('@common').'/components/upyun_form/upyun.class.php');
		$upyun_config = Systemconfig::getConfigValue('upyun');

		$bucket = $upyun_config['upyun_bucket'];
		$form_api_secret = $upyun_config['upyun_ form_api_secret'];; /// 表单 API 功能的密匙
		$upload_dir = $upyun_config['upyun_upload_dir'];

		//print_r($upyun_config);exit;
		$upyun = new \UpYun($bucket, $form_api_secret, null);

		$opts = array();
		// 必选参数
		$opts['save-key'] = $upload_dir.'/{year}/{mon}/{day}/{random}{.suffix}';   // 保存路径
		$opts['return-url'] = Yii::$app->request->hostInfo.'/tool/uploadupyun';
		$upload_field = '';
		$upload_field = Yii::$app->request->get('upload_field');
		if($upload_field){
			$opts['return-url'] .= '?upload_field='.$upload_field;
		}
		// 以下参数均为可选
		/*
		$opts['allow-file-type'] = '';   // 文件类型限制，如：jpg,gif,png
		$opts['content-length-range'] = '';  // 文件大小限制，如：102400,1024000 单位：Bytes
		$opts['content-md5'] = '';  // 文件校验码（根据上传文件的内容进行 md5 校验后得到的数值），如：202cb962ac59075b964b07152d234b70
		$opts['content-secret'] = '';   //原图访问密钥，如：abc
		$opts['content-type'] = ''; // 指定文件类型，如：image/jpeg
		$opts['image-width-range'] = '';  // 图片宽度限制，如：0,1024 单位：像素
		$opts['image-height-range'] = ''; // 图片高度限制，如：0,1024 单位：像素
		$opts['notify-url'] = '';   // 异步回调 url，如：http://img.helloword.com/notify.php
		$opts['return-url'] = 'http://localhost/return.php';    // 同步跳转 url，如：http://localhost/return.php
		$opts['x-gmkerl-thumbnail'] = '';   // 缩略图版本名称，如：small
		$opts['x-gmkerl-type'] = '';    // 缩略类型，如：fix_max
		$opts['x-gmkerl-value'] = '';    // 缩略类型对应的参数值，根据缩略类型填写
		$opts['x-gmkerl-quality'] = ''; // 缩略图质量，0~100，推荐 65~75
		$opts['x-gmkerl-unsharp'] = ''; // 图片锐化，默认 true
		$opts['x-gmkerl-rotate'] = '';  // 图片旋转，参数：auto 90 180 或 270
		$opts['x-gmkerl-crop'] = '';    // 图片裁剪，格式：x,y,width,height
		$opts['x-gmkerl-exif-switch'] = ''; // 是否保留 exif 信息，参数：true
		$opts['ext-param'] = '';    // 额外参数
		 */

		$policy = $upyun->policyCreate($opts);
		$sign = $upyun->signCreate($opts);
		$action = $upyun->action();
		$version = $upyun->version();
	
		$img_url = strip_tags(Yii::$app->request->get('url'));
		if ($img_url) {
			$img_url = $upyun_config['upyun_http_domain'].'/'.$img_url;
		}

		return $this->renderPartial('uploadupyun',[
			'policy' => $policy,
			'sign' => $sign,
			'action' => $action,
			'img_url' => $img_url,
			'upload_field' => $upload_field,
		]);		
	}

	/**
	 * umeditor  配合upyun 改造上传文件
	 * @return [type] [description]
	 */
	public function actionUmfile(){
        $file = $_FILES['upfile'];
        if (preg_match('#jpeg#i', $file['type'])) {
            $type = '.jpg';
        } elseif (preg_match('#png#i', $file['type'])) {
            $type = '.png';
        } else {
            $type = '.jpg';
        }

        //上传到又拍云
        $url = Myhelpers::upload2upy($file);

        $file_name = md5($file['tmp_name']);
        $upyun_config = Systemconfig::getConfigValue('upyun');

        $info = array(
            'originalName'=>$file['name'],
            'name'=>$file_name.$type,
            'url'=>$url,
            'size'=>$file['size'],
            'type'=>$type,
            'state'=>'SUCCESS',
        );  
        echo json_encode($info);
        Yii::$app->end();
	}


	/**
	 * 上传相册照片
	 * @return [type] [description]
	 */
	public function actionAlum(){
		$file = $_FILES['files'];
		//print_r($file);exit;
        if (preg_match('#jpeg#i', $file['type']['0'])) {
            $type = '.jpg';
        } elseif (preg_match('#png#i', $file['type']['0'])) {
            $type = '.png';
        } else {
            $type = '.jpg';
        }

        //上传到又拍云,将文件重新组合到又拍云
        $file1 = [
        	'name' => $file['name']['0'],
        	'type' => $file['type']['0'],
        	'tmp_name' => $file['tmp_name']['0'],
        	'error' => $file['error']['0'],
        	'size' => $file['size']['0'],
        ];
        $url = Myhelpers::upload2upy($file1);

        $file_name = md5($file['tmp_name']['0']);
        $upyun_config = Systemconfig::getConfigValue('upyun');



		$files = [
			[	'name' => $file['name']['0'],
				'size' => $file['size']['0'],
				'url' => $url,
				'thumbnailUrl' => $url.'!s100',
				'deleteUrl' => $url,
				'deleteType' => 'DELETE',
			],
			// [	'name' => 'picture1.jpg',
			// 	'size' => 902604,
			// 	'url' => 'http://imgffeeii.b0.upaiyun.com/file/2016/04/6.jpg',
			// 	'thumbnailUrl' => 'http://imgffeeii.b0.upaiyun.com/file/2016/04/6.jpg!s100',
			// 	'deleteUrl' => 'http://imgffeeii.b0.upaiyun.com/file/2016/04/6.jpg',
			// 	'deleteType' => 'DELETE',
			// ],
		];
		$arr = [];
		$arr['files'] = $files;
		echo json_encode($arr);

		$id = Yii::$app->request->get('id');

		$use = Yii::$app->request->get('use');
		
		$time = date("Y-m-d H:i:s");

		if ($id) {
			if($use == 1){
				$pro = new ProductGallery();
				$pro->img_url = $url;
				$pro->product_id = $id;
				$pro->create_at = $time;
				$pro->update_at = $time;
				$pro->save();
			}else{
				$gallery = new Gallery();
				$gallery->img_url = $url;
				$gallery->album_id = $id;
				$gallery->create_at = $time;
				$gallery->update_at = $time;
				$gallery->save();
			}
		}
		

		Yii::$app->end();

	}


	/**
	 * 清除缓存
	 * @return [type] [description]
	 */
	public function actionClear(){
		Yii::$app->cache->flush();
	}
}