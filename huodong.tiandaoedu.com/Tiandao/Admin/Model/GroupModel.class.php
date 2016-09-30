<?php

namespace Admin\Model;

use Think\Model;

class GroupModel extends Model {

    public static function init() {
        return new self;
    }

    //增加数据
    public function addData($data) {
        return $this->add($data);
    }

    //修改数据
    public function saveData($where = NULL, $data = NULL) {
        return $this->where($where)->save($data);
    }

    public function getOneData($where) {
        return $this->where($where)->find();
    }

}
