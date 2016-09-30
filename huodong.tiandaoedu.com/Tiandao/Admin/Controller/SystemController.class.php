<?php

namespace Admin\Controller;

use Think\Page;
use Think\PyInitial;
use Admin\Model\AuthModel;
use Admin\Model\PlaceModel;
use Admin\Model\AdminModel;
use Admin\Model\GroupModel;
use Admin\Logic\EditDataLogic;
use Admin\Model\CategoryModel;

class SystemController extends BaseController {

    //分类管理
    public function category() {
        $order = array('sort_number' => 'asc', 'id' => 'asc');
        $data = EditDataLogic::getAllData('Category', $order);
        $this->assign('data', $data)->display();
    }

    //地点管理
    public function place() {
        $order = array('sort_number' => 'asc', 'id' => 'asc');
        $data = EditDataLogic::getAllData('Place', $order);
        $this->assign('data', $data)->display();
    }

    //渠道管理
    public function channel() {
        $data = EditDataLogic::getAllData('Channel');
        $this->assign('data', $data)->display();
    }

    //新增
    public function ajaxAdd() {
        EditDataLogic::checkHost();
        $val = I('post.val', false, 'htmlspecialchars');
        $flag = I('post.flag', false, 'htmlspecialchars');
        switch ($flag) {
            case 'category':
                $py = new PyInitial();
                $short = strtolower($py->getInitials($val));
                if (EditDataLogic::addData('Category', array('cat_name' => $val,'abb_short'=>$short))) {
                    adminLog("新增活动分类");
                    $this->ajaxReturn(array('status' => 1, 'msg' => '新增活动分类成功'), 'json');
                }
                break;
            case 'place':
                $py = new PyInitial();
                $short = strtolower($py->getInitials($val));
                if (EditDataLogic::addData('Place', array('place_name' => $val,'abb_short'=>$short))) {
                    $this->ajaxReturn(array('status' => 1, 'msg' => '新增失败'), 'json');
                }
                break;
            case 'channel':
                if (EditDataLogic::addData('Channel', array('channel_name' => $val))) {
                    adminLog("新增推广渠道");
                    $this->ajaxReturn(array('status' => 1, 'msg' => '新增渠道成功'), 'json');
                }
                break;
            default :
                $this->ajaxReturn(array('status' => 0, 'msg' => '请求参数有误'), 'json');
                break;
        }
    }

    //排序
    public function ajaxAsc() {
        EditDataLogic::checkHost();
        $sortNumber = I('post.sortNumber', 0, 'int');
        $prevSortNumber = I('post.prevSortNumber', 0, 'int');
        $flag = I('post.flag', false, 'htmlspecialchars');
        switch ($flag) {
            case 'category':
                $data = CategoryModel::init()->incSortNumber($sortNumber, $prevSortNumber);
                if ($data) {
                    $this->ajaxReturn(array('status' => 1, 'msg' => '更新排序成功'), 'json');
                }
                $this->ajaxReturn(array('status' => -1, 'msg' => '更新排序失败'), 'json');
                break;
            case 'place':
                $data = PlaceModel::init()->incSortNumber($sortNumber, $prevSortNumber);
                if ($data) {
                    $this->ajaxReturn(array('status' => 1, 'msg' => '更新排序成功'), 'json');
                }
                $this->ajaxReturn(array('status' => -1, 'msg' => '更新排序失败'), 'json');
                break;
            default :
                break;
        }
    }

    //编辑分类
    public function ajaxEditCategory() {
        EditDataLogic::checkHost();
        $id = I('post.id', false, 'int');
        $cateName = I('post.catName', false, 'htmlspecialchars');
        $field = array('cat_name' => $cateName);
        $data = EditDataLogic::editData('Category', array('id' => $id), $field);
        if ($data !== FALSE) {
            $this->ajaxReturn(array('status' => 1, 'msg' => '编辑分类成功'), 'json');
        }
        $this->ajaxReturn(array('status' => -1, 'msg' => '编辑分类失败'), 'json');
    }

    //删除分类
    public function ajaxDelete() {
        EditDataLogic::checkHost();
        $id = I('post.id', false, 'int');
        $flag = I('post.flag', false, 'htmlspecialchars');
        switch ($flag) {
            case 'category':
                $where = array('id' => $id);
                $data = EditDataLogic::delData($flag, $where);
                if ($data !== FALSE) {
                    adminLog("删除活动分类");
                    $this->ajaxReturn(array('status' => 1, 'msg' => '删除分类成功'), 'json');
                }
                $this->ajaxReturn(array('status' => -1, 'msg' => '删除分类失败'), 'json');
                break;
            case 'place':
                $where = array('id' => $id);
                $data = EditDataLogic::delData($flag, $where);
                if ($data !== FALSE) {
                    $this->ajaxReturn(array('status' => 1, 'msg' => '删除地点成功'), 'json');
                }
                $this->ajaxReturn(array('status' => -1, 'msg' => '删除地点失败'), 'json');
                break;
            case 'channel':
                $where = array('id' => $id);
                $data = EditDataLogic::delData($flag, $where);
                if ($data !== FALSE) {
                    adminLog("删除推广渠道");
                    $this->ajaxReturn(array('status' => 1, 'msg' => '删除渠道成功'), 'json');
                }
                $this->ajaxReturn(array('status' => -1, 'msg' => '删除渠道失败'), 'json');
                break;
            default :
                $this->ajaxReturn(array('status' => -1, 'msg' => '请求参数有误'), 'json');
                break;
        }
    }

    //权限管理
    public function authInfo() {
        $realname = I('get.realname', false, 'htmlspecialchars');
        if ($realname) {
            $where['realname'] = array('realname' => array('like', "%$realname%"));
        }
        $where = $where['realname'] ? $where['realname'] : NUll;
        $count = AdminModel::init()->where($where)->count();
        $Page = new Page($count, 20);
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $userData = AdminModel::init()->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->show(); // 分页显示输出
        /* 获取小组 */
        $groupData = GroupModel::init()->select();
        $this->assign(array(
            'userData' => $userData,
            'page' => $show,
            'groupData' => $groupData,
        ));
        $this->display();
    }

    //新增用户
    public function addPerson() {
        $parentAuth = AuthModel::init()->where(array('level' => 0))->select();
        $subAuth = AuthModel::init()->where("level in (1,2)")->select();
        $this->assign(array(
            'parentAuth' => $parentAuth,
            'subAuth' => $subAuth,
        ));
        $this->display();
    }

    //查询用户是否存在
    public function ajaxCheckUser() {
        EditDataLogic::checkHost();
        $username = I('post.username');
        $data = EditDataLogic::get_user_info($username);
        if ($data->code != 0) {
            $this->error('该用户名不存在,请重新输入', '', TRUE);
        }
        $this->success('查询成功',$data,TRUE);
    }

    //提交权限
    public function ajaxAddAuth() {
        EditDataLogic::checkHost();
        $data = I("post.act_list", false, "htmlspecialchars");
        $username = I("post.username", false, 'htmlspecialchars');
        if (is_array($data)) {
            $data = implode(",", $data);
        }
        //获取用户的全部信息
        $userData = EditDataLogic::get_user_info($username);
        $cation['username'] = $username;
        $cation['realname'] = $userData->data->realname;
        $cation['act_list'] = $data;
        if (FALSE !== AdminModel::init()->add($cation)) {
            adminLog("设为管理员");
            $this->success('添加权限成功', '', TRUE);
        }
        $this->error('添加权限失败', '', TRUE);
    }

    public function addGroup() {
        $this->assign('title', '新增小组')->display();
    }

    /**
     * ajax增加分组
     */
    public function ajaxAddGroup() {
        EditDataLogic::checkHost();
        $groupName = I('post.groupName');
        $data['group_name'] = $groupName;
        //先查询数据库是否存在
        $info = GroupModel::init()->where(array('group_name' => $groupName))->find();
        if (isset($info)) {
            $this->error('不能重复添加', '', TRUE);
        }
        if (False !== GroupModel::init()->add($data)) {
            $this->success('添加小组成功', '', TRUE);
        }
        $this->error('添加小组失败', '', TRUE);
    }

    public function editGroup() {
        $groupId = I('get.group_id', false, 'int');
        //获取用户的分组
        $data = AdminModel::init()->getData(array('b.id' => $groupId), 'realname,group_name,admin_id');
        $arr = array();
        $arr1 = array();
        foreach ($data as $key => $val) {
            $arr[$key]['realname'] = $val['realname'];
            $arr[$key]['admin_id'] = $val['admin_id'];
        }
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $arr1['group_name'] = $value['group_name'];
            }
        }
        $this->assign(array('data' => $arr1, 'user' => $arr, 'title' => '编辑分组'))->display();
    }

    //搜索 
    public function ajaxSearch() {
        EditDataLogic::checkHost();
        $username = I('post.username');
        $data = AdminModel::init()->where("realname  like '%$username%' OR username like '%$username%'")->field('realname,admin_id')->select();
        if ($data) {
            $this->success('', array('data' => $data), TRUE);
        }
        $this->error('null', '', TRUE);
    }

    /**
     * 添加本组管理员
     */
    public function ajaxAddUser() {
        EditDataLogic::checkHost();
        $adminId = I("post.admin_id");
        $groupId = I("post.groupId", false, 'int');
        $adminId = implode(',', $adminId);
        $where['admin_id'] = array('in', $adminId);
        $data['group_id'] = $groupId;
        if (False !== AdminModel::init()->saveData($where, $data)) {
            $this->success('操作成功', '', TRUE);
        }
        echo AdminModel::init()->_sql();
        die;
        $this->error('操作失败', '', TRUE);
    }

    /**
     * 将管理员从本组中移除
     */
    public function ajaxDeleteUser() {
        EditDataLogic::checkHost();
        $adminId = I('post.adminId');
        $data = array('group_id' => 0);
        if (False !== D('Admin')->saveField(array('admin_id' => $adminId), 'group_id', $value = 0)) {
            $this->success("移除成功", '', TRUE);
        }
        $this->error("移除失败", '', TRUE);
    }

    /**
     * 修改小组名称
     */
    public function ajaxEditGroup() {
        EditDataLogic::checkHost();
        $groupId = I('post.groupId', false, 'int');
        $groupName = I('post.groupName');
        $data['group_name'] = $groupName;
        $info = GroupModel::init()->getOneData(array('group_name' => $groupName));
        if ($info) {
            $this->error('请更换小组名称修改', '', TRUE);
        }
        if (FALSE !== GroupModel::init()->saveData(array('id' => $groupId), $data)) {
            $this->success('操作成功', '', TRUE);
        }
        $this->errror('操作失败', '', TRUE);
    }

    /**
     * 修改权限
     */
    public function editAuth() {
        $adminId = I('get.id', false, 'int');
        $user = AdminModel::init()->getOneData(array('admin_id' => $adminId), 'realname');
        $parentAuth = AuthModel::init()->where(array('level' => 0))->select();
        $subAuth = AuthModel::init()->where(array('level' => 1))->select();
        $this->assign(array(
            'parentAuth' => $parentAuth,
            'subAuth' => $subAuth,
            'realname' => $user['realname'],
            'title' => '修改权限',
        ));
        $this->display();
    }

    /**
     * 修改权限
     */
    public function ajaxEditAuth() {
        EditDataLogic::checkHost();
        $actList = I("post.act_list", false, "htmlspecialchars");
        $adminId = I("post.admin_id", false, 'int');
        if (is_array($actList)) {
            $actList = implode(",", $actList);
        }
        $where['admin_id'] = array('eq', $adminId);
        $data['act_list'] = $actList;
        if (FALSE !== AdminModel::init()->saveData($where, $data)) {
            adminLog("修改管理员权限");
            $this->success("修改权限成功", '', TRUE);
        }
        $this->error("修改权限失败", '', TRUE);
    }

    /**
     * 封禁用户
     */
    public function ajaxClosure() {
        EditDataLogic::checkHost();
        $adminId = I('post.adminId', false, 'int');
        if(!$adminId){
            $this->error('参数有误','',TRUE);
        }
        //查询当前用户的状态
        $info = AdminModel::init()->getOneData(array('admin_id' => $adminId), 'is_lock');
        if ($info['is_lock'] == '正常') {
            $where['admin_id'] = array('eq', $adminId);
            $data['is_lock'] = "禁用";
            if (FALSE !== AdminModel::init()->saveData($where, $data)) {
                $this->success('已禁用', '', TRUE);
            }
            $this->error('禁用失败', '', TRUE);
        }
        $where['admin_id'] = array('eq', $adminId);
        $data['is_lock'] = "正常";
        if (FALSE !== AdminModel::init()->saveData($where, $data)) {
            $this->success('解除禁用成功', '', TRUE);
        }
        $this->error('解除禁用失败', '', TRUE);
    }

    public function adminLog() {
        //获取日志信息
        $logInfo = I('get.log_info');
        if ($logInfo) {
            $where['log_info'] = array('eq', $logInfo);
        }
        $log = M('admin_log')->where($where)->select();
        foreach ($log as $k => $v) {
            $log[$k]['log_time'] = date('Y-m-d H:i:s', $v['log_time']);
        }
        $this->assign('log', $log)->display();
    }

}
