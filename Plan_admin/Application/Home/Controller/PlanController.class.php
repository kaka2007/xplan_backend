<?php
namespace Home\Controller;
use Think\Controller;
class PlanController extends BaseController{

	public function update(){
		$plan=M("plan")->select();
		foreach($plan as $k=>$v){
			$plan[$k]['count']=M("plan_coach")->where("pid={$v['id']}")->group("pid")->count();
		}
		$managerTip="：后台管理：修改计划";
		$this->assign("managerTip",$managerTip);
		$this->assign("plan",$plan);
		$this->display();
	}

	public function getCoach($pid){
		$sql="SELECT u.id,u.name,p.pid,p.coachid,p.status FROM plan_coach AS p INNER JOIN user_info AS u ON u.id=p.coachid WHERE pid={$pid} ORDER BY u.id";
		$coach=M()->query($sql);
/*		echo "<pre>";
		print_r($coach);
		echo "</pre>";*/

		$managerTip="：后台管理：修改计划";
		$this->assign("managerTip",$managerTip);
		$this->assign("coach",$coach);
		$this->display("coach");
	}

	public function changeStatus($pid,$coachid,$status){
		if($status==0){
		$aff=M("plan_coach")->where("coachid={$coachid}")->save(array("status"=>1));
		}else{
			$aff=M("plan_coach")->where("coachid={$coachid}")->save(array("status"=>0));
		}
		if($aff){
			$this->success("修改成功",__ENTRY__."/home/Plan/getCoach/pid/{$pid}");
		}else{
			$this->success("修改失败",__ENTRY__."/home/Plan/getCoach/pid/{$pid}");
		}
	}
}