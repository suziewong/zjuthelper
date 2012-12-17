<?php
       header("Content-type:text/html; charset=utf-8");  
      // var_dump($_POST);
      session_start();
       $actions = array(
            "user_login"=>array(
                        "method"=>"login",
                        "header"=>"../"
                        ),
            "user_logout"=>array(
                        "method"=>"logout",
                        "header"=>"../"
            )
       );
       if( $_GET['action']!="user_login" && $_GET['action']!="user_logout")
       {
            echo  "INvalid action supplied for processLoginForm";
            exit;
       }
        $action=$_GET['action'];
       switch($actions[$action]["method"])
       {
            case "login":

  //$username = htmlentities($_POST['username'],ENT_QUOTES);
   $username = htmlspecialchars($_POST['username']);
   $password = htmlentities($_POST['password'],ENT_QUOTES);
  //论坛帐号登录
  //   $s="http://user.zjut.com/api.php?app=member&action=login&username=".$username."&password=".$password;
  //学号登录
   $s = "http://user.zjut.com/api.php?app=passport&action=login&passport=".$username."&password=".$password;
   $file_contents = file_get_contents($s);
            $jsond = json_decode($file_contents,true);
            if($jsond['state']=='error')
            {
                echo  "Your username is not found!";
            }
            else
            {
                $_SESSION['user'] = array('uid'=>$jsond['data']['pid'],
                                        'name'=> $jsond['data']['pid'],
                                        'email'=>$jsond['data']['email'],
                            );
              echo "<script>history.go(-2);</script>";  
              }
              exit;
              case "logout":
                    session_destroy();
              echo "<script>history.go(-1);</script>";  
           
                    exit;
              default:
                echo "no this method!";
                exit;
            }
?>
