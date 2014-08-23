<?php
/**
 * 商品控制器
 * @author Mango
 * @version 2014.08.23
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
		//sort
		if(!empty($_GET['sort'])){
            if($_GET['type'] == '1'){
                $type = 'asc';
                $type_num = '0';
            }else{
                $type = 'desc';
                $type_num = '1';
            }
            $sort = $_GET['sort'].' '.$type;
            $this->assign('type', $type_num);
        }else{
            $sort = 'id desc';
            $this->assign('type', '1');
        }


		//search 
		$map = array();
		if(IS_POST){
			$search = $this->_post('search');
		}
		if($search){
			$map['name'] = array('lile','%{$search}%');
		}

		$pid = $this->_get('pid');
		$pid = ($pid) ? $pid : '0';
		$map['pid'] = array('eq',$pid);

		//paging
		$count = D('Product')->where($map)->count();
		$page = page($count);

        $list = D('Product')->where($map)->order($sort)->limit($page->firstRow, $page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('pid',$pid);
		$this->display();
	}

	/**
	 * info
	 */
	public function info()
    {
        $obj = D('Product');
        if(empty($_POST)){
            $id = $this->_get('id');
            if(!empty($id)){
                $info = $obj->where('id='.$id)->find();
                $pid = $info['pid'];
                $this->assign('info', $info);
            }else{
                $pid = $this->_get('pid');
            }
            $this->assign('typeList', $this->get_protype_list());
            $this->assign('pid', $pid);
            $this->display();
            exit;
        }
        $data = $this->_post();
        if(!empty($_FILES['pic']['name'])){
            $picList = uploadPic();
            if($picList['code'] != 'error'){
                $data['pic'] = $picList['pic']['savename'];
            }
        }
        $data['time_modify'] = time();
        if(empty($data['id'])){
            $obj->add($data);
            $data['time_add'] = time();
        }else{
            $obj->save($data);
        }
        $this->success('操作成功');

        
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