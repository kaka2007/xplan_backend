<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function index(){
    $managerTip="：后台管理：后台首页";


    $this->assign("managerTip",$managerTip);
	$this->display();
    }
    public function logout(){
    	session_destroy();
    	$this->success("正在退出后台",__ENTRY__."/home/Login/index");
    }
}