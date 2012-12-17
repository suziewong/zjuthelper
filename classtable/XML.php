<?php
//    header("Content-type:text/html;charset=utf-8");
    $data = file_get_contents("myclass.html");

    $data = iconv("GBK","UTF-8",$data);
   
    preg_match_all("/(<span id=\"DG_GXK__ctl[2,4,7,9,1]1?_XQ)(.*)(<\/span>)/",$data,$arr);
   
    $classtable = simplexml_load_file("XML/classtable.xml");
    
//    var_dump($arr[0]);
    
    $week=array("Monday","Tuesday","Webnesday","Thursday","Friday");
    $day = array("first","second","third","fourth","sixth","seventh","eighth","ninth","tenth");
    for($i=0;$i<5;$i++)// 是星期几？
    {
        for($k=0;$k<5;$k++)
        {
            $j = 2 * $k;
            $m = 7 * $k +$i;
        //    echo $week[$i]." ".$day[$j]." ".$arr[0][$m]."<br/>";
            $classtable->classes->$week[$i]->$day[$j]=strip_tags($arr[0][$m]);
   //         $classtable->classes->$week[$i]->$day[$j]="";
        }
    }

    
    
   // var_dump($classtable->classes);
    $newxml = $classtable->asXML();//标准化 XML数据
   
   echo   $newxml;
   // file_put_contents("classtable.xml",$newxml);
  //      echo "<br/>";
?>
