<?php
header('Content-Type: text/html; charset=GB18030');
//header('Content-Type: text/html; charset=utf-8');

if(isset($_POST['submit'])){
$username = $_POST['username'];
$password = $_POST['password'];

$all=$username.$password;


$curl = curl_init();
//save cookie
$cookie = tempnam('./temp','cookie');
//var_dump($curl);

$viewstate_code="dDwyMDY5NjM4MDg7dDw7bDxpPDE+Oz47bDx0PDtsPGk8Mz47aTwxNT47PjtsPHQ8O2w8aTwxPjtpPDM+O2k8NT47aTw3PjtpPDk+O2k8MTE+O2k8MTM+O2k8MTU+O2k8MTc+Oz47bDx0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcuZ2lmOz4+Oz47Oz47dDxwPHA8bDxCYWNrSW1hZ2VVcmw7PjtsPGh0dHA6Ly93d3cueWNqdy56anV0LmVkdS5jbi8vaW1hZ2VzL2JnMS5naWY7Pj47Pjs7Pjt0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcxLmdpZjs+Pjs+Ozs+O3Q8cDxwPGw8QmFja0ltYWdlVXJsOz47bDxodHRwOi8vd3d3Lnljancuemp1dC5lZHUuY24vL2ltYWdlcy9iZzEuZ2lmOz4+Oz47Oz47dDxwPHA8bDxCYWNrSW1hZ2VVcmw7PjtsPGh0dHA6Ly93d3cueWNqdy56anV0LmVkdS5jbi8vaW1hZ2VzL2JnMS5naWY7Pj47Pjs7Pjt0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcxLmdpZjs+Pjs+Ozs+O3Q8cDxwPGw8QmFja0ltYWdlVXJsOz47bDxodHRwOi8vd3d3Lnljancuemp1dC5lZHUuY24vL2ltYWdlcy9iZzEuZ2lmOz4+Oz47Oz47dDxwPHA8bDxCYWNrSW1hZ2VVcmw7PjtsPGh0dHA6Ly93d3cueWNqdy56anV0LmVkdS5jbi8vaW1hZ2VzL2JnMS5naWY7Pj47Pjs7Pjt0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcxLmdpZjs+Pjs+Ozs+Oz4+O3Q8dDw7dDxpPDM+O0A8LS3nlKjmiLfnsbvlnostLTvmlZnluIg75a2m55SfOz47QDwtLeeUqOaIt+exu+Weiy0tO+aVmeW4iDvlrabnlJ87Pj47Pjs7Pjs+Pjs+PjtsPEltZ19ETDs+PrIHcsOvTo14qddoue+GrkRAq5+G";
$post_data['__EVENTTARGET'] ='';
$post_data['__EVENTARGUMENT'] = ''; 
$post_data['__VIEWSTATE'] = $viewstate_code;
$post_data['Cbo_LX']="Ñ§Éú";
$post_data['Txt_UserName']=$username;
$post_data['Txt_Password']=$password;
$post_data['Img_DL.x']="23";
$post_data['Img_DL.y']="9";

curl_setopt($curl,CURLOPT_URL,'http://www.ycjw.zjut.edu.cn/logon.aspx');

curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);


curl_setopt($curl,CURLOPT_POST,1);

curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);

curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie);

$data=curl_exec($curl);//



curl_close($curl);

$curl = curl_init();

curl_setopt($curl,CURLOPT_URL,'http://www.ycjw.zjut.edu.cn//stdgl/cxxt/Web_Std_XQKB.aspx');

curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

////POST
$file = file_get_contents("file");
$viewstate_code=$file;
$post_data1['__EVENTTARGET'] ='';
$post_data1['__EVENTARGUMENT'] = ''; 
$post_data1['__VIEWSTATE'] = $viewstate_code;

//¿¿¿¿
$month = (int)date("m");
$year = (int)date("Y");
if(  $month >= 2 && $month <=7 )
{
    $before = $year-1;
     $Ym = $before."/".$year."(2)";
}
else
{
    $next = $year+1;
    $Ym = $year."/".$next."(1)";
}
//echo $Ym;
//exit;

$post_data1['Cbo_Xueqi'] = $Ym; 

$post_data1['Button2'] = '°´¿Î±í²éÑ¯'; 
$post_data['Img_DL.y']="4";

curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data1);


curl_setopt($curl,CURLOPT_COOKIEFILE,$cookie);

$data=curl_exec($curl);

//file_put_contents("classtable.xml",$data);

preg_match_all("/<span id=\"DG_GXK__ctl[2,4,7,9](.*)<\/span>/",$data,$arr);

preg_match_all("/<span id=\"DG_GXK__ctl1[1](.*)<\/span>/",$data,$arr2);

//var_dump($arr);
curl_close($curl);

//// ¿¿¿
/*$curl = curl_init();

curl_setopt($curl,CURLOPT_URL,'http://www.ycjw.zjut.edu.cn//stdgl/cxxt/byshmx.aspx');

curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);


$data2=curl_exec($curl);


echo $data2;

curl_close($curl);*/

}
?>

<html>	
	<head>
	<title>ClassTable</title>
	 <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/metro.css">
    <link rel="stylesheet" type="text/css" href="../public/css/site.css">

	<style type="text/css">
        body {
            background: #004050;
        }
		table {
			width:100%;
			color:#EEEEEE;
			background-color: #004049;
			border-collapse: separate;
			table-layout:fixed; 
			height:20px;
		} 
 
    </style>	
	</head>
	<body>
		<div class="container">
			 <div class="header metro" id="header">
            <div class="command-back-wrapper">
                <h1>Result</h1>
                <br/>
                <a href="index.php"><img src="../public/img/left-32.png"/></a>

            </div>
			<h2 align="right">Class Table</h2>
       </div>
			<table  border="2px" id="classtable">
				<?php
					if(isset($_POST['submit']) && !empty($arr[0]) )
					{
					//	var_dump($arr);
					//$q = 1;
					for($n=0;$n<4;$n++)
					{
						$k = $n*8;
						
						echo "<tr>";
							//echo "<td>µÚ".$q.",".++$q."½Ú</td>";
							//$q++;
						for($m=0;$m<8;$m++)
							echo "<td width='100'>".$arr[0][$m+$k]."</td>";	
						echo "</tr>";
					}

					echo "<tr>";
					//echo "<td>µÚ".$q.",".++$q."½Ú</td>";
					for($m=0;$m<8;$m++)
						echo "<td width='100'>".$arr2[0][$m]."</td>";	
					echo "</tr>";
					}
				?>
				
			</table>
	     <footer class="footer metro">
             <p class="pull-right"><a href="#">Metro</a></p>
 
             <p> 2012 <a href="http://www.zjut.com">jh network</a>..</p>
            <p>MIT License</p>
        </footer>

		</div>
	<script type="text/javascript">
     //   $(".metro").metro();
    </script>

	</body>
</html>

