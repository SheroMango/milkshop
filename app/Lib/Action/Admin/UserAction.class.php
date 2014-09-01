<?php
/**
 * 用户管理控制器
 */
class UserAction extends AdminAction
{


    /**
     * get group list
     */
    private function get_group_list()
    {
        $list = D('Group')->select();
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
            $map['name|tel'] = array('like',"%{$search}%");
        }

        //paging
        $count = D('User')->where($map)->count();
        $page = page($count);
        
        $list = D('User')->where($map)->order($sort)->limit($page->firstRow, $page->listRows)->select();
        foreach($list as $k=>$v){
            $list[$k]['sex'] = ($v['sex']) ? '男' : '女';
        }
        foreach ($list as $key => $value) {
            $name = D('UserGroup')->where('id='.$value['pid'])->getField('name');
            $list[$key]['group'] = $name;
        }
        // print_r(D('UserGroup')->getLastSQL());exit;
        $this->assign('list', $list);
        $this->assign('pages', $page->show());
        $this->display();
    }

    /**
     * info
     */
    public function info()
    {
        $obj = D('User');
        if(empty($_POST)){
            $id = $this->_get('id');
            if(!empty($id)){
                $info = $obj->where('id='.$id)->find();
                $pid = $info['pid'];
                if($info['sex']){
                    $info['sex'] = '男';
                }else{
                    $info['sex'] ='女';
                }
                $this->assign('info', $info);
            }else{
                $pid = $this->_get('pid');
            }
            $this->assign('groupList', $this->get_group_list());
            $this->assign('pid', $pid);
            $this->assign('sex',$sex);
            $this->display();
            exit;
        }
        $data = $this->_post();
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
            $this->error('请选择您要删除的用户');
        }
        $arrMap['id'] = array('in', $delIds);
        if(D('User')->where($arrMap)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}
