<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
<link href="/Plan_admin/public/css/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="/Plan_admin/public/css/global.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/Plan_admin/public/jquery/jquery-1.4.js"></script>
<style type="text/css">
#mss{
	width:598px;
	border:1px solid black;
	text-align: center;
	margin: 0 auto;
	border-top: none;
}
#head{
	height:50px;
}
#head h1{
	width:600px;
	margin: 0 auto;
	background-color: #2363B2;
	text-align: center;
	margin-top: 15px;
	line-height: 50px;
}
</style>
<script type="text/javascript">
var index=5; 
  function changeTime(){
    	document.getElementById("timeSpan").innerHTML=index;
    	index--;
    	if(index<0){
    		window.location="<?php echo ($jumpUrl); ?>";
    		}else{
    			window.setTimeout("changeTime()",1000);
    		}
    	}
</script>
</head>
<body onload="changeTime()">
	<div id="head"><h1>系统提示信息</h1></div>
	<div id="mss">
<table>
		<td><span style="color:red;font-size:20px;"><?php echo ($message); ?></span>，页面将在&nbsp;<span id="timeSpan" style="color:blue;font-size:20px;">5</span>&nbsp;秒后自动跳转！</td>
	</tr>
	<tr>
		<td>如果没有跳转，<a href="<?php echo ($jumpUrl); ?>" style="color:green;font-size:20px;">请点击这里</a>。</td>
	</tr>
</table>
</div>
</body>
</html>