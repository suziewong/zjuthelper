                        <?php
                            session_start();
                            if(isset($_SESSION['user']))
                            {
                                    $username = $_SESSION['user']['name'];
                                    echo "<li><a style='color:#F5B208; font-weight:bold;'>".$username."</a></li>";
                                    echo "<li><a href='../process.php?action=user_logout'>注销</a></li>";
                             }
                           else
                           {
                            echo "<li><a href='../login.php'>登录</a></li>";
                             }
                        ?>
