<?php
/**
 * 微网站统一控制器
 * @author chen
 * @version 2014-03-03
 */
class IndexAction extends HomeAction
{
    /**
     * 首页控制函数
     */
    public function index()
    {
        $this->display();
    }

    /**
     * set
     */
    private function get_set()
    {
        $list = D('Setting')->select();
        foreach($list as $k=>$v){
            $newList[$v['skey']] = $v['svalue'];
        }
        return $newList;
    }

    /**
     * 内页控制函数
     */
    public function item()
    {
        $id = $this->_get('id');
        $obj = D('Article');
        $info = $obj->where('id='.$id)->find();
        $list = $obj->where('pid='.$id)->order('sort')->select();
        $this->assign($this->get_set());
        $this->assign('info', $info);
        $this->assign('list', $list);
        $this->display("Gaoli:".D('Tpl')->where('id='.$info['tpl_id'])->getField('flag'));
    }

    /**
     * show the news push content
     */
    public function push()
    {
        $pushInfo = D('WechatNewsMeta')->getInfoById($this->item_id);
        $pushInfo['cover_name'] = getPicPath(D('GalleryMeta')->getImg($pushInfo['cover'], 'm'));
        $pushInfo['intro'] = $pushInfo['description'];
        $pushInfo['info'] = htmlspecialchars_decode($pushInfo['content']);
        $pushInfo['date_add_text'] = date('Y-m-d H:i', $pushInfo['date_add']);

        $this->assign('info', $pushInfo);
        $this->display($this->getRelTpl('detail'));
    }
}
?>