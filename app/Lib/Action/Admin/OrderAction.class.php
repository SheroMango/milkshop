<?php
/**
 * 订单管理控制器
 */
class OrderAction extends AdminAction
{
    /**
     * get user list
     */
    public function get_user_list()
    {
        $list = D('User')->select();
        return $list;
    }

    /**
     * get pro list
     */
    public function get_product_list()
    {
        $list = D('Product')->select();
        return $list;
    }

    /**
     * ls
     */
    public function ls()
    {
        //search
        $map = array();
        if (IS_POST) {
           $search = $this->_post('search');
        }       
        if($search){
            $map['name|user_id'] = array('like',"%{$search}%");
        }

        //paging
        $count = D('Order')->where($map)->count();
        $page = page($count);
        

        $list = D('Order')->where($map)->order($sort)->limit($page->firstRow, $page->listRows)->select();
        //print_r(D('Article')->getLastSQL());

        foreach ($list as $key => $value) 
        {
            $name = D('Product')->where('id='.$value['product_id'])->getField('name');
            $price = D('Product')->where('id='.$value['product_id'])->getField('price');
            $list[$key]['name'] = $name;
            $list[$key]['price'] = $price;
        }

        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->assign('pid', $pid);
        $this->display();
    }

 
    /**
     * info
     */
    public function info()
    {
        $obj = D('Order');
        if(empty($_POST))
        {
            $id = $this->_get('id');
            if(!empty($id)){
                $info = $obj->where('id='.$id)->find();
                $this->assign('info', $info);
            }
            $product_name = D('Product')->where('id='.$info['product_id'])->getField('name');
            $user_name = D('User')->where('id='.$info['user_id'])->getField('name');
            $info['product_name'] = $product_name;
            $info['user_name'] = $user_name;
            $info['price_all'] = $info['price']*$info['num'];
            $this->assign('info', $info);
            $this->display();
            exit;
        }
        $data = $this->_post();
        
        // $data['time_modify'] = time();
        if(empty($data['id'])){
            $obj->add($data);
            // $data['time_add'] = time();
        }else{
            $obj->save($data);
        }
        $this->success('操作成功');

        
    }
    
    public function del(){
        $delIds = array();
        $postIds = $this->_post('id');
        if (!empty($postIds)) {
            $delIds = $postIds;
        }
        $getId = intval($this->_get('id'));
        if (!empty($getId)) {
            $delIds[] = $getId;
        }
        if (empty($delIds)) {
            $this->error('请选择您要删除的订单');
        }
        $arrMap['id'] = array('in', $delIds);
        if(D('Order')->where($arrMap)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}
