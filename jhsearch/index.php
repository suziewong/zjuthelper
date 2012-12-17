<?php
    require '../public/commons/header.project.js.html';
?>

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

        #first_a{
    width:316px;
    border:2px solid #CCC;
 //   margin-left:200px;
}
#first_a tr:hover{
    background:#969;
}
#first_a table{
    width:100%;
}
#first_a{
    display:none;
}
    </style>
    <script>
        $(function(){
    $("#first").find(":input").focus().live('keyup',function(){
        //获取keyup传输进来的值
        var nkey=$.trim($(this).val());
        //alert(nkey);
        //若值为空则不显示;
        if(nkey==''||nkey==null){
            $("#first_a").hide();
        }else{
            //异步传输
            $.post('auto.php',{name:nkey},function(v){
                $("#first_a").html(v);
                $("#first_a").show("slow");
                //对生成出来的表格里面的值进行操作
                $("#first_a table tr td").click(function(){
                    $("#a").val($(this).html()) ;
                    $("#first_a").hide() ;
                })
            });
            
        }
            
    })
})
    </script>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="pull-left" style="margin-top: 7px; margin-right: 5px;" href="/">
                    <img src="../public/img/jh_logo11.png" style="max-height: 26px;">
                </a>
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="../">工大助手</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li><a href="../">首页</a></li>
                        <li class="active"><a href="./">人肉</a></li>
                        <li><a href="../classtable">课表</a></li>
                        <li><a href="./bus.html">校车时刻表</a></li>
                        <li><a href="../cal/public">日历</a></li>
                        <li><a href="../weather">天气</a></li>
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
        <h1 class="start">人肉搜索</h1>
        
        <form class="metro-form" style="margin-top: 20px;" action="result.php" method="post">
            <div class="metro-form-control" style="width: 300px">
                <label>请输入：</label>
                <div class="metro-text-box" id="first">
                    <input id="a" type="text" autofocus name="value" value="" />
                    <div id="first_a"></div>
                    <span class="helper"></span>
                </div>
            </div>
                    <label class="metro-radio">
                        <input type="radio" name="type" value="username" checked="">
                        <span>Name</span>
                    </label>
                    <label class="metro-radio">
                        <input type="radio" name="type" value="uid">
                        <span>UID</span>
                    </label>
                    <label class="metro-radio">
                        <input type="radio" name="type" value="stunum" >
                        <span>学号</span>
                    </label>
                    <label class="metro-radio">
                        <input type="radio" name="type" value="email">
                        <span>邮箱</span>
                    </label>
			<div width="90"><input type="submit" class="metro-button" name="submit" value="肉一下"></a></div>
        </form>
    </div>
     <div class="span5" style ="margin-left:180px;margin-top:80px">
                    <h1>Important</h1>
                    <h2>精弘内部人员使用，请勿外传</h2>
                    <br>
                    <p class="">
						<ul>
							<li>可以根据昵称,学号，邮箱，uid查人</li>
							<li>可以根据校园卡漏洞继续肉人</li>
							<li>算法 1.一个邮箱，学号，都可以有多个帐号</li>
						</ul>
                    </p>
                    <p>
                        Browsers: IE 9+, Chrome, Opera, Safari, Firefox
                    </p>

    </div>
</div>



        <footer class="footer">
            <p class="pull-right"><a href="#">Metro</a></p>

            <p>© 2002-2012 <a href="http://www.zjut.com">精弘网络</a>..</p>
        </footer>
</div>

    <script type="text/javascript">
        $(".metro").metro();
    </script>

	
</body>
</html>
