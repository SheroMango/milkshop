<?php
/**
 * 前台公共控制器类
 * @author chen
 * @version 2014-03-11
 */
class AdminAction extends BaseAction
{
    #public $breadcrumbs;
    /**
     * initialize
     */
    public function _initialize()
    {
        if(!isset($_SESSION['uid'])){
            $this->redirect('Public/login');
        }
    }
}
