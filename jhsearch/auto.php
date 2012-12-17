<?php
//这里是我的一个数据库类
include_once 'mysql_class.php';
$db = new mysql();
$username = $_POST['name'];
$sql ="SELECT username,posts FROM jhy_members WHERE `username` LIKE '$username%' order by posts desc limit 10";
$data = $db->findData($sql);
$str='';
if($data){
	foreach($data as $k=>$v){
		
		$str.='<tr><td>'.$v['username'].'</td></tr>';
	}
	//生成表格
	//echo $str="<table>$str</table>";
	echo $str2="<table>$str</table>";
}
