<?php
	//include_once '../sys/class/class.db_connect.inc.php';
	
	class Calendar extends DB_Connect
	{
		// 日历当前日期
		private $_useDate;
		// 日历当前月份
		private $_m;
		// 日历当前年份
		private $_y;
		// 当前月有多少天
		private $_daysInMonth;
		// 这个月的起始日期
		private $_startDay;
		/**
		 *
		 */
		public function __construct($dbo=NULL,$useDate=NULL)
		{
			parent::__construct($dbo);

			if( isset($useDate) )
			{
				$this->_useDate = $useDate;
			}
			else
			{
				$this->_useDate = date('Y-m-d H:i:s');
			}

			$ts = strtotime($this->_useDate);
			$this->_m = date('m',$ts);
			$this->_y = date('Y',$ts);		
			
			$this->_daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->_m, $this->_y);

			$ts = mktime(0,0,0,$this->_m,1,$this->_y);
			$this->_startDay = date('w',$ts);	

		}

		public function _loadEventData($id=NULL)
		{
			$sql = "SELECT 
							event_id,event_uid,event_title,event_desc,event_start,event_end 
					FROM cal ";

			if(!empty($id))
			{
				$sql .= " WHERE event_id =:id and event_uid = :uid LIMIT 1";   ///warning  不能加 '' !!!!
			}

			else
			{
				$start_ts = mktime(0,0,0,$this->_m,1,$this->_y);
				$end_ts = mktime(0,0,0,$this->_m+1,0,$this->_y);
				$start_date = date('Y-m-d H:i:s',$start_ts);
				$end_date = date('Y-m-d H:i:s',$end_ts);

				$sql .= "WHERE event_uid = :uid and event_start
								BETWEEN '$start_date' and '$end_date'
						ORDER BY event_start";
			}

//$id++;
//echo $id;
			try
			{
				//	
				$stmt = $this->db->prepare($sql);
				if( !empty($id))
				{
					$stmt->bindParam(":id",$id, PDO::PARAM_INT);
				}

			//	echo $sql;
              //  exit;
                if(isset($_SESSION['user']['name']))
                {
                    $uid = $_SESSION['user']['uid'];
                  //  echo $uid;
                }
                else
                {
                    $uid=0;
                }
                //$stmt->bindParam(":uid",$_SESSION['user']['uid'], PDO::PARAM_INT);
			    $stmt->bindParam(":uid",$uid, PDO::PARAM_INT);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();

				return $results;
			}catch( Exception $e)
			{
				die ( $e->getMessage() );
			}
		}

		private function _createEventObj()
		{
			$arr = $this->_loadEventData();

			$events =array();

			foreach($arr as $event)
			{
				$day = date('j',strtotime($event['event_start']));

				try
				{
					$events[$day][] = new Event($event);

				}catch( Excetion $e)
				{
					die ($e->getMessage());
				}

			}

			return $events;
		}

		public function buildCalendar()
		{
			$cal_month = date('F Y',strtotime($this->_useDate));

            $cal_id = date('Y-m',strtotime($this->_useDate));
			$weekdays = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
			// 给日历添加一个标题
			$html = "\n\t<h2 id=\"mouth-$cal_id\">".$cal_month."</h2>";
			for( $d=0,$labels=NULL; $d<7;++$d)
			{
				$labels .= "\n\t\t<li>". $weekdays[$d] ."</li>";
			}
			$html .= "\n\t<ul class=\"weekdays\">"
					. $labels ."\n\t</ul>";


			//载入活动数据
			$events = $this->_createEventObj();

			//生成日历HTML标记

			$html .="\n\t<ul>";
			for($i=1, $c=1,$t=date('j'),$m=date('m'),$y=date('Y');$c<=$this->_daysInMonth;++$i)
			{
				//为起始日之前的那几天添加class fill

				$class = $i<=$this->_startDay ?  "fill" :NULL;

				//如果当日处理日期是今天，则为它添加class today

				if( $c==$t && $m==$this->_m && $y==$this->_y)
				{
					$class = "today";
				}

				$ls = sprintf("\n\t\t<li class=\"%s\">", $class);
				$le = "\n\t\t</li>";

				//添加日历的主题，也就是该月的每一天
				$event_info = NULL;
				if( $this->_startDay<$i && $this->_daysInMonth>=$c)
				{
					///格式化活动数据
					//$event_info = NULL;
					
					if( isset($events[$c]))
					{
						foreach( $events[$c] as $event)
						{
							$link = '<a href="view.php?event_id='. $event->id .'">' . $event->title .'</a>';
							$event_info .= "\n\t\t\t$link";
						}

					}


					$date = sprintf("\n\t\t\t<strong>%02d</strong>",$c++);
				}
				else{ $date="&nbsp;";}

				//如果赶上周六，就新起一行
				$wrap = $i!=0 && $i%7==0 ? "\n\t</ul>\n\t<ul>" : NULL;

				//将以上的组成一个完整的东西
				$html .= $ls .$date . $event_info . $le .$wrap;
			}
			//为最后几天的添加填充项
			while ($i%7!=1)
			{
				$html .= "\n\t\t<li class=\"fill\">&nbsp;</li>";
				++$i;
			}

			$html .= "\n\t</ul>\n\n";

            $admin = $this->_adminGeneralOptions();

			return $html. $admin;
		}

		private function _loadEventById($id)
		{
			if( empty($id) )
			{
				return NULL;
			}


			$event = $this->_loadEventData($id);

		//	var_dump($event[0]);
			if( isset($event[0]))
			{
				//echo "heere";
				return new Event($event[0]);
			}
			else
			{
				return NULL;
			}
		}

		public function displayEvent($id)
		{
		
		//	echo $id;
            if( empty($id)){return NULL;}

			$id = preg_replace('/[^0-9]/', '', $id);

		//	echo $id;

			$event = $this->_loadEventById($id);

			$ts = strtotime($event->start);
			$date = date('F d ,Y ',$ts);
			$start =date('g:ia',$ts);
			$end = date('g:ia',strtotime($event->end));

		//	var_dump($event);
        $admin = $this->_adminEntryOptions($id);

			return "<h2>$event->title</h2>" 
					. "\n\t<p class=\"dates\">$date,$start&mdash;$end</p>"
					. "\n\t<p>$event->description</p>$admin";
		}

        /**
          *生成一个修改或创建活动的表单
          *
          */

        public function displayForm()
        {
           //$_POST['event_id']=1;
           

           if( isset($_POST['event_id']))
            {
                $id = (int) $_POST['event_id'];
                //强制类型转换，保证数据安全
            }
            else
            {
                $id = NULL;
            }

            $submit = "Create a New Event";
            //$event= NULL;
            if(!empty($id))
            {
                $event = $this->_loadEventById($id);

                if(!is_object($event)){return NULL;}

                $submit = "Edit This Event";
            
            
            
            
          //  var_dump($event);
           return <<<HTML
                 <form action="assets/inc/process.inc.php" method="post">
                <fieldset>
                <legend>{$submit}</legend>
                <label for="event_title">Event Title</label>
                <input type="text" name="event_title" id="event_title" value="$event->title" />
                <label for="event_start">Start Time</label>
                <input type="text" name="event_start" id="event_start" value="$event->start"/>
                <label for="event_end">End Time</label>
                <input type="text" name="event_end" id="event_end" value="$event->end"/>
                <label for="event_description">Event Description</label>
                <textarea name="event_description" id="event_description">$event->description</textarea>
                <input type="hidden" name="event_id" value="$event->id"/>
                <input type="hidden" name="token" value="$_SESSION[token]"/>
                <input type="hidden" name="action" value="event_edit"/><br/>
                <input type="submit" name="event_submit" value="$submit"/>
                or <a href="./">cancel</a>
               </fieldset>
               </form>
HTML;
                }
                else
                {
           return <<<HTML
                 <form action="assets/inc/process.inc.php" method="post">
                <fieldset>
                <legend>{$submit}</legend>
                <label for="event_title">Event Title</label>
                <input type="text" name="event_title" id="event_title" value="" />
                <label for="event_start">Start Time</label>
                <input type="text" name="event_start" id="event_start" value=""/>
                <label for="event_end">End Time</label>
                <input type="text" name="event_end" id="event_end" value=""/>
                <label for="event_description">Event Description</label>
                <textarea name="event_description" id="event_description"></textarea>
                <input type="hidden" name="event_id" value=""/>
                <input type="hidden" name="token" value="$_SESSION[token]"/>
                <input type="hidden" name="action" value="event_edit"/><br/>
                <input type="submit" name="event_submit" value="$submit"/>
                or <a href="./">cancel</a>
               </fieldset>
               </form>
HTML;
                    
                }
         /** <<<HTML 起始这一行后面不能有空格
           *  HTML 结束这一行必须没有任何其他字符，除了最后的；  也不能缩进
           *这是文档句法 又称为定界符号
           *
           */
            } ///这里书上写的不好。。。。没有保证如果不传$id 则会warning的！！
        
    /*
    **验证表单，保存/更新活动信息
    **
    **/
    public function processForm()
    {
        if( $_POST['action']!='event_edit') 
        {
            return "The Method processForm was accessd incorrectly";
        }
        //var_dump($_POST);
        //html转义
        //$title = htmlspecialchars($_POST['event_title'],ENT_COMPAT,'GB2312');
       //$desc = htmlspecialchars($_POST['event_description'],ENT_QUOTES);
        $start = htmlentities($_POST['event_start'],ENT_QUOTES);
        $end = htmlentities($_POST['event_end'],ENT_QUOTES);
        //如果提交数据没有活动ID 就创建一个新活动
        //var_dump($_POST);
        $title = addslashes($_POST['event_title']);
        //echo $title."\n";
        $desc = addslashes($_POST['event_description']);
       
        ///日期验证
        if( !$this->_validDate($start) ||  !$this->_validDate($end) )
        {
            return "Invalid date format! Use YYYY-MM-DD HH:MM:SS";
        }

        if( empty($_POST['event_id']))
        {
            $sql = "INSERT INTO cal
                    (event_uid,event_title,event_desc,event_start,event_end)
                    VALUES
                        (:uid,:title,:description,:start,:end)";
            //echo "dd";*/
          //  $sql = "INSERT INTO cal (event_title,event_desc,event_start,event_end) VALUES ('$title','$desc','$start','$end')";
          // echo $sql;


          //  exit;
        }
        else
        {
         // var_dump($_POST);
         // var_dump($_SESSION['user']);
            $id = (int) $_POST['event_id'];
            $uid = (int) $_SESSION['user']['uid'];
           // $uid =1;
            $sql ="UPDATE cal
                    SET
                        event_uid=:uid,
                        event_title=:title,
                        event_desc=:description,
                        event_start=:start,
                        event_end=:end
                        WHERE event_id=$id";
                       // echo $sql;exit;
        }
        //绑定参数查询
        try
        {
            $uid = $_SESSION['user']['uid'];
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":uid",$uid, PDO::PARAM_STR);
            $stmt->bindParam(":title",$title, PDO::PARAM_STR);
            $stmt->bindParam(":description",$desc, PDO::PARAM_STR);
            $stmt->bindParam(":start",$start, PDO::PARAM_STR);
            $stmt->bindParam(":end",$end, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
           //  $this->db->lastInsertId();

            return $this->db->lastInsertId();
          //  return 1;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
   
    /*
    **确认一个活动是否被删除并执行之
    *
    **/
    public function confirmDelete($id)
    {
        if(empty($id)){ return NULL;}

        //确保这个数是个整数
        $id = preg_replace('/[^0-9]/','',$id);

        if( isset($_POST['confirm_delete']) && $_POST['token']==$_SESSION['token'])
        {
       // echo $id;
            if( $_POST['confirm_delete']=="Yes, Delete It")
            {
                $sql = "DELETE FROM cal WHERE event_id =:id LIMIT 1";
               // echo $sql;
               // exit;
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id",$id,PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
                header("Location: ./");
                return;
            }
            catch(Exception $e)
            {
                return $e->getMessage();
            }
             }
             else
             {
                //echo "11";exit;
                 header("Location: ./");
                 return;
             }
        }
        //若表单未提交，显示它
        $event = $this->_loadEventById($id);

        if( !is_object($event)){header("Location： ./");}


        
        return <<<CONFIRM_DELETE
        <form action="confirmdelete.php" method="post">
        <h2>
            你确定删除 "$event->title"?
        </h2>
        <p>There is <strong>no undo</strong> if you continue</p>
        <p>
            <input type="submit" name="confirm_delete" value="Yes, Delete It"/>
            <input type="submit" name="confirm_delete" value="Nope! Just Kidding!"/>
            <input type="hidden" name="event_id" value="$event->id"/>

            <input type="hidden" name="token" value="$_SESSION[token]"/>
        </p>
        </form>
CONFIRM_DELETE;


    }
    

    //添加管理链接
    private function _adminGeneralOptions()
    {
        if( isset($_SESSION['user']['name']))
        {
        //显示管理页面
        return <<<ADMIN_OPTIONS
        <a href="admin.php" class="admin">+ Add a New Event</a>
        <form action="assets/inc/process.inc.php" method="post">
        <div>
            <input type="submit" value="Log Out" class="admin">
            <input type="hidden" name="token" value="$_SESSION[token]">
            <input type="hidden" name="action" value="user_logout">
        </div>
        </form>
ADMIN_OPTIONS;
        }
        else
        {
            return <<<ADMIN_OPTIONS
            <a href="login.php">Log In</a>
ADMIN_OPTIONS;
        }
    }
    //给给定活动ID生成修改和删除按钮
    private function _adminEntryOptions($id)
    {
        if( isset($_SESSION['user']))
        {
        return <<<ADMIN_OPTIONS
        <div class="admin-options">
        <form action="admin.php" method="post">
        <p>
        <input type="submit" name="edit_event" value="Edit This Event"/>
        <input type="hidden" name="event_id" value="$id"/>
        </p>
        </form>
        <form action="confirmdelete.php" method="post">
        <p>
        <input type="submit" name="delete_event" value="Delete This Event"/>
        <input type="hidden" name="event_id" value="$id"/>
        </p>
        </form>
        </div>
ADMIN_OPTIONS;
        }
        else
        {
            return NULL;
        }
    }

    //验证日期字符串
    private function _validDate($date)
    {
        $pattern = "/^(\d{4}(-\d{2}){2} (\d{2})(:\d{2}){2})$/";
            
    //这里对于分组模式匹配的 要搞明白{} 和() 的含义
        //echo $date."<br/ >";
        //$date ="2010-01-01 12:22:22";
//        echo preg_match($pattern, $date);
      //  exit;
        return preg_match($pattern, $date) == 1 ? TRUE : FALSE;
    }
    
}
?>
