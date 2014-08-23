<?php
/**
 * 微信接口控制器
 * @author mango
 * @version 2014.08.05
 */
class WxAction extends BaseAction
{
	//类属性
	private $token;

	//定义一个接口方法 
	public function api()
	{
		//实例化一个Wx模型
		$wxObj = D('Wx');
		$wxObj->valid();
		$wxObj->responseMsg();
	}
}
?>