 <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="pull-left" style="margin-top: 7px; margin-right: 5px;" href="/">
                    <img src="public/img/jh_logo11.png" style="max-height: 25px;">
                </a>
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="./">工大助手</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="active"><a href="index.php">首页</a></li>
                        <li><a href="./jhsearch/">人肉</a></li>
                        <li><a href="./classtable/">课表</a></li>
                        <li><a href="./cal/public/">日历</a></li>
                        <li><a href="./bustable.html">校车时刻表</a></li>
                        <li><a href="./weather/">天气</a></li>
                        <li><a href="./nav/">导航</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <?php
                            session_start();
                            if(isset($_SESSION['user']))
                            {
                                    $username = $_SESSION['user']['name'];
                                    echo "<li><a style='color:#F5B208; font-weight:bold;'>".$username."</a></li>";
                                    echo "<li><a href='process.php?action=user_logout'>注销</a></li>";
                             }
                           else
                           {
                            echo "<li><a href='./login.php'>登录</a></li>";
                             }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
