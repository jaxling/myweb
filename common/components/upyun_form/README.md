### 又拍云 PHP 表单 SDK

又拍云存储 PHP 表单 SDK，基于 [又拍云存储 FROM API 接口](http://docs.upyun.com/api/#FORM_API) 开发。

#### 使用说明

##### 初始化 UpYun

```
require_once('upyun.class.php');
$upyun = new UpYun('bucket_name', 'form_api_secret');
```

参数 `bucket_name` 为服务名称，`form_api_secret` 为表单密钥。

根据国内的网络情况，又拍云存储 API 目前提供了电信、联通、移动三个接入点，在初始化的时候可以添加可选的第四个参数来指定 API 接入点

```
$upyun = new UpYun('bucket_name', 'form_api_secret', UpYun::ED_TELECOM);
```

接入点有四个可选值：

* UpYun::ED_AUTO 根据网络条件自动选择接入点
* UpYun::ED_TELECOM 电信接入点
* UpYun::ED_CNC 联通接入点
* UpYun::ED_CTT 移动接入点

默认参数为自动选择 API 接入点。推荐根据服务器网络情况，手动设置合理的接入点以获取最佳的访问速度。

**过期时间设置** 在初始化 UpYun 时，可以选择设置当前的上传请求授权的过期时间（默认：600s）

```
$upyun = new UpYun('bucket_name', 'form_api_secret', UpYun::ED_TELECOM, 6000);
```

##### 上传文件

表单形式上传

```
<form action="<?php echo $action; ?>" method="post" enctype="Multipart/form-data">
	<input type="hidden" name="policy" value="<?php echo $policy; ?>" />
    <input type="hidden" name="signature" value="<?php echo $sign; ?>" />
    <input type="file" name="file" />
    <input type="submit" />
</form>
```

相关参数设置生成

```
$opts = array();
// 必选参数
$opts['save-key'] = '/{year}/{mon}/{day}/upload_{filename}{.suffix}';   // 保存路径
// 以下参数均为可选
/*
$opts['allow-file-type'] = '';   // 文件类型限制，如：jpg,gif,png
$opts['content-length-range'] = '';  // 文件大小限制，如：102400,1024000 单位：Bytes
$opts['content-md5'] = '';  // 文件校验码（根据上传文件的内容进行 md5 校验后得到的数值），如：202cb962ac59075b964b07152d234b70
……

$policy = $upyun->policyCreate($opts);	// 生成 policy
$sign = $upyun->signCreate($opts);	// 生成签名 sign
$action = $upyun->action();		// 生成提交地址
```
