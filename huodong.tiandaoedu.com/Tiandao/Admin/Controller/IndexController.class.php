<?php

namespace Admin\Controller;

use Admin\Model\AuthModel;
use Admin\Model\AdminModel;

class IndexController extends BaseController {

    public function index() {
        $parentAuth = AuthModel::init()->where(array('level' => 0))->select();
        //根据用户名去查询权限的id
        $username = session('username');
        $data = AdminModel::init()->getOneData(array('username' => $username), 'act_list');
        if ($data['act_list'] == "all") {
            $subAuth = AuthModel::init()->where(array('level' => array('in', '1,3')))->select();
        } else {
            $subAuth = AuthModel::init()->where(array('level' => 1))->select();
        }
        $this->assign(array(
            'parentAuth' => $parentAuth,
            'subAuth' => $subAuth,
        ));
        $this->display();
    }

}
