<?php
    if(isset($_POST['submit']))
    {
      //var_dump($_POST); 
    	$arrlist = array("username","uid","yanzheng_sid","email");
    	$where ="where ";
    	$res = false;
	   switch($_POST['type'])
		{
			case "username":
				$where .= $arrlist[0]." = '".$_POST["value"]."'";
				//echo $where;
				break;
			case "uid":
				$where .= $arrlist[1]." = '".$_POST["value"]."'";				
				break;
			case "stunum":

				$where .= $arrlist[2]." = '".$_POST["value"]."'";
				break;
			case "email":
				$where .= $arrlist[3]." = '".$_POST["value"]."'";
				break;

		}
		
		if($where == "")
		{
			echo "nothing";
			$res = false;
			exit;
		}

		//echo "<h1>".$where."</h1>";
		//exit;
	//	$username = $_POST['value'];
       // $stunum = $_POST['stunum'];
       include_once "./sys/config/dbconfig.php";
       $link = mysql_connect(HOST,USER,PASSWD);
      
      
      $sql = "select uid,username,email,yanzheng_sid,yanzheng_pid from jhy_members ".$where;


       //echo $sql;

       // exit;   

       $resultf = mysql_query($sql);
       
       
       $row = mysql_fetch_array($resultf);
    //   while( $row = mysql_fetch_array($resultf))
        $email = $row['email'];

        
        if($email != "")
        {
//      $sql2 = "select uid,username,email,yanzheng_sid,yanzheng_pid from jhy_members where email='{$email}'";
        $xuehao = $row['yanzheng_sid'];
     	 $sql2 = "select uid,username,email,yanzheng_sid,yanzheng_pid from jhy_members where email='{$email}' or yanzheng_sid='{$xuehao}'";
     
       $result = mysql_query($sql2);

       /*while( $row = mysql_fetch_array($result))
        {
            var_dump($row);
        echo $row['yanzheng_sid'];

        }*/

        	$res = true;
    	}
    	else
    	{
    		$res = false;
    	}
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
	<title>工大助手</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">-->
    <link rel="stylesheet" type="text/css" href="../public/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../public/css/prettify.css">
    <link rel="stylesheet" type="text/css" href="../public/css/metro.css">
    <link rel="stylesheet" type="text/css" href="../public/css/site.css">

    <script type="text/javascript" src="../public/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../public/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="../public/js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="../public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/metro.js"></script>
    <script type="text/javascript" src="../public/js/site.js"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style type="text/css">
        body {
            background: #004050;
        }
        .metro {
            width: 940px;
            overflow: hidden;
        }
        .start {
			margin-top:80px;
        }
    </style>
</head>
<body>





<div class="container metro">
	  <div class="header" id="header">
            <div class="command-back-wrapper">
                <h1>Result</h1>
                <br/>
                <a href="./"><img src="sys/public/left-32.png"/></a>

            </div>
       </div>
       <br/>
        <br/>
       <?php
       		
       		if($res == true)
       		{
       			
       			echo "<table border='3' width='700px'>";
       			echo "<th>UID</th>";
       			echo "<th>username</th>";
       			echo "<th>email</th>";
       			echo "<th>sid</th>";
       			echo "<th>pid</th>";
       			while( $row = mysql_fetch_array($result))
        		{
            	echo "<tr>";
                        echo "<td>".$row['uid']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['yanzheng_sid']."</td>";
                        echo "<td>".$row['yanzheng_pid']."</td>";
                  echo "</tr>";

        		}
       			echo "</table>";
       		}
       ?>


        <footer class="footer">
            <p class="pull-right"><a href="#">Metro</a></p>

            <p>© 2012 <a href="http://www.zjut.com">精弘网络</a>..</p>
            <p>MIT License</p>
        </footer>

    <script type="text/javascript">
        $(".metro").metro();
    </script>
</div>
</body>
</html>
