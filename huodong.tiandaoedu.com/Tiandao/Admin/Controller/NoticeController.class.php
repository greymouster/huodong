<?php

/**
 * 公告
 */

namespace Admin\Controller;

use Think\Page;

class NoticeController extends BaseController {

    protected static $noticeModel;

    public function _initialize() {
        parent::_initialize();
        if (empty(self::$noticeModel)) {
            self::$noticeModel = D('Notice');
        }
    }

    public function index() {
        //获取公告信息
        $count = self::$noticeModel->count();
        $Page = new Page($count, 1);
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $data = self::$noticeModel->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        foreach ($data as $k => $v) {
            $data[$k]['update_time'] = date('Y年m月d日', $v['update_time']);
        }
        $show = $Page->show(); // 分页显示输出
        $this->assign(array(
            'data' => $data,
            'page' => $show,
        ));
        $this->display();
    }

    //新增公告
    public function add() {
        $this->display();
    }

    public function ajaxAddNotice() {
        $this->checkHost();
        if (self::$noticeModel->create(I('post.'), 1)) {
            if (self::$noticeModel->addData()) {
                $this->ajaxReturn(array('status' => 1, 'msg' => '添加成功'), 'json');
            }
        }
        $this->ajaxReturn(array('status' => -1, 'msg' => self::$noticeModel->getError()), 'json');
    }

    //修改公告
    public function edit() {
        $id = I('get.id', false, 'int');
        if (!$id) {
            header("location:" . U('Notice/index'));
        }
        $data = self::$noticeModel->getOneData(array('id' => $id));
        $this->assign('data', $data)->display();
    }

    public function ajaxEditNotice() {
        $this->checkHost();
        if (self::$noticeModel->create(I('post.'), 2)) {
            if (FALSE !== self::$noticeModel->save()) {
                $this->ajaxReturn(array('status' => 1, 'msg' => '修改成功', 'json'));
            }
        }
        $this->ajaxReturn(array('status' => -1, 'msg' => self::$noticeModel->getError()), 'json');
    }

    //删除
    public function ajaxDeleteNotice() {
        $this->checkHost();
        $id = I('post.id', false, 'htmlspecialchars');
        if (!$id) {
            $this->ajaxReturn(array('status' => -1, 'msg' => '请求错误'), 'json');
        }
        if (FALSE !== self::$noticeModel->deleteData(array('id' => $id))) {
            $this->ajaxReturn(array('status' => 1, 'msg' => '删除成功'), 'json');
        }
        $this->ajaxReturn(array('status' => -1, 'msg' => '删除失败'), 'json');
    }

    /**
     * POST CHECK
     */
    public function checkHost() {
        if (!IS_POST) {
            $this->ajaxReturn(array('status' => -1, 'msg' => '非法请求'), 'json');
        }
    }

}
