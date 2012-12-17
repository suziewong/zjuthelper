<?php
   header("Content-type:text/html;charset=utf-8");
    $data = file_get_contents("myclass.html");

    $data = iconv("GBK","UTF-8",$data);
   
    preg_match_all("/(<span id=\"DG_GXK__ctl[2,4,7,9,1]1?_XQ)(.*)(<\/span>)/",$data,$arr);
   
    $classtable = simplexml_load_file("XML/classtable.xml");
    
    $jsonarr =array();
    $day = array("first","second","third","fourth","sixth","seventh","eighth","ninth","tenth");
    $week=array("Monday","Tuesday","Webnesday","Thursday","Friday");
    for($i=0;$i<5;$i++)// 是星期几？
    {
        for($k=0;$k<5;$k++)
        {
            $j = 2 * $k;
            $m = 7 * $k +$i;

        $jsonarr[$week[$i]][$j]=strip_tags($arr[0][$m]);
            
        }
    }
//   var_dump($jsonarr); 
   $JSON = json_encode($jsonarr);
//   $JSON = json_decode($JSON);
    var_dump($JSON);
?>
