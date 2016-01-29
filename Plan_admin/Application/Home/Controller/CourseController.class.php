<?php
namespace Home\Controller;
use Think\Controller;

class CourseController extends BaseController{

	public function getTodayCourse($pageNum=NULL){
		$today=strtotime(date("Y-m-d",time()));
/*		echo $today;
		$today=strtotime("2016-01-10");*/
		$tomorrow=$today+86400;
		$atomorrow=$tomorrow+86400;


		$rowCount=M("my_plan")->where("course_time!=0 AND course_time!=1 AND status<4 AND course_time<{$tomorrow}")->count();

		$pageSize=10;
		$offset=0;
		$url="Course/getTodayCourse";
		$rowPage=getPage($rowCount,$pageSize,$pageNum,$url);
		$offset=$rowPage['offset'];

		$course=M("my_plan")->where("course_time!=0 AND course_time!=1 AND status<4 AND course_time<{$tomorrow}")->order("course_time DESC")->limit($offset,$pageSize)->select();

		foreach($course as $k=>$v){
			$course[$k]['name']=M("user_info")->where("id={$v['uid']}")->getField("name");
			$course[$k]['cname']=M("user_info")->where("id={$v['coachid']}")->getField("name");
			$course[$k]['plan']=M("plan")->where("id={$v['pid']}")->getField("title");
			$ctime=$v['course_time'];
			if($ctime>=$today && $ctime<$tomorrow){	
				$course[$k]['iscourse']="<font color='green'>有课程</font>";
			}else{
				$course[$k]['iscourse']="<font color='red'>无课程</font>";
			}

			$course[$k]['course_time']=date("Y-m-d",$ctime);
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
			$course[$k]['week']=$week;
		}

		$managerTip="：后台管理：课程管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset+1);
		$this->assign("pageList",$rowPage['show']);
		$this->assign("course",$course);
		$this->display("today");
	}

	public function getTomorrowCourse($pageNum=NULL){
		$today=strtotime(date("Y-m-d",time()));
		//echo $today;
		//$today=strtotime("2016-01-10");
		$tomorrow=$today+86400;
		$atomorrow=$tomorrow+86400;

		$rowCount=M("my_plan")->where("course_time!=0 AND course_time!=1 AND status<4 AND course_time<{$atomorrow}")->count();

		$pageSize=10;
		$offset=0;
		$url="Course/getTomorrowCourse";
		$rowPage=getPage($rowCount,$pageSize,$pageNum,$url);
		$offset=$rowPage['offset'];

		$course=M("my_plan")->where("course_time!=0 AND course_time!=1 AND status<4 AND course_time<{$atomorrow}")->order("course_time DESC")->limit($offset,$pageSize)->select();

		foreach($course as $k=>$v){
			$course[$k]['name']=M("user_info")->where("id={$v['uid']}")->getField("name");
			$course[$k]['cname']=M("user_info")->where("id={$v['coachid']}")->getField("name");
			$course[$k]['plan']=M("plan")->where("id={$v['pid']}")->getField("title");
			$ctime=$v['course_time'];
			if($ctime>=$tomorrow && $ctime<$atomorrow){	
				$course[$k]['iscourse']="<font color='green'>有课程</font>";
			}else{
				$course[$k]['iscourse']="<font color='red'>无课程</font>";
			}

			$course[$k]['course_time']=date("Y-m-d",$ctime);
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
			$course[$k]['week']=$week;
		}

		$managerTip="：后台管理：课程管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset+1);
		$this->assign("pageList",$rowPage['show']);
		$this->assign("course",$course);
		$this->display("tomorrow");
	}

	public function getManydayCourse($pageNum=NULL){
		$today=strtotime(date("Y-m-d",time()));
		//echo $today;
		//$today=strtotime("2016-01-10");
		$tomorrow=$today+86400;
		$atomorrow=$tomorrow+86400;

		$rowCount=M("my_plan")->where("course_time!=0 AND course_time!=1 AND status<4")->count();

		$pageSize=10;
		$offset=0;
		$url="Course/getManydayCourse";
		$rowPage=getPage($rowCount,$pageSize,$pageNum,$url);
		$offset=$rowPage['offset'];

		$course=M("my_plan")->where("course_time!=0 AND course_time!=1 AND status<4")->order("course_time DESC")->limit($offset,$pageSize)->select();

		foreach($course as $k=>$v){
			$course[$k]['name']=M("user_info")->where("id={$v['uid']}")->getField("name");
			$course[$k]['cname']=M("user_info")->where("id={$v['coachid']}")->getField("name");
			$course[$k]['plan']=M("plan")->where("id={$v['pid']}")->getField("title");
			$ctime=$v['course_time'];
			if($ctime>=$atomorrow){	
				$course[$k]['iscourse']="<font color='green'>有课程</font>";
			}else{
				$course[$k]['iscourse']="<font color='red'>无课程</font>";
			}

			$course[$k]['course_time']=date("Y-m-d",$ctime);
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
			$course[$k]['week']=$week;
		}

		$managerTip="：后台管理：课程管理";
		$this->assign("managerTip",$managerTip);
		$this->assign("offset",$offset+1);
		$this->assign("pageList",$rowPage['show']);
		$this->assign("course",$course);
		$this->display("manyDays");
	}
}