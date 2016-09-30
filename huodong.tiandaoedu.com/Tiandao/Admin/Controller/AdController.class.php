<?php

/**
 * 广告
 */

namespace Admin\Controller;

use Admin\Logic\EditDataLogic;

class AdController extends BaseController {

    public function ad() {
        $this->display();
    }

    //新增广告
    public function ajaxAdd() {
        EditDataLogic::checkHost();
        if (D('Ad')->create(I('post.'), 1)) {
            if (D('Ad')->add()) {
                $this->success('添加成功', '', TRUE);
            }
        }
        $this->error('添加失败', '', TRUE);
    }

    //广告位列表
    public function adList() {
        //$data = D('Ad')->order('sort_number DESC,ad_id ASC')->field('ad_id,ad_name,media_type,ad_time,sort_number')->select();
        $data = D('Ad')->order('ad_id ASC')->field('ad_id,ad_name,media_type,ad_time,sort_number')->select();
        foreach ($data as $k => $v) {
            $data[$k]['media_type'] = EditDataLogic::getType($v['media_type']);
            $data[$k]['ad_time'] = date('Y-m-d H:i:s', $v['ad_time']);
        }
        $this->assign('data', $data)->display();
    }

    //删除广告位
    public function ajaxDelete() {
        EditDataLogic::checkHost();
        $id = I('post.adId', false, 'int');
        if (FALSE !== D('Ad')->deleteData(array('ad_id' => $id))) {
            $this->success('删除成功', '', TRUE);
        }
        $this->error('删除失败', '', TRUE);
    }

    //修改页面
    public function editAd() {
        $id = I('get.ad_id', 0, 'int');
        $data = D('Ad')->where(array('ad_id' => $id))->find();
        //$data['ad_pic'] = str_replace(getServicePath()."/Public/","",$data['ad_pic']);
        $this->assign('data', $data)->display();
    }

    //修改广告位
    public function ajaxEditAd() {
        EditDataLogic::checkHost();
        if (D('Ad')->create(I('post.'), 2)) {
            if (FALSE !== D('Ad')->save()) {
                $this->success('添加成功', '', TRUE);
            }
        }
        $this->error(D('Ad')->getError(), '', TRUE);
    }

}
