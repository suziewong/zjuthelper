<?php require '../public/commons/header.project.js.html';?>
<link rel="stylesheet" type="text/css" media="screen,projection" href="assets/css/admin.css"/>
<link rel="stylesheet" type="text/css" media="screen,projection" href="assets/css/ajax.css"/>
<link rel="stylesheet" type="text/css" media="screen,projection" href="assets/css/overlay.css"/>

    <style type="text/css">
        body {
            background: #004050;
        }
        .metro {
            width: 940px;
            overflow: hidden;
        }
        .start {
			margin-top:20px;
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
                        <li><a href="../weather/">天气</a></li>
                        <li class="active"><a href="../nav/">导航</a></li>
        </div>
                    </ul>
                    <ul class="nav pull-right">
                    <?php require '../public/commons/header.project.nav.php';?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="container metro">
 <div class="row">
     <div class="span5">
        <h1 class="start">自定义导航</h1>
        
        <?php

        if(isset($_SESSION['user']['uid']))
        echo <<<self
        <a href="admin.php" class="admin" id="fast"> Fast add </a>
        <a  class='admin' id="action" href="javascript:void(0);"> + Add a nav</a>
        <div id="fastinput"></div>
self;
        ?>
        <hr/>
        <?php
            include_once './sys/core/init.inc.php';

            $nav = new Nav();

            $nav->buildNav(); 
        ?>
    </div>
     <div class="span5" style ="margin-left:180px;margin-top:80px">
                    <h1>Important</h1>
                    <h2>PHP Ajax MySQL </h2>
                    <br>
                    <p class="">
						<ul>
							<li>使用学号登录</li>
							<li>功能模仿百度首页</li>
							<li>目前使用MySQL数据库</li>
							<li>觉得MongoDB蛮好的，想玩玩看，自己已经用MongoDB写了个留言板</li>
						</ul>
                    </p>
                    <p>
                       直接上的Ajax，未遵'渐进增强'原则,稍后补上
                    </p>

    </div>
</div>

<!--自定义导航overlay-->
<div class="overlay" style="height: 1424px; display: none; opacity: 0; "></div>
<div class="destroy" style="opacity: 0; margin-top: -292px; ">
    <div class="sheet">
        <div class="head">
            <h2>自定义导航</h2>
        </div>
        <div class="body">
            <h4>name:</h4><input type='text' />
            <h4>url:</h4><input type='text' />
        <a href="admin.php" class="admin" >add </a>
            <hr/>
            <?php
                for($i=0;$i<20;$i++)
                echo "<a href='http://www.zjut.com/' class='admin' alt='点击增加' id='overlay_url'>常用网址</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            ?>
            <h2>点击添加到自定义导航</h2>
        </div>
        <a class="close" title="关闭" href="#">关闭</a>
    </div>
</div><!--sheet end-->


        <footer class="footer" style="margin-top:28%">

            <p class="pull-right"><a href="#">Metro</a></p>

            <p>© 2002-2012 <a href="http://www.zjut.com">精弘网络</a>..</p>
        </footer>
</div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>

	
<script type="text/javascript" src="assets/js/jquery-1.4.4.min.js"></script>
     <script type="text/javascript" src="assets/js/init.js"></script>


 </body>
</html>
