<?php

/**
 * 后台-全局控制器
 * @version 2013-08-28
 */

class SettingAction extends HomeAction {

   /**
     * 处理：编辑配置文件
     */

    public function set()
    {

        $setObj = D('Setting');
        $setList = $setObj->select();
        foreach($setList as $k=>$v){
            $list[$v['skey']] = $v['svalue'];
        }
        $this->assign('list', $list);
        $this->assign('url_api', U('Wx/api'));
        $this->display();
    }

    /**
     * doSet
     */
    public function doSet(){
        $data = $_POST;
        foreach($data as $k=>$v){
            $add['skey'] = $k;
            $add['svalue'] = $v;
            $result = D('Setting')->where("skey='".$k."'")->find();
            if(empty($result)){
                D('Setting')->add($add);
            }else{
                D('Setting')->save($add);
            }
        }
        $this->success("操作成功");
    }


    /**
     * 页面：修改密码
     */

    public function pwd()

    {

        if(empty($_POST)){
            $this->display();
            exit;
        }
        $userObj = D('User');

        $oldpass = trim($this->_post('oldpass'));

        $newpass = trim($this->_post('newpass'));

        $repass = trim($this->_post('repass'));



        if (empty($oldpass)) {

            $this->error('旧密码不能为空');

        }

        if (empty($newpass)) {

            $this->error('新密码不能为空');

        }

        if ($newpass != $repass) {

            $this->error('两次密码输入不一致');

        }



	    //旧密码

	    $password = $userObj->where('id='.$_SESSION['uid'])->getField('password');

	    if ($password != md5($oldpass)) {

            $this->error('旧密码不正确');

        }



        //更新密码

        $update = array(

            'password' => md5($newpass),

        );

        $userObj->where('id='.$_SESSION['uid'])->save($update);
        print_r($userObj->getLastSQL());exit;

        $this->success('密码修改成功');

    }


}