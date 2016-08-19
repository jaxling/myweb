<?php

namespace console\controllers;

use Yii;
use common\components\Myhelpers;
use common\components\Helpercurl;
use common\models;

class HsController extends \yii\console\Controller
{




	public $enableCsrfValidation = false;  //必须加上此选项

	/**
	 * [actionIndex description]
	 * @return [type] [description]
	 */
    public function actionIndex()
    {
    	$db = Yii::$app->db;
    	$file = dirname(__FILE__).'/hs.html';
    	$content = file_get_contents($file);
    	$pattern = '#openHscodeById\(\'(.*?)\'\)">(.*?)</a>#i';
    	preg_match_all($pattern, $content, $matches ,PREG_SET_ORDER);
    	//print_r($matches);
    	foreach ($matches as $key => $value) {
    		$hs_id = $value['1'];
    		$hs_code = $value['2'];
    		$create_at = $update_at =  date('Y-m-d H:i:s', time());
    		$sql = "INSERT INTO hs_id (hs_id,hs_code,create_at,update_at) 
    			VALUES('$hs_id','$hs_code','$create_at','$update_at')";
    		//echo $sql;exit;
    		$db->createCommand($sql)->execute();
    		echo $value['1']."\n";
    	}
        return 1;
    }

    public function actionIndex1() {
    	$db = Yii::$app->db;
    	$sql = "SELECT * FROM hs_id where content ='' ";
    	$list = $db->createCommand($sql)->queryAll();
    	$helpercurl = new Helpercurl();
    	foreach ($list as $key => $value) {
    		$id = $value['id'];
    		$hs_id = $value['hs_id'];
    		$url = 'http://front.i-tong.cn/weixin/tariffDetail.do?tariffId='.$hs_id.'&openId=ozu3ujgDCvOuRHsdexHZ36z8i1YU&at=eyJ0aW1lIjoiMTQ2Mjk4NDU1OTM4MCIsImFjY2Vzc1Rva2VuIjoiMmRmNTYzYTk0MzA5ZjA1MzU3%0AMGYwZWIwNTNmNDAwYzkifQ%3D%3D';
    		$response = $helpercurl->get($url);
    		$html = $response->body;
    		if(preg_match('#链接已过期#', $html)) {
    			echo $id;exit;
    		}
    		$html = str_replace("'", "\'", $html);
    		$sql = "UPDATE hs_id set content='$html' WHERE id=$id";
    		if($db->createCommand($sql)->execute()) {

    		} else {
    			echo $id." faild \n";
    		}
    		//exit;
    	}
    }

/*
  `unit` varchar(20) NOT NULL COMMENT '计量单位',
  `supervision_conditions` char(30) NOT NULL COMMENT '海关监管条件',
  `quarantine_category` char(30) NOT NULL COMMENT '检验检疫类别',
  `product_name` varchar(50) NOT NULL COMMENT '商品名称',
  `product_name_en` varchar(100) NOT NULL COMMENT '商品英文名称',
  `declaration_element` varchar(100) NOT NULL COMMENT '申报要素',
  `price_declaration_element` varchar(100) NOT NULL COMMENT '价格申报要素',
  `check_declaration_element` varchar(100) NOT NULL COMMENT '审单及其他申报要素',
  `des_declaration_element` varchar(100) NOT NULL COMMENT '申报要素说明举例',
  `ex_declaration_element` varchar(255) NOT NULL COMMENT '申报要素范例',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `import_mfn_rate` decimal(10,2) NOT NULL COMMENT '最惠国税率(%)',
  `import_general_rate` decimal(10,2) NOT NULL COMMENT '普通税率(%)',
  `import_tentative_rate` decimal(10,2) NOT NULL COMMENT '暂定税率(%)',
  `import_increase_rate` decimal(10,2) NOT NULL COMMENT '增值税率(%)',
  `import_other` text NOT NULL COMMENT '进口通关其它',
  `import_remakr` text NOT NULL COMMENT '进口通关备注',
  `export_hscode` varchar(30) NOT NULL COMMENT '出口-hs编码',
  `export_produc_name` varchar(5) NOT NULL COMMENT '出口商品名称',
  `export_rebate_rate` decimal(10,2) NOT NULL COMMENT '出口退税率(%)',
  `export_tax_rate` decimal(10,2) NOT NULL COMMENT '出口关税税率(%)',
  `export_tentative_rate` decimal(10,2) NOT NULL COMMENT '出口暂定税率(%)',
  `export_spc_rate` decimal(10,2) NOT NULL COMMENT '出口特别关税税率(%)',
  `export_increase_rate` decimal(10,2) NOT NULL COMMENT '增值税率(%)',
  `export_remark` text NOT NULL COMMENT '出口-备注',
  `check_card` varchar(30) NOT NULL COMMENT '报检特殊单证',
  `check_rate` varchar(50) NOT NULL COMMENT '进口报检详细-费率',
  `check_free` text NOT NULL COMMENT '进口报检详细-计费说明',
  `check_remark` text NOT NULL COMMENT '进口报检详细-备注',
 */

/**
 * [hs_id 表更新数据]
 * @return [type] [description]
 */
    public function actionHsid() {
    	$db = Yii::$app->db;
    	for ($i=0; $i < 2000; $i++) { 
    		// $sql = "SELECT * FROM hs_id where hs_code NOT IN 
    		// 	(SELECT hs_code FROM  hs_code )  order by id asc LIMIT 10";
            $start = $i*50;     
            $sql = "SELECT * FROM hs_id where hs_code   order by id asc LIMIT $start,50";

    		$list = $db->createCommand($sql)->queryAll();
    		if(empty($list)) break;

    		foreach ($list as $k => $v) {
    			$hs_code = $v['hs_code'];
    			$content  = $v['content'];
    			preg_match('#计量单位</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$unit = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#海关监管条件</td>.+?getSupervisionDetail.+?>(.*?)</a>#sui', $content, $m);
    			$supervision_conditions = isset($m['1']) ? trim(str2($m['1'])) : '';
    			preg_match('#检验检疫类别</td>.+?getCiqsDetail.+?>(.*?)</a>#sui', $content, $m);
    			$quarantine_category = isset($m['1']) ? trim(str2($m['1'])) : '';

    			preg_match('#商品名称</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$product_name = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#商品英文名称</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$product_name_en = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#申报要素</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$declaration_element = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#价格申报要素</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$price_declaration_element = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#审单及其他申报要素</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$check_declaration_element = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#申报要素说明举例</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$des_declaration_element = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#申报要素范例</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$ex_declaration_element = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#备注</td>.+?colspan="3">(.*?)</td>#sui', $content, $m);
    			$remark = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#最惠国税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$import_mfn_rate = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#普通税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$import_general_rate = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#暂定税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$import_tentative_rate = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#增值税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$import_increase_rate = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#<td class="labelwhite">其他</td>.+?>(.*?)</td>#sui', $content, $m);
    			$import_other = isset($m['1']) ? strip_tags($m['1']) : '';
    			preg_match('#增值税率.+?<td class="labelwhite">备注</td>.+?>(.*?)</td>#sui', $content, $m);
    			$import_remakr = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#<td class="labelwhite">HS编码</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_hscode = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#出口通关.+?<td class="labelwhite">商品名称</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_produc_name = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#出口退税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_rebate_rate = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#出口关税税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_tax_rate = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#出口暂定税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_tentative_rate = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#出口特别关税税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_spc_rate = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#出口通关.+?增值税率\(%\)</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_increase_rate = isset($m['1']) ? str2($m['1']) : '';
    			preg_match('#出口通关.+?class="labelwhite">备注</td>.+?>(.*?)</td>#sui', $content, $m);
    			$export_remark = isset($m['1']) ? str2($m['1']) : '';

    			preg_match('#报检特殊单证</td>.+?getDocumentsDetail.+?>(.*?)</a>#sui', $content, $m);
    			$check_card = isset($m['1']) ? trim(str2($m['1'])) : '';
    			preg_match('#进口报检详细.+?费率</td>.+?>(.*?)</td>#sui', $content, $m);
    			$check_rate = isset($m['1']) ? trim(str2($m['1'])) : '';
    			preg_match('#进口报检详细.+?计费说明</td>.+?>(.*?)</td>#sui', $content, $m);
    			$check_free = isset($m['1']) ? trim(str2($m['1'])) : '';
    			preg_match('#进口报检详细.+?class="labelwhite">备注</td>.+?>(.*?)</td>#sui', $content, $m);
    			$check_remark = isset($m['1']) ? trim(str2($m['1'])) : '';
    			


    			echo " hs code:".$hs_code."\n";
    			// echo " unit:".$unit." supervision_conditions:".$supervision_conditions.
    			// 	" quarantine_category:".$quarantine_category." product_name:".$product_name.
    			// 	" product_name_en:".$product_name_en." declaration_element:".$declaration_element.
    			// 	" price_declaration_element:".$price_declaration_element." check_declaration_element:".$check_declaration_element.
    			// 	" des_declaration_element:".$des_declaration_element." ex_declaration_element:".$ex_declaration_element.
    			// 	" remark:".$remark.

    			// 	" import_mfn_rate:".$import_mfn_rate." import_general_rate:".$import_general_rate.
    			// 	" import_tentative_rate:".$import_tentative_rate." import_increase_rate:".$import_increase_rate.
    			// 	" import_other:".$import_other." import_remakr:".$import_remakr.

    			// 	" export_hscode:".$export_hscode." export_produc_name:".$export_produc_name.
    			// 	" export_rebate_rate:".$export_rebate_rate." export_tax_rate:".$export_tax_rate.
    			// 	" export_tentative_rate:".$export_tentative_rate." export_spc_rate:".$export_spc_rate.
    			// 	" export_increase_rate:".$export_increase_rate." export_remark:".$export_remark.

    			// 	" check_card:".$check_card." check_rate:".$check_rate.
    			// 	" check_free:".$check_free." check_remark:".$check_remark.
    			// "\n\n";


    			$sql = "SELECT hs_code FROM hs_code WHERE hs_code='$hs_code'";
    			$exist = $db->createCommand($sql)->queryScalar();
    			if($exist) {
    				$sql = "UPDATE hs_code set 
    				unit='$unit',supervision_conditions='$supervision_conditions',
    				quarantine_category='$quarantine_category',product_name='$product_name',
    				product_name_en='$product_name_en',declaration_element='$declaration_element',
    				price_declaration_element='$price_declaration_element',check_declaration_element='$check_declaration_element',
    				des_declaration_element='$des_declaration_element',ex_declaration_element='$ex_declaration_element',
    				remark='$remark',

    				import_mfn_rate='$import_mfn_rate',import_general_rate='$import_general_rate',
    				import_tentative_rate='$import_tentative_rate',import_increase_rate='$import_increase_rate',
    				import_other='$import_other',import_remakr='$import_remakr',

    				export_hscode='$export_hscode',export_produc_name='$export_produc_name',
    				export_rebate_rate='$export_rebate_rate',export_tax_rate='$export_tax_rate',
    				export_tentative_rate='$export_tentative_rate',export_spc_rate='$export_spc_rate',
    				export_increase_rate='$export_increase_rate',export_remark='$export_remark',

    				check_card='$check_card',check_rate='$check_rate',
    				check_free='$check_free',check_remark='$check_remark'

    				WHERE hs_code='$hs_code'";
    				$db->createCommand($sql)->execute();
    			} else {
    				$sql = "INSERT INTO hs_code set 
    				unit='$unit',supervision_conditions='$supervision_conditions',
    				quarantine_category='$quarantine_category',product_name='$product_name',
    				product_name_en='$product_name_en',declaration_element='$declaration_element',
    				price_declaration_element='$price_declaration_element',check_declaration_element='$check_declaration_element',
    				des_declaration_element='$des_declaration_element',ex_declaration_element='$ex_declaration_element',
    				remark='$remark',

    				import_mfn_rate='$import_mfn_rate',import_general_rate='$import_general_rate',
    				import_tentative_rate='$import_tentative_rate',import_increase_rate='$import_increase_rate',
    				import_other='$import_other',import_remakr='$import_remakr',

    				export_hscode='$export_hscode',export_produc_name='$export_produc_name',
    				export_rebate_rate='$export_rebate_rate',export_tax_rate='$export_tax_rate',
    				export_tentative_rate='$export_tentative_rate',export_spc_rate='$export_spc_rate',
    				export_increase_rate='$export_increase_rate',export_remark='$export_remark',

    				check_card='$check_card',check_rate='$check_rate',
    				check_free='$check_free',check_remark='$check_remark',
    				hs_code='$hs_code'";
    				$db->createCommand($sql)->execute();
    			}
    		}
    		//exit;

    	}

    }
    /**
     * 子目
     * @return [type] [description]
     */
    public function actionZimu(){
    	$file = '/tmp/zimu_1.txt';
    	$db = Yii::$app->db;
    	$url = 'http://www.customs.gov.cn/tabid/67736/default.aspx';
		$helpercurl = new Helpercurl();
		$ip = rand_ip();
		$helpercurl->headers = array(
		    'CLIENT-IP' => $ip,
		    'X-FORWARDED-FOR' => $ip,
		);
		$response = $helpercurl->get($url); 
		$html = $html1 = $response->body;
		// file_put_contents($file, $html);
		// $html = $html1  = file_get_contents($file);
		// exit;

		//获取hidden值 
		$pattern = '#type="hidden".+?name="(.+?)".+?value="(.*?)"#i';
		preg_match_all($pattern, $html1, $m_p,PREG_SET_ORDER);
		$data = [];
		if($m_p) {
			foreach ($m_p as $k1 => $m_p_v) {
				$key = $m_p_v['1'];
				$data[$key] = $m_p_v['2'];
			}
		}
		//print_r($data);exit;
    	
    	for ($p=1; $p <= 17; $p++) { 
    		sleep(10);

    		$data['ess$ctr182771$NativeDirectorySearch$gvSearch$ctl23$txtRd'] = $p;
    		$data['ess$ctr182771$NativeDirectorySearch$gvSearch$ctl23$btnRd'] = '跳转';
    		$response = $helpercurl->post($url,$data); 
			$html = $response->body;
			//$html = preg_replace("/<([a-zA-Z]+)[^>]*>/","<\\1>",$html);  //过滤属性
			//echo $html;exit;
			$pattern = '#<td>(.+?)</td><td>(.+?)</td><td align="center">.+?viewInfo\(\'(\d+)\'\)#sui';
			preg_match_all($pattern, $html, $m1, PREG_SET_ORDER);
			print_r($m1);exit;
			if($m1){
				echo 'page:'.$p;
				foreach ($m1 as $k1 => $v1) {

					$zimu = isset($v1['1']) ? str1($v1['1']) : '';
					$tiaowen = isset($v1['2']) ? str1($v1['2']) : '';

					$url = 'http://www.customs.gov.cn/tabid/67736/ctl/NDisplay/mid/182771/Default.aspx?ID='.$zimu;
					$response2 = $helpercurl->get($url); 

					$zhushi = isset($v1['3']) ? str1($v1['3']) : '';
					$content = isset($v1['4']) ? str1($v1['4']) : '';
					$create_at = $update_at =  date('Y-m-d H:i:s', time());
					$sql = "INSERT INTO ht_zimu(zimu,tiaowen,zhushi,content,create_at,update_at) VALUES
					('$zimu','$tiaowen','$zhushi','$content','$create_at','$update_at')";
					$db->createCommand($sql)->execute();
				}
				echo "ok \n";
			}
    	}    	
    }

    /**
     * 商品编码
     */
    public function actionBianma(){
    	$file = '/tmp/bianma_1.txt';
    	$db = Yii::$app->db;
    	$url = 'http://www.customs.gov.cn/tabid/67737/default.aspx';
		$helpercurl = new Helpercurl();
		$ip = rand_ip();
		$helpercurl->headers = array(
		    'CLIENT-IP' => $ip,
		    'X-FORWARDED-FOR' => $ip,
		);
		$response = $helpercurl->get($url); 
		$html = $html1 = $response->body;
		//file_put_contents($file, $html);
		//$html = $html1  = file_get_contents($file);

		//获取hidden值 
		$pattern = '#type="hidden".+?name="(.+?)".+?value="(.*?)"#i';
		preg_match_all($pattern, $html1, $m_p,PREG_SET_ORDER);
		$data = [];
		if($m_p) {
			foreach ($m_p as $k1 => $m_p_v) {
				$key = $m_p_v['1'];
				$data[$key] = $m_p_v['2'];
			}
		}
		//print_r($data);exit;
    	
    	for ($p=1; $p <= 806; $p++) { 
    		sleep(10);
    		$data['ess$ctr182778$KeyGoodsSearch$gvSearch$ctl23$txtRd'] = $p;
    		$data['ess$ctr182778$KeyGoodsSearch$gvSearch$ctl23$btnRd'] = '跳转';
    		$response = $helpercurl->post($url,$data); 
			$html = $response->body;
			$html = preg_replace("/<([a-zA-Z]+)[^>]*>/","<\\1>",$html);  //过滤属性
			//echo $html;exit;
			$pattern = '#<td>(\d+)</td><td>(.*?)</td><td>(.*?)</td><td>(.*?)</td><td>(.*?)</td>#i';
			preg_match_all($pattern, $html, $m1, PREG_SET_ORDER);
			//print_r($m1);
			if($m1){
				echo 'page:'.$p;
				foreach ($m1 as $k1 => $v1) {

					$code = isset($v1['1']) ? str1($v1['1']) : '';
					$name = isset($v1['2']) ? str1($v1['2']) : '';
					$guige = isset($v1['3']) ? str1($v1['3']) : '';
					$keywords = isset($v1['4']) ? str1($v1['4']) : '';
					$des = isset($v1['5']) ? str1($v1['5']) : '';
					$create_at = $update_at =  date('Y-m-d H:i:s', time());
					$sql = "INSERT INTO ht_shangpin(code,name,guige,keywords,des,create_at,update_at) VALUES
					('$code','$name','$guige','$keywords','$des','$create_at','$update_at')";
					$db->createCommand($sql)->execute();
				}
				echo "ok \n";
			}
    	}
    }




    /**
     * 通关参数
     * @param  integer $type [description]
     * @return [type]        [description]
     */
    public function actionTgcs(){
    	//http://www.customs.gov.cn/publish/portal0/tab9410/
    	//http://query.customs.gov.cn/HYW2007DataQuery/Cscx/CscxMsList.aspx
    	$db = Yii::$app->db;
    	$t_arr = [
    		//监管方式代码表  贸易方式代码表
    		'type_1' => ['type'=>1,'name'=>'贸易方式代码表', 'code'=>'贸易方式代码','name_num'=>'2', 'name1'=>'贸易方式简称', 'name2'=>'贸易方式全称','t'=>'myfs'],
    		'type_2' => ['type'=>2,'name'=>'征免性质代码表', 'code'=>'征免性质代码','name_num'=>'2', 'name1'=>'征免性质简称', 'name2'=>'征免性质全称','t'=>'zmxz'],
    		'type_3' => ['type'=>3,'name'=>'国别(地区)代码表', 'code'=>'国别地区代码','name_num'=>'3', 'name1'=>'中文名(简称)', 'name2'=>'英文名(简称)','name3'=>'优/普税率','t'=>'gbdq'],
    		'type_4' => ['type'=>4,'name'=>'国内地区代码表', 'code'=>'国内地区代码','name_num'=>'1', 'name1'=>'国内地区名称', 'name2'=>'','name3'=>'','t'=>'gndq'],
    		'type_5' => ['type'=>5,'name'=>'关区代码表', 'code'=>'关区代码','name_num'=>'1', 'name1'=>'关区名称', 'name2'=>'','name3'=>'','t'=>'gq'],
    		'type_6' => ['type'=>6,'name'=>'币制代码表', 'code'=>'纸币代码','name_num'=>'1', 'name1'=>'纸币名称', 'name2'=>'','name3'=>'','t'=>'bz'],
    		'type_7' => ['type'=>7,'name'=>'计量单位代码表', 'code'=>'计量单位代码','name_num'=>'1', 'name1'=>'计量单位名称', 'name2'=>'','name3'=>'','t'=>'jldw'],
    		'type_8' => ['type'=>8,'name'=>'企业性质代码表', 'code'=>'企业性质代码','name_num'=>'1', 'name1'=>'企业性质名称', 'name2'=>'','name3'=>'','t'=>'qyxz'],
    		'type_9' => ['type'=>9,'name'=>'地区性质代码表', 'code'=>'地区性质代码','name_num'=>'1', 'name1'=>'地区性质名称', 'name2'=>'','name3'=>'','t'=>'dqxz'],
    		'type_10' => ['type'=>10,'name'=>'成交方式代码表', 'code'=>'成交方式代码','name_num'=>'1', 'name1'=>'成交方式名称', 'name2'=>'','name3'=>'','t'=>'cjfs'],
    		'type_11' => ['type'=>11,'name'=>'用途代码表', 'code'=>'用途代码','name_num'=>'1', 'name1'=>'用途名称', 'name2'=>'','name3'=>'','t'=>'yt'],
    		'type_12' => ['type'=>12,'name'=>'结汇方式代码表', 'code'=>'结汇方式代码','name_num'=>'1', 'name1'=>'结汇方式名称', 'name2'=>'','name3'=>'','t'=>'jsfs'],
    		'type_13' => ['type'=>13,'name'=>'运输方式代码表', 'code'=>'运输方式代码','name_num'=>'1', 'name1'=>'运输方式名称', 'name2'=>'','name3'=>'','t'=>'ysfs'],
    		'type_14' => ['type'=>14,'name'=>'征减免税方式代码表', 'code'=>'征减免税方式代码','name_num'=>'1', 'name1'=>'征减免税方式代码表', 'name2'=>'','name3'=>'','t'=>'zjmsfs'],
    		'type_15' => ['type'=>15,'name'=>'监管证件代码表', 'code'=>'许可证或批文代码','name_num'=>'1', 'name1'=>'许可证或批文名称', 'name2'=>'','name3'=>'','t'=>'jgzj'],

    	];
    	foreach ($t_arr as $key => $v) {
    		if($v['type'] <= 2) {
    			continue;
    		}
    		$file = '/tmp/type1_4.txt';
    		$url = 'http://query.customs.gov.cn/HYW2007DataQuery/Cscx/CscxListView.aspx?tableName=zfs_table_'.$v['t'];
			$helpercurl = new Helpercurl();
			$ip = rand_ip();
			$helpercurl->headers = array(
			    'CLIENT-IP' => $ip,
			    'X-FORWARDED-FOR' => $ip,
			);
			$response = $helpercurl->get($url); 
			$html = $html1 = $response->body;
			//$html = $html1  = file_get_contents($file);

			//获取hidden值 
			$pattern = '#type="hidden".+?name="(.+?)".+?value="(.*?)"#i';
			preg_match_all($pattern, $html1, $m1,PREG_SET_ORDER);
			$data = [];
			if($m1) {
				foreach ($m1 as $k1 => $v1) {
					$key = $v1['1'];
					$data[$key] = $v1['2'];
				}
			}
			
			//共<span>2</span>页
			preg_match('#共<span>(\d+)</span>页#', $html, $m2);
			if($m2['1'] <= 0) {
				continue;
			}
			$page = $m2['1']; //页数
			echo "type:".$v['type'] . " t:".$v['t']." page:".$page."\n";
			sleep(30); //停顿
			for ($p=1; $p <= $page; $p++) { 
				sleep(20);
				echo 'Now page:'.$p."\n";
				$data['DeluxePager1$txtGoto'] = $p;
				$data['DeluxePager1$ctl04'] = '跳转到';
				$data['DeluxePager1$txtPageCount'] = $page;
				$response = $helpercurl->post($url,$data); 
				$html = $response->body;
				$this->updateHsTable($html,$v);			
			}
			
			echo '---------'."\n";	
    	}
    	
    }

    //将数据更新到数据库
    function updateHsTable($html,$v) {
		$db = Yii::$app->db;
		$html=preg_replace("/<(\/?head.*?)>/si","",$html); //过滤head标签
		$html = preg_replace("/<([a-zA-Z]+)[^>]*>/","<\\1>",$html);  //过滤属性
		$pattern = '#<td>(\d+)</td>';
		for ($i=1; $i <=$v['name_num'] ; $i++) { 
			$pattern .= '<td>(.+?)</td>';
		}
		$pattern .= '#i';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		if($matches){
			foreach ($matches as $key => $m) {
				$code = $m['1'];
				$type = $v['type'];
				$name1 = isset($m['2']) ? $m['2'] : '';
				$name1 = str_replace("'", "\'", $name1);//
				$name2 = isset($m['3']) ? $m['3'] : '';
				$name2 = str_replace("'", "\'", $name2);//
				$name3 = isset($m['4']) ? $m['4'] : '';
				$name3 = str_replace("'", "\'", $name3);//
				$name4 = isset($m['5']) ? $m['5'] : '';
				$create_at = $update_at =  date('Y-m-d H:i:s', time());
				$sql = "INSERT INTO hs_daimabiao(type,code,name1,name2,name3,name4,create_at,update_at) 
					VALUES('$type','$code','$name1','$name2','$name3','$name4','$create_at','$update_at')";
				$db->createCommand($sql)->execute(); 
			}
		}    	
    }


}

//随机IP
function rand_ip(){
	$ip_long = array(
		array('607649792', '608174079'), //36.56.0.0-36.63.255.255
		array('975044608', '977272831'), //58.30.0.0-58.63.255.255
		array('999751680', '999784447'), //59.151.0.0-59.151.127.255
		array('1019346944', '1019478015'), //60.194.0.0-60.195.255.255
		array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
		array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
		array('1947009024', '1947074559'), //116.13.0.0-116.13.255.255
		array('1987051520', '1988034559'), //118.112.0.0-118.126.255.255
		array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
		array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
		array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
		array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
		array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
		array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
		array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
	);
	$rand_key = mt_rand(0, 14);
	$huoduan_ip= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
	return $huoduan_ip;
}

function str2($str = '') {
    $str = strip_tags($str);
	$str = str_replace("'", "\'", $str);
	return $str;
}

function str1($str = '') {
	$str = str_replace('&nbsp;', '', $str);
	$str = str_replace("'", "\'", $str);
	$str = str_replace('&amp;', '&', $str);
	$str = trim($str);
	return $str;
}
