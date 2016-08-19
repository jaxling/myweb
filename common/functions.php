<?php
/**
 * 在AController 加载此函数或者放在helper类，都是一样使用
 * 自定义方法在此
 */


/**
 * test
 * @return [type] [description]
 */
function testtest(){
	echo 'aaa';
}

/**
 * 获取文件类型
 * @param  [type] $type [description]
 * @return [type]       [description]
 */
function getFileType($file_type = null){
	$type = '';
	if (!$file_type) {
		return $type;
	}

    if (preg_match('#jpeg#i', $file_type)) {
        $type = '.jpg';
    } elseif (preg_match('#png#i', $file_type)) {
        $type = '.png';
    } elseif (preg_match('#jpg#i', $file_type)) {
        $type = '.jpg';
    } 

    return $type;	
}