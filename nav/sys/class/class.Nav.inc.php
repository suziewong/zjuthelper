<?php
    class Nav extends DB_Connect
    {  
       public function __construct($dbo=NULL)
       {
            parent::__construct($dbo);
       }


       public function buildNav()
       {

           if(isset($_SESSION['user']['uid']))
           {
                $uid = $_SESSION['user']['uid'];
                $sql = "select url_name,url_link from nav where uid=:uid order by url_clicks desc";

       try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':uid',$uid,PDO::PARAM_STR);
            $stmt->execute();
            $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
       }
       catch(Exception $e)
       {
            die($e->getMessage());

       }
            $urlssize = sizeof($urls);
            $i = 0;
            echo "<div class='Navcontent'>";
            echo "<ul id='navul'>";
           if($urlssize ==0)
           {
            echo "<li style='list-style-type:none;'><a></a></li>"; 
           }
           while($i < $urlssize)
           {
            echo "<li style='list-style-type:none;'><a class='metro-button' href={$urls[$i]['url_link']}>{$urls[$i]['url_name']}</a><a id='del_nav'></a>&nbsp;<a id='change_nav'></a></li>";
            $i++;
            }
            echo "</ul>";
            echo "</div>";
         }
         else
         {
            echo "<h2>登录后显示自定义的</h2>";
            echo "<a class='metro-button' style='list-style-type:none;' href='#'>工大首页</a>";
            echo "<a class='metro-button' style='list-style-type:none;' href='#'>工大首页</a>";
            echo "<a class='metro-button' style='list-style-type:none;' href='#'>工大首页</a>";
            echo "<a class='metro-button' style='list-style-type:none;' href='#'>工大首页</a>";
            echo "<a class='metro-button' style='list-style-type:none;' href='#'>工大首页</a>";
            
         }
       }
       public function url_add()
       {
          
         if( !isset($_SESSION['user']['uid']))
          {
            return "you should login ";
          }
      //    var_dump($_POST);  
      //    var_dump($_SESSION);  
          $uid = $_SESSION['user']['uid'];
          $url_name = $_POST['urlname'];
          $url_link = $_POST['urllink'];


          $sql = "insert into nav(uid,url_name,url_link) values(:uid,:url_name,:url_link)"; 
        //  var_dump($_SESSION);
       // echo $sql;
       try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':uid',$uid,PDO::PARAM_STR);
            $stmt->bindParam(':url_name',$url_name,PDO::PARAM_STR);
            $stmt->bindParam(':url_link',$url_link,PDO::PARAM_STR);
            $stmt->execute();
          //  $user = array_shift($stmt->fetchAll());
            $stmt->closeCursor();
       }
       catch(Exception $e)
       {
            die($e->getMessage());
       }
        }
       public function url_del()
       {
          
         if( !isset($_SESSION['user']['uid']))
          {
            return "you should login ";
          }
          $uid = $_SESSION['user']['uid'];
          $url_name = $_POST['url_name'];


          $sql = "delete from nav where uid=:uid and url_name =:url_name"; 
       try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':uid',$uid,PDO::PARAM_STR);
            $stmt->bindParam(':url_name',$url_name,PDO::PARAM_STR);
            $stmt->execute();
          //  $user = array_shift($stmt->fetchAll());
            $stmt->closeCursor();
       }
       catch(Exception $e)
       {
            die($e->getMessage());
       }
        }


        public function url_edit()
        {
         if( !isset($_SESSION['user']['uid']))
          {
            return "you should login ";
          }
          $uid = $_SESSION['user']['uid'];
          $url_name = $_POST['url_name'];
          $url_link = $_POST['url_link'];


          $sql = "update nav set url_name=:url_name where uid=:uid and url_link=:url_link"; 
       try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':uid',$uid,PDO::PARAM_STR);
            $stmt->bindParam(':url_name',$url_name,PDO::PARAM_STR);
            $stmt->bindParam(':url_link',$url_link,PDO::PARAM_STR);
            $stmt->execute();
          //  $user = array_shift($stmt->fetchAll());
            $stmt->closeCursor();
       }
       catch(Exception $e)
       {
            die($e->getMessage());
            
        }
        }
        public function url_tongji()
        {
         if( !isset($_SESSION['user']['uid']))
          {
            return "you should login ";
          }
          $uid = $_SESSION['user']['uid'];
          $url_name = $_POST['url_name'];
          $url_link = $_POST['url_link'];


          $sql = "update nav set url_clicks = url_clicks + 1 where uid=:uid and url_link=:url_link and url_name=:url_name"; 
       try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':uid',$uid,PDO::PARAM_STR);
            $stmt->bindParam(':url_name',$url_name,PDO::PARAM_STR);
            $stmt->bindParam(':url_link',$url_link,PDO::PARAM_STR);
            $stmt->execute();
          //  $user = array_shift($stmt->fetchAll());
            $stmt->closeCursor();
       }
       catch(Exception $e)
       {
            die($e->getMessage());
            
        }
        }
    }
?>
  
