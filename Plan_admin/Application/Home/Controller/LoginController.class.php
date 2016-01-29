<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{

	public function index(){
		$this->display();
	}

	public function login(){
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$verifyCode=$_POST['verify'];

		$Verify = new \Think\Verify(); 

		if($Verify->check($verifyCode)){

		$userInfo=M("admin")->where("username='%s' and password='%s'",array($username,$password))->select();

		session_start();
		$_SESSION['userMsg']=$userInfo[0];

		$this->success("登陆成功，正在进入后台",__ENTRY__."/home/Index/index");

		}else{

			$this->success("验证码输入错误",__ENTRY__."/home/Login/index");

		}
	}

	public function verify(){
		$config =    array(
		'imageW'	  =>100,
		'imageH'	  =>28,
    	'fontSize'    => 13,
    	'length'      => 4,
    	'useNoise'    => false,
			);
		$Verify =     new \Think\Verify($config); 
		$Verify->entry();
	}
}