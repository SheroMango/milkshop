<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>后台管理</title>

<!--CSS BEGIN-->
<link href="__PUBLIC__/Home/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./public/js/plugin/fancybox/jquery.fancybox.css?v=2.1.4" />
<link href="__PUBLIC__/css/base.css"       rel="stylesheet" type="text/css">
<link href="__PUBLIC__/css/common.css"     rel="stylesheet" type="text/css">
<link href="__PUBLIC__/Home/css/page.css"  rel="stylesheet" type="text/css">
<link href="__PUBLIC__/jquery.ui/jquery-ui.css" rel="stylesheet" type="text/css">
<!--CSS END-->

<!--JS BEGIN-->
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/base.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>  
<script type="text/javascript" src="__PUBLIC__/Home/js/page.js"></script>
<script type="text/javascript" src="__PUBLIC__/jquery.ui/jquery-ui.js"></script>
<!--script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.14.0.js"></script-->
<!--JS BEGIN-->


</head>
<body>
<div class="content">



  <!--选项卡 BEGIN-->
  <div class="tabs">
    <ul>
      <li><a href="javascript:void(0)" class="current">基本信息</a></li>
    </ul>
  </div>
  <!--END 选项卡-->
  
  <!--编辑表单 BEGIN-->
  <div class="edit">
      <form action="<?php echo U('Admin/Setting/doSet');?>" method="post" enctype="multipart/form-data">
      <dl>
        <dt>接口地址：</dt>
        <dd>
          <?php echo ($url_api); ?>
        </dd>  
      </dl>
      <dl>
        <dt>接口凭证：</dt>
        <dd>
          <input type="text" name="token" value="<?php echo ($list["token"]); ?>"  class="w250"/>
        </dd>
      </dl>
      <dl>
        <dt>APPID: </dt>
        <dd>
          <input type="text" name="appid"  value="<?php echo ($list["appid"]); ?>" class="w250" />
        </dd>
      </dl>
      <dl>
        <dt>APPSECRECT: </dt>
        <dd>
          <input type="text" name="appsecrect" value="<?php echo ($list["appsecrect"]); ?>" class="w250"/>
        </dd>
      </dl>
      <dl>
        <dt>&nbsp;</dt>
        <dd><input type="submit"  value="提 交" class="btn submit-btn" /></dd>
      </dl>
    </form>
  </div>
  <!--END 编辑表单--> 
</div>
</body>
</html>