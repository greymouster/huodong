<?php

namespace Admin\Model;

use Think\Model;

class AdModel extends Model {

    //允许接收的字段
    protected $insertFields = 'ad_name,ad_link,media_type,sort_number,ad_pic,ad_time';
    //允许修改的字段
    protected $updateFields = 'ad_id,ad_name,ad_link,media_type,sort_number,ad_pic,ad_time';
    protected $_validate = array(
        array('ad_name', 'require', '广告名称不能为空', 1),
        array('ad_link', 'require', '广告链接不能为空', 1),
    );

    public function _before_insert(&$data, $option) {
        $data['ad_time'] = time();
        $adNameSort = explode('-',$data['ad_link']);
        //var_dump($adNameSort);die;
        //获取广告名称的简称
        $data['ad_name_sort'] = $adNameSort[3];
        /*         * *********************上传图片******* */
        if (isset($_FILES['ad_pic']) && $_FILES['ad_pic']['error'] == 0) {
            $ret = uploadOne('ad_pic', 'Ad', array(
                array(720, 405),
            ));
            if ($ret['ok'] == 1) {
                $data['ad_pic'] = getServicePath() . '/Public/Uploads/' . $ret['images'][1];
            } else {
                $this->error = $ret['error'];
                return FALSE;
            }
        }
    }

    protected function _before_update(&$data, $option) {
        $id = I('post.ad_id', false, 'int');
        $adNameSort = explode('-',$data['ad_link']);
        //var_dump($adNameSort);die;
        //获取广告名称的简称
        $data['ad_name_sort'] = $adNameSort[3];
        /*         * ******************上传图片******* */
        if (isset($_FILES['ad_pic']) && $_FILES['ad_pic']['error'] == 0) {
            $ret = uploadOne('ad_pic', 'Ad', array(
                array(720, 405),
            ));
            if ($ret['ok'] == 1) {
                $data['ad_pic'] = getServicePath() . '/Public/Uploads/' . $ret['images'][1];
            } else {
                $this->error = $ret['error'];
                return FALSE;
            }
        }
        $pic = $this->field('ad_pic')->find($id);
        if ($pic) {
            $str = strrpos($pic['ad_pic'], 'A');
            $imgSub = substr($pic['ad_pic'], $str);
            $img = str_replace('thumb_0_', '', $imgSub);
            unlink('./Public/Uploads/' . $img);
            unlink('./Public/Uploads/' . $imgSub);
        }
    }

    protected function _before_delete($option) {
        $id = I('post.adId', false, 'int');
        $pic = $this->field('ad_pic')->find($id);
        if ($pic) {
            $str = strrpos($pic['ad_pic'], 'A');
            $imgSub = substr($pic['ad_pic'], $str);
            $img = str_replace('thumb_0_', '', $imgSub);
            unlink('./Public/Uploads/' . $img);
            unlink('./Public/Uploads/' . $imgSub);
        }
    }

    //删除数据
    public function deleteData($where = null) {
        return $this->where($where)->delete();
    }

    //获取数据
    public function getAllData($where = NULL, $field = NULL,$order=NULL,$limit=NUll) {
        return $this->where($where)->field($field)->order($order)->limit($limit)->select();
    }

}
