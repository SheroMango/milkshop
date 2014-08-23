<?php
/**
 * 后台-首页
 * @author chen
 * @version 2014-03-14
 */
class PublicAction extends BaseAction
{
    /**
     * 页面：后台登陆
     */
    public function login()
    {
        $this->display();
    }


    /**
     * 处理：后台登陆
     */
    public function doLogin()
    {
        $name = $_POST['name'];
        $pwd = $_POST['password'];
		$userInfo = D('User')->where("name='".$name."' AND pwd='".md5($pwd)."'")->find();
		if(empty($userInfo)){
            $this->error('用户名或密码错误');
        }
        $result = $this->setSession($userInfo['id']);
        $this->success('登录成功', U('Index/index'));
    }

    /**
     * 首次登录后的SESSION处理工作
     */
    private function setSession($id){
        $_SESSION['uid'] = $id;
        $_SESSION['current_ip'] = get_client_ip();
        $_SESSION['current_time'] = time();
        return "1";
    }

    /**
     * 用户登出
     */
    public function logout() {
        $url = U('Public/login');
        //存储此次用户的登录信息
		$update = array(
			'last_time' => $_SESSION['current_time'],
			'last_ip' => $_SESSION['current_ip'],
		);
		D('User')->where('id='.$_SESSION['uid'])->save($update);
        unset($_SESSION);
		session_destroy();
        $this->success('登出成功！', $url);
    }

}
