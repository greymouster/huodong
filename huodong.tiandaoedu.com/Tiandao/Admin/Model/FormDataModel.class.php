<?php

namespace Admin\Model;
use Think\Model;

class FormDataModel extends Model{
    
    protected  $tableName = "form_data";
    
    //获取一条数据
    public function  getOneData($where){
        return $this->where($where)->find();
    } 
    
    //添加
    public function addData($actId,$data){
        $sql = "INSERT INTO td_form_data(act_id,form_data)  VALUES ($actId,'{$data}')";        
        return $this->execute($sql);
    }

    public function deleData($where){
        return $this->where($where)->delete();
    }
    public static function init(){
        return new self;
    }
}