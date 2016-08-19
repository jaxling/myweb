<?php
namespace common\components;

use Yii;

use common\models;
use common\models\Systemconfig;

use yii\helpers\FileHelper;
use common\components\Helpercurl;


/**
 * 自定义助手,建议系统各个实现的功能放在此目录下面
 * lifei
 */
class Myhelpers {
	
	/**
	 * form上传文件到又拍云
	 */
    public static function upload2upy($file){
        //上传到又拍云
        $upyun_config = Systemconfig::getConfigValue('upyun');
        if (empty($upyun_config)) {
            echo '又拍云配制为空';exit;
        }
        require_once dirname(__DIR__).'/components/upyun/upyun.class.php';
        $upyun = new \UpYun($upyun_config['upyun_bucket'], $upyun_config['upyun_username'], $upyun_config['upyun_password']);

        //$fh = fopen('umeditor/php/upload/20150513/14315295316921.png', 'rb');
        //$fh = file_get_contents($file['tmp_name']);


        $type = getFileType($file['type']);

        $file_name = md5($file['tmp_name']);
        $url = '/'.$upyun_config['upyun_upload_dir'].date('/Y/m/').$file_name.$type;
        $rsp = $upyun->writeFile($url, file_get_contents($file['tmp_name']),true);   // 上传图片，自动创建目录

        return $upyun_config['upyun_http_domain'].$url;
    }


    /**
     *  @DESC 非表单上传至又拍云
     *  file_content_type 1链接或者文件名   2文件流
     */
    public static function nFormUpload2upy ($fileUrl, $type = '.jpg', $file_content_type = 1)
    {
        //上传到又拍云
        $upyun_config = Systemconfig::getConfigValue('upyun');
        if (empty($upyun_config)) {
            echo '又拍云配制为空';exit;
        }
        require_once dirname(__DIR__).'/components/upyun/upyun.class.php';
        $upyun = new \UpYun($upyun_config['upyun_bucket'], $upyun_config['upyun_username'], $upyun_config['upyun_password']);

        $file_name=md5($fileUrl.time());
        $url = '/'.$upyun_config['upyun_upload_dir'].date('/Y/m/').$file_name.$type;
        //链接或者文件名
        if ($file_content_type == 1) {
            $rsp = $upyun->writeFile($url, file_get_contents($fileUrl),true);
        }
        //文件流
        if ($file_content_type == 2) {
            $rsp = $upyun->writeFile($url, $fileUrl,true);
        }       
        return $upyun_config['upyun_http_domain'].$url;
    }


    /**
     *  @description 新版ID生成器存储过程
     *  @$business_type 各业务类型ID
     */
    public static function getOrderID($type)
    {
        if(empty($type) || !in_array($type, array(10, 20, 30, 31, 32, 33, 40, 50, 60, 70, 80, 90))) return false;
        //也可以利用redis创建队列
        //采用mysql 存储过程
        /*
        $command = Yii::app()->db->createCommand('call P_GEN_ID(' . $type . ',@orderId)')->execute();
        $rs = Yii::app()->db->createCommand('select @orderId')->queryRow();
        return $rs['@orderId'];
         */
        //mysql 表锁
        $db = Yii::$app->db;
        $sql = "REPLACE INTO id_{$type}(stub) VALUES(1)";
        $flag = $db->createCommand($sql)->execute();
        $id = $db->getLastInsertID();
        //组合业务id
        $idFormat = sprintf("%06d", $id);
        $orderID = $type . date('ymd') . $idFormat;

        return $orderID;
    }

    /**
     * client ip
     **/
    public static function getClientIP()
    {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    }

}