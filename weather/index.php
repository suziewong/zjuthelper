<?php
    if(file_exists('weather.html'))
    {
        $time = time();

        if($time - filemtime("weather.html") < 10*60)
        {
            
           
            header("Location:weather.html");
            exit;
        }
    }

    ob_start();

    include 'weather.php';
    $content = ob_get_contents();

    ob_end_clean();

    file_put_contents("weather.html",$content);

    
            header("Location:weather.html");
?>
