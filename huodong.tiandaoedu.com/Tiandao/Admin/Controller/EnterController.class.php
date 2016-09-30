<?php

namespace Admin\Controller;

use Admin\Logic\EditDataLogic;

class EnterController extends BaseController {

    private static $ActmessageModel;
    private static $UserBmModel;
    public function _initialize() {
        parent::_initialize();
        if (empty(self::$ActmessageModel)) {
            self::$ActmessageModel = D('Actmessage');
        }
        if(empty(self::$UserBmModel)){
            self::$UserBmModel = D('UserBm');
        }
    }

    public function index(){
        $actname = I('get.actname');
        $startDate = I('get.start_time');
        $endDate = I('get.end_time');
        //获取报名活动的用户
        $field = "a.*,act_name,act_status";
        $data = self::$UserBmModel ->searchData($actname,$startDate,$endDate);
        //获取所有的活动信息
        $field = "act_name,act_id";
        $info = self::$ActmessageModel->getAllData('',$field);
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
            'info' => $info,
        ))->display();
    }

    public function pass(){
        $actId = I('post.actId', false, 'int');
        $pass = I('post.pass', false, 'htmlspecialchars');
        $where = array('act_id' => $actId);
        $field = 'status';
        if ($pass == 'pass') {
            if (FALSE !== self::$UserBmModel->saveField($where, $field, $value = 1)) {
                $this->success('审核通过', '', TRUE);
            }
            $this->error('审核处理失败', '', TRUE);
        }
        if ($pass == 'nopass') {
            if (FALSE !== self::$UserBmModel->saveField($where, $field, $value = 2)) {
                $this->success('审核不通过', '', TRUE);
            }
            $this->error('审核处理失败', '', TRUE);
        }
        $this->error('审核处理失败', '', TRUE);
    }

    public function info() {
        $id = I('get.id', false, 'int');
        //获取学生的信息
        $data = self::$UserBmModel->where(array('act_id' => $id))->find();
        $this->assign('data', $data)->display();
    }

}
