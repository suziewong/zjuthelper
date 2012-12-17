<?
class Admin extends DB_Connect
{
  private $_saltLength = 7;

  public function __construct($db=NULL, $saltLength=NULL)
  {
        parent::__construct($db);

        if( is_int($saltLength))
        {
            $this->_saltLength = $saltLength;
        }
  }
   /*
   **
   **/
   public function processLoginForm()
   {
       if( $_POST['action']!="user_login")
       {
            return "INvalid action supplied for processLoginForm";
       }

       $uname = htmlentities($_POST['uname'],ENT_QUOTES);
       $pword = htmlentities($_POST['pword'],ENT_QUOTES);
//       var_dump($_POST);
       
       $sql = "select user_id,user_name,user_email,user_pass FROM users WHERE user_name =:uname LIMIT 1";

       try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':uname',$uname,PDO::PARAM_STR);
            $stmt->execute();
            $user = array_shift($stmt->fetchAll());
            $stmt->closeCursor();
       }
       catch(Exception $e)
       {
            die($e->getMessage());
       }

       if( !isset($user))
       {
             header("charset=utf-8");  
             $s="http://user.zjut.com/api.php?app=member&action=login&username=".$_POST['uname']."&password=".$_POST['pword'];
             $file_contents = file_get_contents($s);
             //echo $file_contents;
            $jsond = json_decode($file_contents,true);
            if($jsond['state']=='error')
            {
                return "Your username is not found!";
            }
            else
            {
                $_SESSION['user'] = array('uid'=>$jsond['data']['uid'],
                                        'name'=> $jsond['data']['username'],
                                        'email'=>$jsond['data']['email'],
                                        'avator'=>$jsond['data']['avator']
                            );
         //    exit;
                    return TRUE;
                
            }

       }
       $hash = $this->_getSaltedHash($pword, $user['user_pass']);

       if($user['user_pass']==$hash)
       {
            $_SESSION['user'] = array('uid'=>$user['user_id'],
                                'name'=> $user['user_name'],
                                'email'=>$user['user_email']
                            );
         //    exit;
             return TRUE;

       }
       else
       {
            return "Your username or password is invalid.";
       }
   }

   private function _getSaltedHash($string,$salt=NULL)
   {
       // echo "<br/>".$salt."<br/>";
        if($salt==NULL)
        {
            $salt = substr(md5(time()),0, $this->_saltLength);
        }
        else
        {
            $salt = substr($salt,0,$this->_saltLength);
        }

       // echo "<br/>".$salt."<br/>";
        return $salt.sha1($salt . $string);
   }

   public function testSaltedHash($string,$salt=NULL)
   {
        return $this->_getSaltedHash($string,$salt);
   }

   public function processLogout()
   {
         if($_POST['action']!='user_logout')
         {
            return "Invalid action supplied for processLogout";
         }

         session_destroy();
         return TRUE;
   }

}
?>
