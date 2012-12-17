<?
define("HOST","localhost");
define("USER","suzie");
define("PASSWD","027267");
define("DBNAME","bbs");

 $link = mysql_connect(HOST,USER,PASSWD);
        mysql_select_db(DBNAME,$link);
                    //字符转换，读库
   mysql_query("set character set 'utf8'");
                         //写库
      mysql_query("set names 'utf8'");


?>
