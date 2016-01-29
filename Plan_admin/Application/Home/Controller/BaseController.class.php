<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller{

	public function _initialize(){

		if($_SESSION['userMsg']==NULL){
			$this->success("未登录，请先登录",__ENTRY__."/home/Login/index");
			exit();
		}
	}
}