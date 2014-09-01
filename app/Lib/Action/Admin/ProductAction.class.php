<?php
/**
 * 商品控制器
 * @author Mango
 * @version 2014.08.29
 */
class ProductAction extends AdminAction
{
	/**
	 * get ProType list
	 */
	public function get_protype_list()
	{
		$list = D('ProType')->select();
		return $list;
	}

	/**
	 * Product list
	 */
	public function ls()
	{ 
		//search 
		$map = array();
		if(IS_POST){
			$search = $this->_post('search');
		}
		if($search){
			$map['name'] = array('like',"%{$search}%");
		}

		//paging
		$count = D('Product')->where($map)->count();
		$page = page($count);

        $list = D('Product')->where($map)->limit($page->firstRow, $page->listRows)->select();
        foreach ($list as $key => $value) {
            $name = D('ProType')->where('id='.$value['pid'])->getField('name');
            $list[$key]['type'] = $name;
        }
		$this->assign('list',$list);
		$this->display();
	}

	/**
	 * diaplay add product view
	 */
	public function addPro()
    {       
        $this->assign('typeList',$this->get_protype_list());
        $this->display();
    }

    /**
     * do add product
     */
    public function doAddPro()
    {
        $data = $_POST;
        $data['time_create'] = $data['time_modify'] = time();
        $result = D('Product')->add($data);
        if(!empty($result)){
            $this->success('添加成功',U('Product/ls'));
        }else{
            $this->error('添加失败',U('Product/ls'));
        }
    }

    /**
     * display update product view
     */
    public function updatePro()
    {
        $id = intval($_GET['id']);
        $info = D('Product')->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->assign('typeList',$this->get_protype_list());
        $this->display();
    }

    /**
     * do update product
     */
    public function doUpdatePro()
    {
        $data = $_POST;
        $data['time_modify'] = time();
        $result = D('Product')->save($data);
        if(!empty($result)){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }


    /**
     * del
     */
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
            $this->error('请选择您要删除的商品');
        }
        $arrMap['id'] = array('in', $delIds);
        if(D('Product')->where($arrMap)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}
?>