<?php
namespace Home\Controller;
use Think\Controller;

class AdminController extends BaseController{

	public function index(){
		$managerTip="：后台管理：添加管理员";
		$this->assign("managerTip",$managerTip);
		$this->display();
	}

	public function addUser(){
		$data['username']=$_POST['userName'];
		$data['password']=md5($_POST['password']);
		$aff=M("admin")->add($data);
		if($aff){
			$this->success("添加成功",__ENTRY__."/Home/Admin/index");
		}else{
			$this->success("添加失败",__ENTRY__."/Home/Admin/index");
		}
	}

	public function update(){
		session_start();
		$username=$_SESSION['userMsg']['username'];
		$password=$_SESSION['userMsg']['password'];

		$managerTip="：后台管理：修改管理员";
		$this->assign("managerTip",$managerTip);
		$this->assign("username",$username);
		$this->display("update");
	}

	public function updateUser(){
		session_start();
		$id=$_SESSION['userMsg']['id'];
		$oldusername=$_SESSION['userMsg']['username'];
		$oldpassword=$_SESSION['userMsg']['password'];

		$opassword=md5($_POST['oldpassword']);
		$newusername=$_POST['userName'];
		$newpassword=md5($_POST['newpassword']);

		if($oldpassword==$opassword){
			$aff=M("admin")->where("id={$id}")->save(array("username"=>$newusername,"password"=>$newpassword));
		if($aff){
			$this->success("修改成功，请重新登录",__ENTRY__."/home/Login/index");
		}else{
			$this->success("修改失败",__ENTRY__."/home/Admin/update");
		}

		}else{
			$this->success("原密码输入错误，请确认后再修改！",__ENTRY__."/home/Admin/update");
		}
	}
}