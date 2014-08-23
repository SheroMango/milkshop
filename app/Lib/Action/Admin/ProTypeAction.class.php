<?php
/**
 * 商品分类控制器
 */
class ProTypeAction extends AdminAction
{
    /**
     * ls
     */
    public function ls()
    {
        $typeList = D('ProType')->order('sort desc')->limit(0,2)->select();
        $this->assign('list', $typeList);
        $this->display();
    }

    /**
     * info
     */
    public function info()
    {
        $typeObj = D('ProType');
        if(empty($_POST)){
            $id = $this->_get('id');
            if(!empty($id)){
                $info = $typeObj->where('id='.$id)->find();
                $this->assign('info', $info);
            }
            $this->display();
            exit;
        }
        $data = $this->_post();
        $id = $this->_post('id');
        if(empty($id)){
            $typeObj->add($data);
        }else{
            $typeObj->save($data);
        }
        $this->success('操作成功');
    }

    public function del(){
        //删除的ID的数组
        $delIds = array();

        //POST方法删除的ID，批量删除的ID
        $postIds = $this->_post('id');
        if (!empty($postIds)) {
            $delIds = $postIds;
        }

        //GET方法删除
        $getId = intval($this->_get('id'));
        if (!empty($getId)) {
            $delIds[] = $getId;
        }

        //判断是否为空
        if (empty($delIds)) {
            $this->error('请选择您要删除的商品分类');
        }
        $map['id'] = array('in', $delIds);
        $result = D('ProType')->where($map)->delete();
        if(!empty($result)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}

?>
