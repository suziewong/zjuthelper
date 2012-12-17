<?php
    session_start();

    include_once '../../../sys/config/db-cred.inc.php';

    foreach ($C as $name => $val)
    {
        define($name, $val);
    }
    $dsn = "mysql:host=". DB_HOST .";dbname=". DB_NAME;
    $dbo = new PDO($dsn,DB_USER,DB_PASS);
    //为表单action创建一个查找数组
$actions = array(
            'event_view' => array(
                'object' =>  'Calendar',
                'method'=> 'displayEvent'
            ),
            'edit_event' => array(
                'object' =>  'Calendar',
                'method'=> 'displayForm'
            ),
            'event_edit' => array(
                'object' =>  'Calendar',
                'method'=> 'processForm'
            ),
            'delete_event' => array(
                'object' =>  'Calendar',
                'method'=> 'confirmDelete'
            ),
            'confirm_delete' => array(
                'object' =>  'Calendar',
                'method'=> 'confirmDelete'
            )
        );
    //确保传入防止跨站的攻击记号并且action存在与这个查找数组之中
   // echo ":q1111111";
    if( isset($actions[$_POST['action']]))
    {
        $user_array = $actions[$_POST['action']];
        $obj = new $user_array['object']($dbo);

        if( isset($_POST['event_id']))
        {
            $id = (int) $_POST['event_id'];
          //  echo $id;

        }
        else
        {
            $id = NULL;
        }

         //echo $id;
        echo $obj->$user_array['method']($id);
    }

    function __autoload($class_name)
    {
        $filename = '../../../sys/class/class.'
                    .$class_name.'.inc.php';
       // echo $filename;
        if( file_exists($filename))
        {
            include_once $filename;
        }

       // include_once '../../../sys/class/class.Calendar.inc.php';
    }
?>
