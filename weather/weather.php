<?php require '../public/commons/header.project.js.html';?>
    <style type="text/css">
        body {
            background: #004050;
        }
        .metro {
            width: 940px;
            overflow: hidden;
        }
        .start {
			margin-top:10px;
        }

    </style>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="pull-left" style="margin-top: 7px; margin-right: 5px;" href="/">
                    <img src="../public/img/jh_logo11.png" style="max-height: 16px;">
                </a>
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="../index.php">工大助手</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li><a href="../index.php">主页</a></li>
                        <li><a href="../jhsearch/">人肉</a></li>
                        <li><a href="../classtable/">课表</a></li>
                        <li class="active"><a href="./index.php">天气</a></li>
        </div>
                    </ul>
                    <ul class="nav pull-right">
                    <?php //require '../public/commons/header.project.nav.php';?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="container metro">
 <div class="row">
     <div class="span5">
        <?php
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,'http://weather.raychou.com/?/detail/58457/rss');
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            $weather=curl_exec($curl);//
            curl_close($curl);
           // $weather =  simplexml_load_file("http://weather.raychou.com/?/detail/58457/rss");
           $weather =  simplexml_load_string($weather);
        ?>
        <h2>今天</h2>
        <div style="width:480px;">
            <?php
                echo "<h2 style='color:#0064cd;'>".$weather->channel->item[0]->description."</h2>";
            ?>
        </div>
        <h2 class="start">杭州未来七天</h2>
        <table border="2" width="480px">
            <tr>
        <th>日期</th>
        <th>天气</th>
    </tr>
        <?php

            //$weather = file_get_contents("http://weather.raychou.com/?/detail/58457/rss");

            for($i = 0; $i <7 ;$i++ )
            {
                echo "<tr>";  
                echo "<td>";
                echo $weather->channel->item[$i]->title;
                echo "</td>";
                echo "<td>".$weather->channel->item[$i]->description."</td>";
                echo "</tr>";  
            }

        //  var_dump($weather);
        ?>
        </table>
    </div>
     <div class="span5" style ="margin-left:120px;">
                     <h2 class="start">杭州24小时实时气象</h2>
        <table border="2" width="440px">
        <tr>
                 <th scope="" class="">日期</th>
                 <th scope="col">温度/℃</th>
                 <th scope="col">气压/hPa</th>
                 <th scope="col">能见度/km</th>
                 <th scope="col">相对湿度/%</th>
        </tr>

            <?php

            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,'http://hangzhoutemper.sinaapp.com/json.php');
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            $weather2=curl_exec($curl);//
            curl_close($curl);

        //    $weather2 = file_get_contents("http://hangzhoutemper.sinaapp.com/json.php");
              $weather2array = json_decode($weather2,true);
              for($j=23 ;$j>13;$j--)
              {

                echo "<tr>";
                echo "<td>".$weather2array[$j]['updateTime']."</td>";
                echo "<td>".$weather2array[$j]['temperature']."</td>";
                echo "<td>".$weather2array[$j]['pressure']."</td>";
                echo "<td>".$weather2array[$j]['visibility']."</td>";
                echo "<td>".$weather2array[$j]['humidity']." %</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
    <h2>
       考虑到天气不是经常换，所以准备加上缓存为静态文件。
    </h2>


        <footer class="footer" style="">

            <p class="pull-right"><a href="#">Metro</a></p>

            <p>© 2002-2012 <a href="http://www.zjut.com">精弘网络</a></p>
        </footer>
</div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>

	
</body>
</html>
