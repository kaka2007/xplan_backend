<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController{

	public function getCoach($pageNum=NULL){
		$managerTip="：后台管理：教练管理";

		$rowCount=M("user_info")->where("type=1")->count();
		$pageSize=10;
		$offset=0;
		$url="User/getCoach";
		$rowPage=getPage($rowCount,$pageSize,$pageNum,$url);
		$offset=$rowPage['offset'];

		$coach=M("user_info")->where("type=1")->limit($offset,$pageSize)->select();
		foreach ($coach as $k => $v) {

			$coach[$k]['count']=M("xorder")->where("coachid={$v['id']}")->count();
		}
		$count=M("user_info")->where("type=1")->count();

		$this->assign("count",$count);
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset+1);
		$this->assign("pageList",$rowPage['show']);
		$this->assign("coach",$coach);
		$this->display("coach");
	}

	public function getStudent($pageNum=NULL){
		$coachid=$_GET['coachid'];
		$url="User/getStudent";
		if($coachid!=""){
			$sql1="SELECT count(*) AS count FROM xorder WHERE coachid={$coachid} ORDER BY time_end DESC";
			$rowCount=M()->query($sql1);
			$rowCount=$rowCount[0]['count'];
			$pageSize=10;
			$offset=0;

			$rowPage=getPageC($rowCount,$pageSize,$pageNum,$url,$coachid);
			$offset=$rowPage['offset'];
			$sql2="SELECT x.time_end,u.id,u.name,u.gender FROM xorder AS x LEFT JOIN user_info AS u ON x.uid=u.id WHERE x.coachid={$coachid} ORDER BY x.time_end DESC LIMIT {$offset},{$pageSize}";
			$student=M()->query($sql2);

			foreach($student as $k=>$v){
			$time_end=$student[$k]['time_end'];
			$student[$k]['time_end']=date("Y-m-d H:i:s",$time_end);
			}

		}else{
		$rowCount=M("xorder")->where("status=1")->count();

		$pageSize=10;
		$offset=0;
		$rowPage=getPage($rowCount,$pageSize,$pageNum,$url);
		$offset=$rowPage['offset'];


		$sql="SELECT * FROM xorder AS x INNER JOIN user_info AS u ON x.uid=u.id WHERE x.status=1 ORDER BY x.time_end DESC LIMIT {$offset},{$pageSize}";
		$student=M()->query($sql);

		foreach($student as $k=>$v){
		$time_end=$student[$k]['time_end'];
		$student[$k]['time_end']=date("Y-m-d H:i:s",$time_end);
			}
		}

		$managerTip="：后台管理：学员管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset+1);
		$this->assign("pageList",$rowPage['show']);
		$this->assign("count",$rowCount);
		$this->assign("student",$student);
		$this->display("student");
	}

	public function getUserInfo($uid){
		$userInfo=M("user_info")->where("id={$uid}")->find();
		$birth=$userInfo['birthday'];
		$tt=time()-$birth;
		$sec=365*86400;
		$userInfo['birthday']=floor($tt/$sec);

		$userInfo['regtime']=date("Y-m-d H:i:s",$userInfo['regtime']);

		$this->assign("userInfo",$userInfo);
		$this->display("userInfo");
	}

	public function updateStatus($status,$id){
		$studentNums=M("user_info")->where("id={$id} and type=1")->getField("studentNums");
		$sql = 'SELECT DISTINCT uid  FROM my_plan WHERE coachid='.$id;
        $result= M("my_plan")->query($sql);
        $nums=count($result);
        if($nums<$studentNums){
			$aff1=M("user_info")->where("id={$id}")->save(array("studentNums"=>0));
		}


		if($status==0){
			$aff=M("user_info")->where("id={$id}")->save(array("status"=>1));
		}else if($status==1){

			if($studentNums==0){

				$aff2=M("user_info")->where("id={$id}")->save(array("studentNums"=>10));
				
				}

			$aff=M("user_info")->where("id={$id}")->save(array("status"=>0));
		}

		if($aff>0){
			$this->success("修改成功",__ENTRY__."/home/User/getCoach");
		}else{
			$this->success("修改失败",__ENTRY__."/home/User/getCoach");
		}
	}

	public function getCourseCoach($uid,$time_end){
		$time_end=strtotime($time_end);
		$coach=M("user_info")->where("type=1")->select();

		$sql="SELECT x.uid,x.pid,x.coachid,x.time_end,u.name FROM xorder AS x LEFT JOIN user_info AS u ON x.uid=u.id WHERE x.uid={$uid} AND x.status=1 ORDER BY x.time_end DESC";
		$plan=M()->query($sql);

		foreach($plan as $k=>$v){
			$plan[$k]['cname']=M("user_info")->where("id={$v['coachid']}")->getField("name");
			$plan[$k]['status']=M("my_plan")->where("uid={$v['uid']} AND pid={$v['pid']} AND coachid={$v['coachid']} AND pay_time={$v['time_end']}")->getField("status");
			$plan[$k]['pay_time']=date("Y-m-d H:i:s",$v['time_end']);
			$plan[$k]['plan']=M("plan")->where("id={$v['pid']}")->getField("title");
		}
		// echo "<pre>";
		// print_r($plan);
		// echo "</pre>";

		$managerTip="：后台管理：学员管理";
		$this->assign("managerTip",$managerTip);		
		$this->assign("count",count($plan));
		$this->assign("coach",$coach);
		$this->assign("plan",$plan);
		$this->display("changeCoach");
	}

	public function changeCoach($uid,$pid,$oldcid,$newcid,$paytime){
		$paytime=strtotime($paytime);
		$time_end=date("Y-m-d H:i:s",$paytime);
		$aff1=M("my_plan")->where("uid={$uid} AND coachid={$oldcid} AND pid={$pid} AND pay_time={$paytime}")->save(array("coachid"=>$newcid));

		 if($aff1){

		 $aff2=M("xorder")->where("uid={$uid} AND coachid={$oldcid} AND pid={$pid} AND time_end={$paytime}")->save(array("coachid"=>$newcid));

		 	if($aff2){
		 		$this->success("更换成功",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$time_end}");
		 	}else{
		 		$this->success("更换失败2",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$time_end}");
		 	}
		 }else{
		 	$this->success("更换失败1",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$time_end}");
		}

	}

	public function updateStatusAndTime($uid,$coachid,$pid,$paytime){

		$paytime=strtotime($paytime);

		$userInfo=M("my_plan")->where("uid={$uid} AND coachid={$coachid} AND pid={$pid} and pay_time={$paytime}")->group("pay_time")->select();
		
		foreach($userInfo as $k=>$v){
			$userInfo[$k]['name']=M("user_info")->where("id={$uid}")->getField("name");
			$userInfo[$k]['cname']=M("user_info")->where("id={$coachid}")->getField("name");
			$userInfo[$k]['begin_time']=date("Y-m-d",$v['begin_time']);
			$userInfo[$k]['end_time']=date("Y-m-d",$v['end_time']);
			if($v['status']==0){
				$userInfo[$k]['cstatus']="未付款";
			}else if($v['status']==1){
				$userInfo[$k]['cstatus']="已付款";
			}else if($v['status']==2){
				$userInfo[$k]['cstatus']="完成测试";
			}else if($v['status']==3){
				$userInfo[$k]['cstatus']="课程好";
			}else if($v['status']==4){
				$userInfo[$k]['cstatus']="已到期";
			}
		}
/*		echo "<pre>";
		print_r($userInfo);
		echo "</pre>";*/
		$managerTip="：后台管理：学员管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("userInfo",$userInfo);
		$this->display("changeStatus");
	}

	public function searchCoach(){
		$keyword=$_POST['keyword'];
		$searchType=$_POST['searchType'];

		$sql="SELECT * FROM user_info WHERE {$searchType} LIKE '%{$keyword}%' AND type=1";
		$coach=M()->query($sql);


		foreach ($coach as $k => $v) {		
			$coach[$k]['count']=M("xorder")->where("coachid={$v['id']}")->count();
		}
		$offset=1;

		$managerTip="：后台管理：教练管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset);
		$this->assign("coach",$coach);
		$this->display("coach");
	}
	public function searchStudent(){
		$keyword=$_POST['keyword'];
		$searchType=$_POST['searchType'];

		$sql="SELECT * FROM user_info WHERE {$searchType} LIKE '%{$keyword}%' AND type=2";
		$student=M()->query($sql);
		foreach ($student as $k => $v) {
			$time_end=M("xorder")->where("uid={$v['id']}")->getField("time_end");
			if($time_end!=""){
			$student[$k]['time_end']=date("Y-m-d H:i:s",$time_end);
			}else{
				unset($student[$k]);
			}
		}

		$offset=1;

		$managerTip="：后台管理：学员管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset);
		$this->assign("student",$student);
		$this->display("student");
	}

	public function getCourse($uid,$pageNum=NULL){
		$rowCount=M("my_plan")->where("uid={$uid}")->count();

		if($rowCount){
		$url="User/getCourse";
		$pageSize=10;
		$offset=0;
		$rowPage=getPageS($rowCount,$pageSize,$pageNum,$url,$uid);
		$offset=$rowPage['offset'];

		$course=M("my_plan")->where("uid={$uid}")->order("course_time DESC")->limit($offset,$pageSize)->select();
		foreach ($course as $k => $v) {
			$time=$course[$k]['course_time'];

			$course[$k]['course_time']=date("Y-m-d",$time);
			$week=date("w",$time);
			if($week==1){
				$week="星期一";
			}else if($week==2){
				$week="星期二";
			}else if($week==3){
				$week="星期三";
			}else if($week==4){
				$week="星期四";
			}else if($week==5){
				$week="星期五";
			}else if($week==6){
				$week="星期六";
			}else if($week==0){
				$week="星期日";
			}

			if($time==0 || $time==1){
			$course[$k]['course_time']="暂无课程";
			$week="";
			}
			$course[$k]['week']=$week;
			$course[$k]['name']=M("user_info")->where("id={$v['uid']}")->getField("name");
			$course[$k]['cname']=M("user_info")->where("id={$v['coachid']}")->getField("name");
			$course[$k]['plan']=M("plan")->where("id={$v['pid']}")->getField("title");
		}
		}

		$managerTip="：后台管理：学员管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset+1);
		$this->assign("pageList",$rowPage['show']);
		$this->assign("course",$course);
		$this->display("course");
	}

	public function changeUserStatus($uid,$coachid,$pid,$paytime,$status){
		$aff=M("my_plan")->where("uid={$uid} AND coachid={$coachid} AND pid={$pid} AND pay_time={$paytime}")->save(array("status"=>$status));
		$paytime=date("Y-m-d H:i:s",$paytime);
		if($aff){
			$this->success("修改成功",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$paytime}");
		}else{
			$this->success("修改失败",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$paytime}");
		}
	}

	public function changeEndTime($uid,$coachid,$pid,$paytime,$days,$type){
				
		$info=M("my_plan")->where("uid={$uid} AND coachid={$coachid} AND pid={$pid} AND pay_time={$paytime}")->select();
		$end_time=$info[0]['end_time'];

		if($type==0){

		$end_time=$end_time+$days*86400;

		}else if($type==1){

		$end_time=$end_time-$days*86400;

		}

		$aff=M("my_plan")->where("uid={$uid} AND coachid={$coachid} AND pid={$pid} AND pay_time={$paytime}")->save(array("end_time"=>$end_time));
		$time_end=date("Y-m-d H:i:s",$paytime);
		

		if($aff){
			$this->success("修改成功",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$time_end}");
		}else{
			$this->success("修改失败",__ENTRY__."/home/User/getCourseCoach/uid/{$uid}/time_end/{$time_end}");
		}
	}
}