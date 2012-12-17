<?php
    header("Content-type:text/html; charset=utf-8");
    function classtablejson($username,$password)
{



$curl = curl_init();
//save cookie
$cookie = tempnam('./temp','cookie');
//var_dump($curl);

$viewstate_code="dDwyMDY5NjM4MDg7dDw7bDxpPDE+Oz47bDx0PDtsPGk8Mz47aTwxNT47PjtsPHQ8O2w8aTwxPjtpPDM+O2k8NT47aTw3PjtpPDk+O2k8MTE+O2k8MTM+O2k8MTU+O2k8MTc+Oz47bDx0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcuZ2lmOz4+Oz47Oz47dDxwPHA8bDxCYWNrSW1hZ2VVcmw7PjtsPGh0dHA6Ly93d3cueWNqdy56anV0LmVkdS5jbi8vaW1hZ2VzL2JnMS5naWY7Pj47Pjs7Pjt0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcxLmdpZjs+Pjs+Ozs+O3Q8cDxwPGw8QmFja0ltYWdlVXJsOz47bDxodHRwOi8vd3d3Lnljancuemp1dC5lZHUuY24vL2ltYWdlcy9iZzEuZ2lmOz4+Oz47Oz47dDxwPHA8bDxCYWNrSW1hZ2VVcmw7PjtsPGh0dHA6Ly93d3cueWNqdy56anV0LmVkdS5jbi8vaW1hZ2VzL2JnMS5naWY7Pj47Pjs7Pjt0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcxLmdpZjs+Pjs+Ozs+O3Q8cDxwPGw8QmFja0ltYWdlVXJsOz47bDxodHRwOi8vd3d3Lnljancuemp1dC5lZHUuY24vL2ltYWdlcy9iZzEuZ2lmOz4+Oz47Oz47dDxwPHA8bDxCYWNrSW1hZ2VVcmw7PjtsPGh0dHA6Ly93d3cueWNqdy56anV0LmVkdS5jbi8vaW1hZ2VzL2JnMS5naWY7Pj47Pjs7Pjt0PHA8cDxsPEJhY2tJbWFnZVVybDs+O2w8aHR0cDovL3d3dy55Y2p3LnpqdXQuZWR1LmNuLy9pbWFnZXMvYmcxLmdpZjs+Pjs+Ozs+Oz4+O3Q8dDw7dDxpPDM+O0A8LS3nlKjmiLfnsbvlnostLTvmlZnluIg75a2m55SfOz47QDwtLeeUqOaIt+exu+Weiy0tO+aVmeW4iDvlrabnlJ87Pj47Pjs7Pjs+Pjs+PjtsPEltZ19ETDs+PrIHcsOvTo14qddoue+GrkRAq5+G";
$post_data['__EVENTTARGET'] ='';
$post_data['__EVENTARGUMENT'] = ''; 
$post_data['__VIEWSTATE'] = $viewstate_code;
$post_data['Cbo_LX']="学生";
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


//判断日期
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

$post_data1['Cbo_Xueqi'] = $Ym; 

$post_data1['Button2'] = '按课表查询'; 
$post_data['Img_DL.y']="4";

curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data1);


curl_setopt($curl,CURLOPT_COOKIEFILE,$cookie);

$data=curl_exec($curl);


$data = iconv("GBK","UTF-8",$data);


curl_close($curl);

preg_match_all("/(<span id=\"DG_GXK__ctl[2,4,7,9,1]1?_XQ)(.*)(<\/span>)/",$data,$arr);


//var_dump($arr[0]);
  if ( sizeof($arr[0])==0)
   {
     echo "{\"state\":\"error\",\"info\":\"you password is not correct!\"}";
    exit;
    }

//    exit;

   $class=array();
   $week=array("Monday","Tuesday","Webnesday","Thursday","Friday");
   $day = array("first","second","third","fourth","sixth","seventh","eighth","ninth","tenth"); 
   
   for($i=0;$i<5;$i++)// 是星期几？
   {   
        for($k=0;$k<5;$k++)
         {   
             $j = 2 * $k; 
              $m = 7 * $k +$i;
            $class[$week[$i]][$day[$j]]=strip_tags($arr[0][$m]);
         }
   }

//    $JSON = $class;
  $JSON= json_encode($class);
   return $JSON;
   }

//  var_dump( $data);
 //  echo json_decode($data);
?>

