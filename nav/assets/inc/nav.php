<?php
    session_start();
    include_once '../../sys/config/db-cred.inc.php';
    foreach( $C as $name => $val)
    {
        define($name, $val);
    
    }
    
    $dsn = "mysql:host=". DB_HOST .";dbname=". DB_NAME;

    $dbo = new PDO($dsn,DB_USER,DB_PASS);
    
    $actions = array(
        'add' => 'url_add',
        'del' => 'url_del',
        'edit' => 'url_edit',
        'tongji' => 'url_tongji'
    );


    if( isset($actions[$_POST['action']]))
    {
        $obj = new Nav($dbo);
        $obj->$actions[$_POST['action']]();      
    }

    function __autoload($class_name)
    {
        $filename = '../../sys/class/class.'
                    .$class_name.'.inc.php';
        if( file_exists($filename))
        {
            include_once $filename;
        }

    }
    

?>
