<?php
       include "public/commons/header.js.html";
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
    </style>
      </head>
    <body>
<?php
     include "public/commons/header.nav.php";
?>
<div class="container metro">
 <div class="row">
     <div class="span5">
        <h1 class="start">登录</h1>
        
        <form class="metro-form" style="margin-top: 20px;" action="process.php?action=user_login" method="post">
            <div class="metro-form-control" style="width: 300px">
                <label>请输入：</label>
                <div class="metro-text-box">
                    <input type="text" autofocus name="username" value="用户名" />
                    <span class="helper"></span>
                </div>
                <div class="metro-text-box" style="margin-top:10px">
                    <input type="password"  name="password" value="" />
                    <span class="helper"></span>
                </div>
            </div>
			<div width="90"><input type="submit" class="metro-button" name="submit" value="登录"></a></div>
        </form>
    </div>
     <div class="span5" style ="margin-left:180px;margin-top:80px">
                    <h1>Important</h1>
                    <br>
                    <p class="">
						<ul>
							<li>精弘用户中心API</li>
							<li>UCenter同步登录？？</li>
							<li>持续开发中</li>
						</ul>
                    </p>
                    <h2>
                        精弘服务接口化..
                    </h2>

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
