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

<div class="tabs">
    <ul>
        <li class="current"><a href="javascript:void(0)" class="current">添加商品</a></li>
    </ul>
</div>
<div class="edit">
	<form method="post" action="<?php echo U('Admin/Product/doAddPro');?>" entype="multipart/form-data">
		<dl>
			<dt>商品分类：</dt>
			<dd><select name="pid" value="">
				<?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type["id"]); ?>"><?php echo ($type["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select></dd>
		</dl>
		<dl>
			<dt>商品名称：</dt>
			<dd><input type="text" name="name" value="" class="w200"></dd>
		</dl>
		<dl>
            <dt>商品图片：</dt>
            <dd><input type="file" name="pic"></dd>
        <dl>
		<dl>
			<dt>商品描述：</dt>
			<dd><textarea name="desc" id="editor" cols="80" rows="20"></textarea></dd>
		</dl>
		<dl>
			<dt>单价：</dt>
			<dd><input type="text" name="price" value="">元</dd>
		</dl>
		<dl>
			<dt>库存：</dt>
			<dd><input type="text" name="num" value=""></dd>
		</dl>
		<dl>
            <dt></dt>
            <dd><input type="submit" value="添 加" class="btn submit-btn" /></dd>
        </dl>
	</form>
</div>
</div>
</body>
</html>

<script type="text/javascript" src="__PUBLIC__/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/ueditor/ueditor.all.js">
</script>
<script type="text/javascript">
UE.getEditor('editor');
</script>