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
      <li><a href="javascript:void(0)" class="current">修改密码</a></li>
    </ul>
  </div>

  <div class="edit">

    <form method="post" action="<?php echo U('Admin/Setting/pwd');?>" enctype="multipart/form-data">

    <dl>

      <dt>旧密码：</dt>

      <dd>

        <input type="password" name="oldpass" class="w300" />

      </dd>

    </dl>

    <dl>

      <dt>新密码：</dt>

      <dd>

        <input type="password" name="newpass" class="w300"/>

      </dd>

    </dl>

    <dl>

      <dt>重复新密码：</dt>

      <dd>

        <input type="password" name="repass" class="w300"/>

      </dd>

    </dl>

    <dl>

      <dt>&nbsp;</dt>

      <dd><input type="submit"  value="提 交" class="btn_b"/></dd>

    </dl>

    </form>

  </div>

  

</div>



</div>
</body>
</html>