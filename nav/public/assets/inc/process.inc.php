<?php
    session_start();

    include '../../../sys/config/db-cred.inc.php';

    foreach($C as $name => $val)
    {
        define($name, $val);
    }

    $dsn = "mysql:host=". DB_HOST .";dbname=". DB_NAME;
    $dbo = new PDO($dsn,DB_USER,DB_PASS);

    $actions = array(
           'event_edit' => array(
                'object' => 'Calendar',
                'method' => 'processForm',
                'header' => 'Location: ../../'
            ),
           'user_login' => array(
                'object' => 'Admin',
                'method' => 'processLoginForm',
                'header' => 'Location: ../../'
            ),
           'user_logout' => array(
                'object' => 'Admin',
                'method' => 'processLogout',
                'header' => 'Location: ../../'
            )
    );

   // var_dump($_POST);
    if( $_POST['token']==$_SESSION['token'] && isset($actions[$_POST['action']]))
    {
        $use_array = $actions[$_POST['action']];
        $obj = new $use_array['object']($dbo);
        //$msg=$obj->$use_array['method']();
        if( 0 <= $msg=$obj->$use_array['method']())
        {
            
            header($use_array['header']);
          //  echo "11111";
            exit;
            //echo "dd";
        }
        else
        {
            
            die( $msg);
        }
    }
    else
    {
        header("Location: ../../");
        exit;
    }

    function __autoload($class_name)
    {
        $filename = '../../../sys/class/class.'
        . $class_name . '.inc.php';
        if(file_exists($filename))
        {
            include_once $filename;
        }
        //include_once '../../../sys/class/class.Calendar.inc.php';
    }


?>
