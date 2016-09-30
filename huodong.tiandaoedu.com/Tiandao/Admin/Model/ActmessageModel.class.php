<?php

namespace Admin\Model;

use Think\Model;
use Think\NewPage;

class ActmessageModel extends Model {

    // 定义表单验证的规则
    protected $_validate = array(
        array('act_name', 'require', '活动名称不能为空', 1),
        array('spec_address', 'require', '具体地点不能为空', 1),
        array('act_cost', 'require', '活动经费不能为空', 1),
        array('act_cost', 'currency', '活动经费必须是货币类型', 1),
    );

    //前置
    public function _before_insert(&$data, $option) {
        /**         * *****上传图片******* */
        if (isset($_FILES['act_file']) && $_FILES['act_file']['error'] == 0) {
            $ret = uploadOne('act_file', 'Activity', array(
                array(650, 650),
            ));
            if ($ret['ok'] == 1) {
                $data['act_file'] = getServicePath() . '/Public/Uploads/' . $ret['images'][1];
            } else {
                $this->error = $ret['error'];
                return FALSE;
            }
        }
    }

    public function _before_update(&$data, $option) {
        $id = I('post.act_id', false, 'int');
        /*         * ******上传图片******* */
        if (isset($_FILES['act_file']) && $_FILES['act_file']['error'] == 0) {
            $ret = uploadOne('act_file', 'Activity', array(
                array(750, 405),
            ));
            if ($ret['ok'] == 1) {
                $data['act_file'] = getServicePath() . '/Public/Uploads/' . $ret['images'][1];
            } else {
                $this->error = $ret['error'];
                return FALSE;
            }
            $pic = $this->where(array('act_id' => $id))->field('act_file')->find();
            //销毁本地图片的物理路径
            if ($pic) {
                /*$img = str_replace('thumb_0_', '', $pic['act_file']);
                unlink('./Public/Uploads/' . $img);
                unlink('./Public/Uploads/' . $pic['act_file']);*/
                $str = strrpos($pic['ad_pic'], 'A');
                $imgSub = substr($pic['ad_pic'], $str);
                $img = str_replace('thumb_0_', '', $imgSub);
                unlink('./Public/Uploads/' . $img);
                unlink('./Public/Uploads/' . $imgSub);
            }
        }
    }

    //根据后台条件获取活动
    public function searchData($actname = '', $st = null, $et = null, $currentStatus = null, $realname = null, $placeid = null, $cateid = null, $group_id = null,$act_pub_status=null) {
        $where = array();
        //分组
        if ($group_id) {
            $where['d.group_id'] = array('eq', $group_id);
        }
        //用户名
        if ($realname) {
            $where['a.act_charge_name'] = array('eq', $realname);
        }
        //发布状态
        if ($currentStatus) {
            $where['a.act_current_status'] = array('eq', $currentStatus);
        }
        //活动名称
        if ($actname) {
            $where['a.act_name'] = array('like', "%$actname%");
        }
        //根据时间
        if ($st) {
            $where['a.act_start_date'] = array('egt', strtotime("$st 00:00:00"));
        } elseif ($et) {
            $where['a.act_end_date'] = array('elt', strtotime("$et 23:59:59"));
        }
        //根据地点
        if ($placeid) {
            $placeid = implode(',', $placeid);
            $where['a.place_id'] = array('in', $placeid);
        }
        //根据类型
        if ($cateid) {
            $cateid = implode(',', $cateid);
            $where['a.cat_id'] = array('in', $cateid);
        }
        if($act_pub_status){
            $where['a.act_pub_status'] = array('eq',$act_pub_status);
         }
        //返回搜索数据
        return $this->getSearchData($where);
    }
    
    //根据前台搜索条件获取前台数据
    public function getHomeDataList($placeName=null,$catName=null,$time=null,$limit=null,$actId=null,$sortData=null){
         if($placeName){
             $where['b.place_name'] = array('eq',$placeName);
         } 
         if($catName){
             $where['c.cat_name'] = array('eq',$catName);
         }
         if($time){
             $where['a.act_start_date'] = array('egt',strtotime("$time 00:00:00"));
         }
         if($actId){
             $where['a.act_id']  = array('eq',$actId);
          }
          //默认排序
          if($sortData && $sortData =='mrpx'){
              $order = "a.act_is_top ASC,a.act_id ASC";
          }
          if($sortData && $sortData == "jgcddg"){
              $order = "a.act_cost ASC";
          }
          if($sortData && $sortData == "jgcgdd"){
              $order = "a.act_cost DESC";
          }
          if($sortData && $sortData == 'zxsx'){
              $order = "a.act_id DESC";
          }
          //最近开始的活动
          if($sortData && $sortData == 'zjks'){
              $where['a.act_start_date'] = array('egt',time());
              $order = "a.act_id ASC";
          }
         //上线的
         $where['a.act_current_status'] = array('eq',4);
         $where['a.act_date'] = array('elt',time());
         return $this->numData($where,$limit,$order);
    }

    //获取搜索的信息
    public function getSearchData($where) {
        $count = $this->getCount($where);
        $Page = new NewPage($count, 4);
        $show = $Page->fpage(array(4, 5, 6));
        $data = $this->numData($where, $Page->limit);
        return array('data' => $data, 'page' => $show);
    }

    //获取总的条数
    public function getCount($where) {
        return $this->alias('a')->join('LEFT JOIN __PLACE__ b ON b.id = a.place_id LEFT JOIN __CATEGORY__ c on c.id = a.cat_id LEFT JOIN __ADMIN__ d ON d.realname = a.act_charge_name')->where($where)->count();
    }

    //获取总的记录数
    public function numData($where=NULL, $limit = NULL,$order='a.act_is_top ASC,a.act_id DESC') {
        return $this->alias('a')->join('LEFT JOIN __PLACE__ b ON b.id = a.place_id LEFT JOIN __CATEGORY__ c on c.id = a.cat_id LEFT JOIN __ADMIN__ d ON d.realname = a.act_charge_name')->field('a.*,b.place_name,b.id as place_id,c.cat_name,c.id as cat_id,d.*')->where($where)->limit($limit)->order($order)->select();
    }
    //获取所有的活动
    public function getAllData($where = null, $field = null, $limit = null) {
        return $this->where($where)->limit($limit)->field($field)->select();
    }

    //获取一条活动信息
    public function getOneData($where = null, $field = null) {
        return $this->where($where)->field($field)->find();
    }

    //删除活动信息
    public function deleteData($where = null) {
        return $this->where($where)->delete();
    }

    //修改数据
    public function saveData($where = null, $data = null) {
        return $this->where($where)->save($data);
    }

    //活动下线
    public function outLine($where = null, $value = null) {
        return $this->where($where)->setField('act_current_status', $value);
    }

    //置顶
    public function saveTop($where, $data) {
        return $this->where($where)->setField($data);
    }

    //获取当前的状态
    public function getCurrentStatus($data,$act_date) {
        switch ($data) {
            case 1:
                return '未发布';
                break;
            case 2:
                return '待审核';
                break;
            case 3:
                return '审核通过';
                break;
            case 4:
                if($act_date <= time()){
                    return '已上线';
                }else{
                    return '审核通过';
                }
                break;
            case 5:
                return '已结束';
                break;
            case 6:
                return '驳回';
                break;
            default:
                break;
        }
    }

    public function setData($data){
        $data['act_current_status']  = 1;
        $data['act_success_time']    = time();
        $data['act_start_date']  = strtotime($data['act_start_date'].$data['act_start_time']);
        $data['act_end_date']  =  strtotime($data['act_end_date'].$data['act_end_time']);
        if (!empty($data['act_date']) && !empty($data['act_time'])) {
            $data['act_date'] = strtotime($data['act_date'].$data['act_time']);
        }
        unset($data['act_start_time']);
        unset($data['act_end_time']);
        unset($data['act_time']);
        return $data;
    }

    //判断是否有值并转换为时间戳
   /* public function setData($data) {
        $data['act_current_status'] = 1;
        $data['act_success_time'] = time();
        //根据选择状态判断开始日期和结束日期
        if ($data['act_time_status'] == 0) {
            $data['act_start_date'] = strtotime(date('Y-m-d'));
            $data['act_start_time'] = time();
            $data['act_end_date'] = strtotime(date('Y-m-d'))+12*3600;
        } elseif ($data['act_time_status'] == 1) {
            $data['act_start_date'] = strtotime($data['start_date']);
            $data['act_start_time'] = strtotime($data['start_time']);
            $data['act_end_date'] = strtotime($data['end_date']);
            $data['act_end_time'] = strtotime($data['end_time']);
        } else {
            $data['act_start_date'] = strtotime($data['act_start_date']);
            $data['act_start_time'] = strtotime($data['act_start_time']);
            $data['act_end_date'] = strtotime($data['act_end_date']);
            $data['act_end_time'] = strtotime($data['act_end_time']);
        }

        if (!empty($data['act_week'])) {
            $data['act_week'] = implode(',', $data['act_week']);
        }

        if (!empty($data['act_date']) && !empty($data['act_time'])) {
            $data['act_date'] = strtotime($data['act_date']);
            $data['act_time'] = strtotime($data['act_time']);
        }
        unset($data['start_date']);
        unset($data['start_time']);
        unset($data['end_date']);
        unset($data['end_time']);
        return $data;
    }*/

    //时间戳转换
//    public function dataTrans($data1,$data2,$data3,$data4) {
//        $data['act_start_date'] = date('Y-m-d', $data1);
//        $data['act_end_date'] = date('Y-m-d', $data2);
//        $data['act_start_time'] = date('H:i', );
//        $data['act_end_time'] = date('H:i', $info['act_end_date']);
//        $data['act_date'] = date('Y-m-d', $info['act_date']);
//        $data['act_time'] = date('H:i', $info['act_time']);
//        return $data;
//    }

    //添加和修改前的数据处理
    public function makeData($data) {
        if (!empty($data['act_week'])) {
            $data['act_week'] = implode(',', $data['act_week']);
        }

        if (!empty($data['act_date']) && !empty($data['act_time'])) {
            $data['act_date'] = strtotime($data['act_date']);
            $data['act_time'] = strtotime($data['act_time']);
        }
        $data['act_success_time'] = time();
        return $data;
    }


}
