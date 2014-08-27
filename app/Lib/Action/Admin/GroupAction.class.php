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
        $groupList = D('Group')->select();
        $this->assign('list', $groupList);
        $this->display();
    }

    /**
     * info
     */
    public function info()
    {
        $groupObj = D('Group');
        if(empty($_POST)){
            $id = $this->_get('id');
            if(!empty($id)){
                $info = $GroupObj->where('id='.$id)->find();
                $this->assign('info', $info);
            }
            $this->display();
            exit;
        }
        $data = $this->_post();   
        $id = $this->_post('id');
        if(empty($id)){
            $groupObj->add($data);
        }else{
            $groupObj->save($data);
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
