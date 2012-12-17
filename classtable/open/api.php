<?php
    function result($state,$info)
    {
        return "{\"state\":\"".$state."\",\"info:\"$info\"}";   
    }

    if(!isset($_GET['username']) || !isset($_GET['password']))
    {
        $result = result("error","no input username or password");
        echo $result;
        exit;
    }
    if(!isset($_GET['method']))
    {
        $result = result("error","no input method");
        echo $result;
        exit;
    }
    
    $action = array("json"=>"classtablejson",
                    "xml"=>"classtablexml"
                    );


  //  echo $_GET['method'];
    if($_GET['method']!="json" && $_GET['method']!="xml")
    {
        $result = result("error","should be json or xml");
        echo $result;
        exit;
    }
    else
    {
        $method = $_GET['method'];
        $username = $_GET['username'];
        $password = $_GET['password'];
        
        $method = htmlspecialchars($method);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);
        $method = addslashes($method);
        $username = addslashes($username);
        $password = addslashes($password);

        require "class.".$method.".php";
        $res =  $action[$method]($username,$password);

        if($method=="xml")
        {
            echo $res;
        }
        if($method == "json")
        {
           // var_dump( json_decode($res));
            echo $res;
        }


    }
