<?php
	include_once '../sys/core/init.inc.php';
    //session_start();
    //var_dump($_SESSION);
    if(isset($_SESSION['user']['name']))
    {
        $username = $_SESSION['user']['name'];
     //   $avator = $_SESSION['user']['avator'];

   //     echo "<img src=\"$avator\" width='20px'>";
        echo "Hello <strong>".$username."</strong> have a nice day!";
    }
    if(isset($_POST['submit']))
    {
        $str = $_POST['year']."-".$_POST['month']."-01 00:00:00";
	}
    else
    {
        $str = date("Y-m-d H:i:s");
    }
    $cal = new Calendar($dbo, $str);


	/*if( is_object ($cal))
	{
		echo "<pre>".var_dump($cal)."</pre>";
	}*/
	$page_title = "Events Calendar";
	$css_files = array('style.css','admin.css','ajax.css');
	include_once 'assets/common/header.inc.php';
?>
<div id='content'>
<?php

	echo $cal->buildCalendar();
?>
</div>
<center> 
<form action="index.php" method="post">
<?php
        echo "查询其他：";
        $nyear = date("Y");
        echo "<select name ='year' id='year' onchange='change()'>";
        for($i=$nyear-4; $i <= $nyear+4 ;$i++)
        {
            if($i == $nyear )
            { 
                echo "<option value='$i' selected='selected'>".$i."</option>";
            }
            else
            {
                echo "<option value='$i'>".$i."</option>";
            }
        }
        echo "</select>";
    

        $nmonth = date("m");
        echo "<select name ='month' id='month' onchange='change()'>";
        for($i=1;$i<=12;$i++)
        {
            $m = str_pad($i,2,'0',STR_PAD_LEFT);
            if($nmonth == $i )
            { 
                echo "<option value='$m' selected='selected'>".$i."月</option>";
            }
            else
            {
                echo "<option value='$m'>".$i."月</option>";
            }
        }
        echo "</select>";
?>
<input type="submit" name="submit" value="search"/>
<input type="submit" name="submit" value="当前月份");
?>
</form>
</center>
<p>
<?php echo isset($_SESSION['user']['name'])? "Logged In!":"Logged Out!";?>
</p>
<?php
	include_once 'assets/common/footer.inc.php';
?>
