<?php
/**
 * 用户分组控制器
 */
class GroupAction extends AdminAction
{
    /**
     * ls
     */
    public function ls()
    {
        $groupList = D('UserGroup')->select();
        $this->assign('list', $groupList);
        $this->display();
    }

    /**
     * display add group view
     */
    public function addGroup()
    {
        $this->assign('list',D('UserGroup')->select());
        $this->display();
    }

    /**
     * do add group
     */
    public function doAddGroup()
    {
        $data = $_POST;
        $result = D('UserGroup')->add($data);
        if(!empty($result)){
            $this->success('添加成功',U('Group/ls'));
        }else{
            $this->error('添加失败',U('Group/ls'));
        }
    }

    /**
     * diapley update group
     */
    public function updateGroup()
    {
        $id = intval($_GET['id']);
        $info = D('UserGroup')->where('id='.$id)->find();
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * do update
     */
    public function doUpdateGroup()
    {
        $data = $_POST;
        $result = D('UserGroup')->save($data);
        if(!empty($result)){
            $this->success('修改成功',U('Group/ls'));
        }else{
            $this->error('添加失败',U('Group/ls'));
        }
    }

    /**
     * del user group
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
            $this->error('请选择您要删除的模板');
        }

        $map['id'] = array('in', $delIds);
        $result = D('Group')->where($map)->delete();
        if(!empty($result)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}

?>
