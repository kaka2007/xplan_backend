<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
<link href="/Plan_admin/public/css/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="/Plan_admin/public/css/global.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/Plan_admin/public/jquery/jquery-1.4.js"></script>
<style type="text/css">
.plus{
	background:url(/Plan_admin/public/images/plus.gif) no-repeat left center;
}
.minus{
	background:url(/Plan_admin/public/images/minus.gif) no-repeat left center;
}
</style>
<script type="text/javascript">
$(document).ready(
	function(){
		for(var $n=1;$n<5;$n++){
			$("#div"+$n).hover(
				function (){
					$(this).css("background-color","gray");
					$(this).find("div").slideDown(300);
				},
				function (){
					$(this).css("background-color","#E4E9EC");
					$(this).find("div").slideUp(300);
				});
		}
})
function toggleItem(id){
	var menuEle=document.getElementById('menu'+id);
	var listEle=document.getElementById('list'+id);
	if (menuEle.style.display==''||menuEle.style.display=='block') {
		menuEle.style.display = 'none';
		listEle.className='plus';
	}else{
		menuEle.style.display = 'block';
		listEle.className='minus';
	}
}
</script>
</head>
<body>
<div id="continer">
<div>
 <script type="text/javascript">
function logout(){
	  if(confirm("是否确认退出登陆？")){
		  window.location = "/Plan_admin/index.php/home/Index/logout";
	  }
  }
</script>
<!--top navi-->
<div id="top-body">
		<span id="top-subject">PLAN</span>
</div>
<div id="navi">
	<div class="navi1"></div>
	<div class="navi2">
			<div class="den">
				<a href="#" onclick="logout()">退出后台</a>
			</div>
			<div id="div1">用户管理<br>
				<div class="slide">
					<a href="/Plan_admin/index.php/home/User/getCoach">教练管理</a><br>
					<a href="/Plan_admin/index.php/home/User/getStudent">学员管理</a><br>
				</div>
			</div>
			<div id="div2">计划管理<br>
				<div class="slide">
					<a href="">添加计划</a><br>
					<a href="/Plan_admin/index.php/home/Plan/update">修改计划</a><br>
				</div>
			</div>
			<div id="div3">课程管理<br>
				<div class="slide">
					<a href="/Plan_admin/index.php/home/Course/getTodayCourse">今日课程</a><br>
					<a href="/Plan_admin/index.php/home/Course/getTomorrowCourse">明日课程</a><br>
					<a href="/Plan_admin/index.php/home/Course/getManydayCourse">多日课程</a><br>
				</div>
			</div>
			<div id="div4">课程管理<br>
				<div class="slide">
					<a href="/Plan_admin/index.php/home/Admin/index">添加管理员</a><br>
					<a href="/Plan_admin/index.php/home/Admin/update">修改管理员</a><br>
				</div>
			</div>


<!-- 			<div class="den">
	<a href="/Plan_admin/index.php/home/Index/index">返回主页</a>
</div> -->
	</div>
	<div class="navi3"><?php echo ($managerTip); ?></div>
</div>
</div>

<div id="init">
		<div id="menu-body">
			<!--menu-->

	<h2><a href="#" onclick="logout()"><span>退出后台</a></span></h2>
	<h2 class="minus" id="list1" onclick="toggleItem('1')"><span>用户管理</span></h2>
	<ul id="menu1">
		<li><a href="/Plan_admin/index.php/home/User/getCoach">教练管理</a></li>
		<li><a href="/Plan_admin/index.php/home/User/getStudent">学员管理</a></li>
	</ul>
	<h2 class="minus" id="list2" onclick="toggleItem('2')"><span>计划管理</span></h2>
	<ul id="menu2">
		<li><a href="">添加计划</a></li>
		<li><a href="/Plan_admin/index.php/home/Plan/update">修改计划</a></li>
	</ul>
	<h2 class="minus" id="list3" onclick="toggleItem('3')"><span>课程管理</span></h2>	
	<ul id="menu3">
		<li><a href="/Plan_admin/index.php/home/Course/getTodayCourse">今天课程</a></li>
		<li><a href="/Plan_admin/index.php/home/Course/getTomorrowCourse">明日课程</a></li>
		<li><a href="/Plan_admin/index.php/home/Course/getManydayCourse">多日课程</a></li>
	</ul>	
	<h2 class="minus" id="list4" onclick="toggleItem('4')"><span>添加管理员</span></h2>
	<ul id="menu4">
		<li><a href="/Plan_admin/index.php/home/Admin/index">添加管理员</a></li>
		<li><a href="/Plan_admin/index.php/home/Admin/update">修改管理员</a></li>
	</ul>
	<h2><a href="/Plan_admin/index.php/home/Index/index">返回主页</a></h2>

		</div>
		<div id="wel">
	<p id="p1"><h2>欢迎登录PLAN管理系统</h2></p>
	<p id="p2"><h3></h3></p>
		</div>
		
</div>		

</div>
</body>
</html>