<?php

/**
 * 首页
 * @version 2014.07.23
 */

class IndexAction extends AdminAction {

    

    //框架页

    public function index() {

        C('SHOW_PAGE_TRACE', true);

        $this->assign('channel', $this->_getChannel());

        $this->assign('menu',    $this->_getMenu());

        $this->display();

    }



    /**
     * 首页
     */

    public function main() {

        echo '<h2>这里是后台首页</h2>';

        $this->display();

    }



    /**
     * 头部菜单
     */

    protected function _getChannel() {

        return array(

            'index'   => '我的首页',

        );

    }



    /**
     * 左侧菜单
     */

    protected function _getMenu() {

        $menu = array();

        //注意顺序！！



        // 后台管理首页

        $menu['index'] = array(

            '网站信息' => array(
                '设置信息' => U('Admin/Setting/set'),
                '修改密码' => U('Admin/Setting/pwd'),

            ),

            '商品管理' => array(
                '商品管理' => U('Admin/Product/ls'),
                '分类管理' => U('Admin/ProType/ls'),
            ),

            '用户管理' => array(
                '用户管理' => U('Admin/User/ls'),
                '分组管理' => U('Admin/Group/ls'),
            ),

            '订单管理' => array(
                '订单管理' => U('Admin/Order/ls'),
            ),

            '微信管理' => array(
                '关键字列表' => U('Admin/Route/ls'),
                '关注回复' => U('Admin/Txp/subscribe'),
                '文本回复列表' =>U('Admin/Text/ls'),
                '图文回复列表' =>U('Admin/Txp/ls'),
                '菜单列表' =>U('Admin/Menu/ls'),

            ),
        );

        return $menu;

    }

}

