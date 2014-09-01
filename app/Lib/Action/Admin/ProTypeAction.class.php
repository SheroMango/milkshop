<?php
/**
 * 商品分类控制器
 * @author Mango
 * @version 2014.08.29 
 */
class ProTypeAction extends AdminAction
{
    /**
     * ls
     */
    public function ls()
    {
        $typeList = D('ProType')->select();
        $this->assign('list', $typeList);
        $this->display();
    }

    /**
     * display add product type view
     */
    public function addType()
    {
        $this->assign('list', D('ProType')->select());
        $this->display();
    }
    /**
     * do add product type
     */
    public function doAddType()
    {
        $data = $_POST;
        $result = D('ProType')->add($data);
        if(!empty($result)){
            $this->success('添加成功',U('ProType/ls'));
        }else{
            $this->error('添加失败',U('ProType/ls'));
        }
    }

    /**
     * display update product type view
     */
    public function updateType()
    {
        $id = intval($_GET['id']);
        $info = D('ProType')->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * do update product type
     */
    public function doUpdateType()
    {
        $data = $_POST;
        $result = D('ProType')->save($data);
        if(!empty($result)){
            $this->success('修改成功',U('ProType/ls'));
        }else{
            $this->error('修改失败',U('ProType/ls'));
        }
    }


    /**
     * del product type
     */
    public function del(){
        //删除的ID的数组
        $delIds = array();

        //POST方法删除的ID，批量删除的ID
        $postIds = $this->_post('id');
        if (!empty($postIds)) {
            $delIds = $postIds;
        }

        //GET方法删除
        //trim
        $getId = intval($this->_get('id'));
        if (!empty($getId)) {
            $delIds[] = $getId;
        }

        //判断是否为空
        if (empty($delIds)) {
            $this->error('请选择您要删除的分类');
        }

        $map['id'] = array('in', $delIds);
        $result = D('ProType')->where($map)->delete();
        if(!empty($result)){
            $this->success('删除成功',U('ProType/ls'));
        }else{
            $this->error('删除失败',U('ProType/ls'));
        }
    }

}

?>
