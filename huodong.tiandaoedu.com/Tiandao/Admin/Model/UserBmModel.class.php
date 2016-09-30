<?php

namespace Admin\Model;
use Think\Model;
use Think\Page;
class UserBmModel extends Model{
    public function addData($data=null){
        return $this->add($data);
    }

    public function getOneData($where=null){
        return $this->where($where)->find();
    }
    //根据搜索条件获取分页
    public function searchData($actname = null, $startData = null, $endData = null) {
        $where = array();
        if ($actname) {
            $where['act_name'] = array('eq', $actname);
        }
        if ($startData) {
            $where['act_start_date'] = array('egt', strtotime("$startData 00:00:00"));
        }
        if ($endData) {
            $where['act_end_date'] = array('elt', strtotime("$endData 23:59:59"));
        }
        $count = $this->getCount($where);
        $page = new Page($count, 1);
        $show = $page->show();
        $data = $this->getAllData($where,$page->firstRow . ',' . $page->lastRows);
        return array('data' => $data, 'page' => $show);
    }

    public function getAllData($where=null,$limit=null){
        return $this->alias('a')->join('LEFT JOIN __ACTMESSAGE__  b ON a.act_id = b.act_id ')->field($field)->where($where)->limit($limit)->select();
    }

    public function getCount(){
        return $this->alias('a')->join('LEFT JOIN __ACTMESSAGE__  b ON a.act_id = b.act_id ')->where($where)->count();
    }
    //更新字段值
    public function saveField($where = null, $field = null, $value = null) {
        return $this->where($where)->setField($field, $value);
    }

    public function actData($where=null,$field=null){
        return $this->alias('a')->join('LEFT JOIN __ACTMESSAGE__ b ON a.act_id = b.act_id LEFT JOIN __PLACE__ c  ON b.place_id = c.id LEFT JOIN __CATEGORY__ d ON b.cat_id = d.id')->field($field)->where($where)->select();
    }

}