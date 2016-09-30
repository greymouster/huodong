<?php

class ActivityAction extends BaseAction{
	
	public function index(){
		
		//获取首页轮播图片
		$pic = $this->_getAdData(array('type'=>1));
		
		//获取分类
		$catPic = $this->_getAdData(array('type'=>2,'limit'=>3));
		
		//获取小道推荐
		$recomPic = $this->_getAdData(array('type'=>3));
		
		//获取热门活动推荐
		$hotPic = $this->_getAdData(array('type'=>4,'limit'=>1));

        //获取活动
        $url = C('ACTIVITY_URL').getActList;
        $info = json_decode(get($url));
        $actList = $this->getChangeData($info,TRUE);
		//日期转换
		//$actList[0]['act_week'] = $this->changeDate($actList[0]['act_week']);
		$this->assign(array(
		    'tdk'=> C('activity_index'),//tdk
			'pic' => $pic,
			'catpic' => $catPic,
			'recompic' => $recomPic,
			'hotPic' => $hotPic,
            'actList'=> $actList
		))->display();
	}
	
	//根据类型不同获取广告接口数据
	public function _getAdData($data){
		$url = C('ACTIVITY_URL').getAdData;
		$info = json_decode(post($url,$data));
		//请求接口成功
		if($info->status == 1){
			$arr = objarray_to_array($info->data);
			$arr = $this->getData($arr);
		}
		return $arr;
	}
	
	//活动列表页面
	public function actList(){
		//获取城市
		$url = C('ACTIVITY_URL').getCity;
		$info  = json_decode(get($url));
		if($info->status == 1){
			$cityData = objarray_to_array($info->data);
			foreach($cityData as $k=>$v){
				$cityData[$k]['place_name'] = iconv('utf-8','gbk',$v['place_name']);
                $abbshort = $v['abb_short'];
                $cityData['city'][$abbshort] =$cityData[$k]['place_name'];
			}
		}
        //获取全部类型
		$url = C('ACTIVITY_URL').getCateData;
		$catInfo = json_decode(get($url));
		if($catInfo->status == 1){
			$cate = objarray_to_array($catInfo->data);
			foreach($cate as $k=>$v){
				$cate[$k]['cat_name'] = iconv('utf-8','gbk',$v['cat_name']);
                $abbshort = $v['abb_short'];
                $cate['cate'][$abbshort] = $cate[$k]['cat_name'];
			}
		}
		
		//获取全部的活动列表
        $catName = I('get.catName')=="all" ?  '' : I('get.catName');
        $city = I('get.city') == "all" ? '' :I('get.city');
        $time = I('get.time') == "all" ? '' :I('get.time');
		$sort = I('get.more') == "all" ? '' :I('get.more');
        //请求接口获取活动数据
        $listUrl = C('ACTIVITY_URL').getActList;
        if($catName || $city || $time || $sort){
            $actInfo = json_decode(post($listUrl,array('catName'=>$catName,'city'=>$city,'time'=>$time,'sort'=>$sort)));
        }else{
            $actInfo = json_decode(get($listUrl));
        }
		$actList = $this->getChangeData($actInfo,TRUE);
		//$actList[0]['act_week'] = $this->changeDate($actList[0]['act_week']);
        //获取tdk
		$cat_name = iconv('utf-8','gbk',$actList[0]['cat_name']);
		$sortStr = C('sort_str');
        $tdk = getActListTDK($actList[0]['place_name'],$time,$cat_name,$sortStr[$sort]);
		$this->assign(array(
		    'tdk'=> $tdk,
		    'cityData' => $cityData,  //城市数据
			'cate' => $cate,         //类型
			'actList' => $actList,   //活动信息
            'catName' => $catName,   //接收的类型简称
            'placeName' => $city,   //接收的地点简称
            'time'   => $time,       //接收 的时间
			'sort'   => $sort       //排序方式
		))->display();
	}
    
    /**
     * 活动详情页
     */
	public function act_detail(){
	    $actId = I('get.act_id',false,'int');
		$channel_id = I('get.channel_id',false,'int');
        if($actId){
            $listUrl = C('ACTIVITY_URL').getActList;
            $actInfo = json_decode(post($listUrl,array('act_id'=>$actId,'catName'=>'','city'=>'','time'=>'','sort'=>'')));
            $actList = $this->getChangeData($actInfo,TRUE);
			//是否报名
			$url = C('ACTIVITY_URL').getBmData;
			$userId = session('user_id');
			$info = json_decode(post($url,array('user_id'=>$userId,'act_id'=>$actId)));
			if($info->status == 1 && !empty($info->result)){
			    $bm = 1;
			}
		}
	    //获取收藏活动的id
		$url = C('ACTIVITY_URL').getAllCollect;
		$userId = session('user_id');
		$info = json_decode(post($url,array('user_id'=>$userId)));
		if($info->status == 1 && !empty($info->result)){
			$data = objarray_to_array($info);
		    foreach($data['result'] as $k=>$v){
			    $actIds[$k] = $v['act_id'];
			}
			if(in_array($actId,$actIds)){
				$style = 1;
			}	
		}
	    $this->assign(array(
		    'tdk' => C('act_detail'),
			'val' => $actList[0],
			'style' => $style,
			'bm' => $bm,
		))->display();
    }
    
	/**
	 *收藏活动
	 */
    public function collectAct(){
		if(IS_POST && IS_AJAX){
			$actId = I('post.actId',false,'int');
			//先判断用户是否登录
			if(!session('user_id')){
				$this->ajaxReturn(array('status'=>-1,'msg'=>'收藏前请先登录'),'json');
			}
			//先根据用户查询收藏的活动id
            $userId = session('user_id');
			$url = C('ACTIVITY_URL').getOneCollect;
			$collectInfo = json_decode(post($url,array('user_id'=>$userId,'act_id'=> $actId)));
	        if($collectInfo->status == 1 && !empty($collectInfo->result)){
				$this->ajaxReturn(array('status'=>-2,'msg'=>'此活动已收藏'));
			}
			$url = C('ACTIVITY_URL').actCollect;
			$addInfo = json_decode(post($url,array('user_id'=>$userId,'act_id'=> $actId)));
			if($addInfo->status == 1){
				$this->ajaxReturn(array('status'=>1,'msg'=>'收藏成功'));
			}
			$this->ajaxReturn(array('status'=>-2,'msg'=>'收藏失败'));
		}
	}
	
	/**
	 *活动报名页面
	 */
	
	public function act_bm(){
		$actId = I('get.act_id',false,'int');
		if(!$actId){
			return false;
		}
		//是否登录
		if(!session('user_id')){
			$this->redirect('Ucenter/login');
		}
		$url = C('ACTIVITY_URL').getFormData;
        $formInfo = json_decode(post($url,array('actId'=>$actId)));
		if($formInfo->status == 1){
			$formData = array_iconv('utf-8','gbk',objarray_to_array($formInfo->data));
			$htmlTmp = "";
			foreach($formData as $k=>$v){
				if(is_array($v)){
					if($v['Type'] == 'input'){
						 $htmlTmp .= '<div class="form-group">';
                         $htmlTmp .= '<label>'.$v['Title'].'</label>';
                         $htmlTmp .= '<input type="hidden" name="key[]" value="'.$v["Title"].'">';
						 if($v['Required']){
							$htmlTmp .= '<input type="text" name="items[]'.$k.'" placeholder="'.$v["Description"].'" required=required />'; 
						 }else{
							$htmlTmp .= '<input type="text" name="items[]'.$k.'" placeholder="'.$v["Description"].'" />';
						 }
						 
						 $htmlTmp .= '</div>';
					}elseif($v['Type'] == 'select'){
						if($v['Subitems'] !=null && count($v['Subitems'])>0){
							$htmlTmp .= '<div class="form-group">';
							$htmlTmp .= '<label>'.$v['Title'].'</label>';
						    $htmlTmp .= '<input type="hidden" name="key[]" value="'.$v["Title"].'">';
							if($v['Required']){
							   $htmlTmp .= '<select name="items[]'.$k.'" required>';	
							}else{
								$htmlTmp .= '<select name="items[]'.$k.'" >';
							}
							$htmlTmp .= '<option value="">'.iconv('utf-8','gbk','请选择').'</option>';
							foreach($v['Subitems'] as $k1=>$v1){
								$htmlTmp .='<option value="'.$v1.'">'.$v1.'</option>"';
							}
							$htmlTmp .= '</select></div>';
 						}
					}elseif($v['Type'] == 'textarea'){
						$htmlTmp .= '<div class="form-group">';
                        $htmlTmp .='<label>'.$v['Title'].'</label>';
                        $htmlTmp .= '<input type="hidden" name="key[]" value="'.$v["Title"].'">';
						if($v['Required']){
							$htmlTmp .='<textarea name="items[]'.$k.'" rows="10" cols="20" placeholder ="'.$v['Description'].'" required></textarea>';
						}else{
							$htmlTmp .='<textarea name="items[]'.$k.'" rows="10" cols="20" placeholder ="'.$v['Description'].'"></textarea>';
						}
						
                        $htmlTmp .='</div>';
						
					}elseif($v['Type'] == 'radio'){
						if ($v['Subitems'] !=null && count($v['Subitems'])>0) {
							$htmlTmp .='<div class="form-group">';
							$htmlTmp .= '<input type="hidden" name="key[]" value="'.$v["Title"].'">';
							$htmlTmp .='<label>'.$v['Title'].'</label>';
							$htmlTmp .='<div class="radio">';
							foreach($v['Subitems'] as $k1=>$v1){
								$htmlTmp .='<span><input type="'.$v['Type'].'" name="items[]'.$k.'" value="'.$v1.'" />&nbsp'.$v1.'</span>';
							}
                        }
						$htmlTmp .='</div></div>';
					}elseif($v['Type'] == 'checkbox' ){
						if ($v['Subitems'] !=null && count($v['Subitems'])>0) {
							$htmlTmp .='<div class="form-group">';
							$htmlTmp .= '<input type="hidden" name="key[]" value="'.$v["Title"].'">';
							$htmlTmp .='<label>'.$v['Title'].'</label>';
							$htmlTmp .='<div class="radio">';
							foreach($v['Subitems'] as $k1=>$v1){
								$htmlTmp .='<span><input type="'.$v['Type'].'" name="items['.substr($k,5).'][]" value="'.$v1.'" />&nbsp'.$v1.'</span>';
							}
                        }
						$htmlTmp .='</div></div>';
					}
					
				}
			}
		}
		$this->display();
	}
	
	/**
	 *我的活动
	 */
	public function act_me(){
		$userId = session('user_id');
		//是否登录
		if(!userId){
			$this->redirect('Ucenter/login');
		}
		//获取报名成功并且审核通过的活动
		$bm_url = C('ACTIVITY_URL').getUnderwayData;
		$underwayInfo = json_decode(post($bm_url,array('user_id'=>$userId)));
		$underwayData = $this->getChangeData($underwayInfo,TRUE);
		//获取收藏的活动
		$collect_url = C('ACTIVITY_URL').userActData;
		$actInfo = json_decode(post($collect_url,array('user_id'=>$userId)));
		$actData = $this->getChangeData($actInfo,TRUE);
		//获取已结束的活动
		$url = C('ACTIVITY_URL').getEndData;
		$endInfo = json_decode(post($url,array('user_id'=>$userId)));
		$endData = $this->getChangeData($endInfo,TRUE);
		
		//获取待确认的活动
		$confirm_url = C('ACTIVITY_URL').getConfirmData;
		$confirmInfo = json_decode(post($confirm_url,array('user_id'=>$userId)));
		$confirmData = $this->getChangeData($confirmInfo,TRUE);
		$this->assign(array(
		    'actData' => $actData,
			'endData' => $endData,
			'underwayData'=> $underwayData,
			'confirmData' => $confirmData
		))->display();
	}
	
	
	/**
	 *取消收藏
	 */
	public function delCollect(){
		if(IS_AJAX && IS_POST){
			$actId = I('post.actId',false,int);
			$userId = session('user_id');
			if(!$actId){
				exit(json_encode(array('status'=>-1,'msg'=>'删除失败')));
			}
			$url = C('ACTIVITY_URL').delCollect;
			$delInfo = json_decode(post($url,array('act_id'=>$actId,'user_id'=>$userId)));
			if($delInfo->status == 1){
				$collect_url = C('ACTIVITY_URL').userActData;
		        $actInfo = json_decode(post($collect_url,array('user_id'=>$userId)));
        		$actData = $this->getChangeData($actInfo);
                exit(json_encode(array('status'=>1,'msg'=>'删除成功','data'=>$actData)));				
			}
			exit(json_encode(array('status'=>-1,'msg'=>'删除失败')));
		}
		
	}
	
	/**
	 *提交报名
	 */
	public function submitFormData(){
		if(IS_POST){
			$data = I('post.');
			$data['user_id'] = session('user_id');
			//先根据用户id 和活动id 去查询是否以报名
			if(!$data['user_id']){
				exit(json_encode(array('status'=>0,'msg'=>'请先登录')));
			}
			if(!$data['user_name']){
				exit(json_encode(array('status'=>-1,'msg'=>'请输入您的姓名')));
			}
			if(!checkPhone($data['phone'])){
				exit(json_encode(array('status'=>-1,'msg'=>'请输入正确的手机号')));
			}
			if(!checkEmail($data['email'])){
				exit(json_encode(array('status'=>-1,'msg'=>'请输入正确的邮箱')));
			}
			$url = C('ACTIVITY_URL').addBmData;
			
			$actInfo = json_decode(post($url,$data));
			if($actInfo->status == 1){
				exit(json_encode(array('status'=>1,'msg'=>$actInfo->msg)));
			}
			exit(json_encode(array('status'=>-1,'msg'=>$actInfo->msg)));
			
		}
	}
	
	
	
	//转换活动信息数据
	private function getChangeData($actInfo,$flag=false){
		if($actInfo->status != 1){
			return false;
		}
		$data = objarray_to_array($actInfo->data);
		foreach($data as $k=>$v){
			if($flag == TRUE){
				$data[$k]['act_name'] = iconv('utf-8','gbk',$v['act_name']);
				$data[$k]['act_charge_name'] = iconv('utf-8','gbk',$v['act_charge_name']);
				$data[$k]['act_start_date'] = iconv('utf-8','gbk',date('m月d日',$v['act_start_date']));
			    $data[$k]['act_end_date'] = iconv('utf-8','gbk',date('m月d日',$v['act_end_date']));
			    $data[$k]['place_name'] = iconv('utf-8','gbk',$v['place_name']);
				$data[$k]['spec_address'] = iconv('utf-8','gbk',$v['spec_address']);
                $data[$k]['act_desc'] = htmlspecialchars_decode(iconv('utf-8','gbk',$v['act_desc']));
				$data[$k]['act_how_part']= htmlspecialchars_decode(iconv('utf-8','gbk',$v['act_how_part']));
			    $data[$k]['cat_name'] = iconv('utf-8','gbk',$v['cat_name']);
			}else{
			    $data[$k]['act_start_date'] = date('m月d日',$v['act_start_date']);
			    $data[$k]['act_end_date'] = date('m月d日',$v['act_end_date']);
			}
			$data[$k]['act_start_time'] = date('H:i',$v['act_start_date']);
			$data[$k]['act_end_time'] = date('H:i',$v['act_end_date']);	
		}
		return $data;
	}
	
	//广告位数据转换编码
	public  function getData($arr){
		foreach($arr as $key=>$val){
			if(strpos($val['ad_link'],'http://') === false){
			   $arr[$key]['ad_link'] = "http://".$val['ad_link'];
			}
			$arr[$key]['ad_name'] = iconv('utf-8','gbk',$val['ad_name']);
		}
		return $arr;
	}

	
	//我的入场劵
	public function myTicket(){
		$actId = I('get.act_id', false, 'int');
        $userId = I('get.user_id', false, 'int');
        $QR = "./Public/Uploads/QR/".$actId.'-'. $userId . 'qrcode.png';
        vendor('phpqrcode.phpqrcode');
        \QRcode::png($actId.'-'.$userId, $QR, QR_ECLEVEL_L, 7, 2);
		$bm_url = C('ACTIVITY_URL').getUnderwayData;
		$underwayInfo = json_decode(post($bm_url,array('act_id'=>$actId)));
		$underwayData = $this->getChangeData($underwayInfo,TRUE);
		$this->assign(array(
		    'QR' => "/".$QR ,
			'val' => $underwayData[0],
		))->display();
	}
	
	
	
	//获取活动收藏总数的接口
	public function getCollectTotal(){
		$actId = I('post.actId',false,'int');
		$data = UserActModel::init()->where(array('act_id'=>$actId))->count();
		$data = (int)$data >0 ? (int)$data : 0;
		exit(json_encode(array('status'=>1,'msg'=>'请求成功','data'=>$data)));
	}
	
}