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
			margin-top:80px;
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
                        <li class="active"><a href="../classtable/">课表</a></li>
                        <li><a href="../weather/">天气</a></li>
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
        <h1 class="start">查课表</h1>
        
        <form class="metro-form" style="margin-top: 20px;" action="class.php" method="post">
            <div class="metro-form-control" style="width: 300px">
                <label>请输入：</label>
                <div class="metro-text-box">
                    <input type="text" autofocus name="username" value="学号" />
                    <span class="helper"></span>
                </div>
                <div class="metro-text-box" style="margin-top:10px">
                    <input type="password" class="text" name="password" value="" />
                    <span class="helper"></span>
                </div>
            </div>
			<div width="90"><input type="submit" class="metro-button" name="submit" value="查一下"></a></div>
        </form>
    </div>
     <div class="span5" style ="margin-left:180px;margin-top:80px">
                    <h1>Important</h1>
                    <h2>PHP CURL </h2>
                    <br>
                    <p class="">
						<ul>
							<li>原创教务系统是ASPX</li>
							<li> API 输出JSON && XML</li>
							<li>对于文字转码 不是很了解</li>
						</ul>
                    </p>
                    <p>
                        API地址请联系精弘网络技术部
                    </p>

    </div>
</div>



        <footer class="footer" style="margin-top:28%">

            <p class="pull-right"><a href="#">Metro</a></p>

            <p>© 2002-2012 <a href="http://www.zjut.com">精弘网络</a>..</p>
        </footer>
</div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>

	
</body>
</html>
