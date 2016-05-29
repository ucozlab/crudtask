<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: index.php");
        die("Redirecting to index.php");
    }
?>

    <?php
    require("config.php");
    $submitted_username = '';
    if(!empty($_POST)){
        $query = "
            SELECT
                id,
                username,
                password,
                salt,
                email
            FROM users
            WHERE
                username = :username
        ";
        $query_params = array(
            ':username' => $_POST['username']
        );

        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
        $login_ok = false;
        $row = $stmt->fetch();
        if($row){
            $check_password = hash('sha256', $_POST['password'] . $row['salt']);
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            if($check_password === $row['password']){
                $login_ok = true;
            }
        }

        if($login_ok){
            unset($row['salt']);
            unset($row['password']);
            $_SESSION['user'] = $row;
            header("Location: shop.php");
            die("Redirecting to: shop.php");
        }
        else{
            print("Login Failed.");
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }
    }
?>
        <!doctype html>
        <html lang="ru">

        <head>
            <title>Магазин</title>
            <meta charset="utf-8">
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <meta name="description" content="my work">
            <?php require("links.php"); ?>
        </head>

        <body>
            <nav class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Меню</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">CRUD WORK</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Главная</a></li>
                            <li class="active"><a href="shop.php">Магазин</a></li>
                            <li><a href="logout.php">Привет <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, Выйти</a></li>
                            <!-- <li><a href="#contact">Contact</a></li>-->
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>
            <div class="container">
                <div class="row row-offcanvas row-offcanvas-right">
                    <?php require("bd.php"); ?>
                    <div class="col-xs-12 col-sm-9">
                        <p class="pull-right visible-xs">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                        </p>
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Добро пожаловать!</strong> <p>Теперь можно добавить категории и товары магазина</p>
                        </div>
                        <script>
                            if (localStorage.getItem("alert") === null) {
                                $('.alert').on('closed.bs.alert', function () {
                                    localStorage.setItem('alert',false);
                                });
                            } else {
                                $('.alert').hide();
                            }
                        </script>
                        <div class="row">
                           <?php
                                // get page
                                $pagename = $_SERVER[REQUEST_URI];
                                mysql_query("SET NAMES UTF8");
                                mysql_query("SET CHARACTER SET UTF8");
                                if (strpos($pagename, 'category') !== false) {
                                    $pieces = explode("/shop.php?category=", $pagename);
                                    $q = mysql_query("SELECT * FROM  `goods` WHERE  `cat_id` = ".$pieces[1]." ");
                                } else if(strpos($pagename, 'good') !== false){
                                    $pieces = explode("/shop.php?good=", $pagename);
                                    $q = mysql_query("SELECT * FROM  `goods` WHERE  `id` = ".$pieces[1]." ");
                                } else {
                                    $q = mysql_query("SELECT * FROM  `goods`");
                                }
                                // loop the get the results
                                while($result = mysql_fetch_array($q)) {
                                    // $result["img"];
                                    echo '
                                      <div class="col-xs-6 col-lg-4">
                                      <h3>'.$result["name"].'</h3>
                                      <div class="goods_img"><img src="'.$result["img"].'"></div>
                                      <div class="goods_desc">'.$result["description"].'</div>
                                      <p><span class="label label-success">'.$result["price"].' UAH</span></p>
                                    ';
                                    if (strpos($pagename, 'good') === false) {
                                        echo ' <p><a class="btn btn-default" href="/shop.php?good='.$result["id"].'" role="button">View details »</a></p>';
                                    }
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/.col-xs-12.col-sm-9-->

                    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Категории</h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                <?php
                                    mysql_query("SET NAMES UTF8");
                                    mysql_query("SET CHARACTER SET UTF8");
                                    $result = mysql_query("SELECT * FROM  `category` LIMIT 0 , 30") or die("Invalid query: " . mysql_error());
                                    while ($row = mysql_fetch_array($result)) {
                                       //echo $row["Name"].", Room ".$row["Room"].", Tel ".$row["Telephone"] ;
                                        echo "<li><a href='shop.php?category=".$row['id']."'>".$row["name"]."</a></li>";
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Товары</h3>
                            </div>
                            <div class="panel-body">
                               <ul>
                                   <?php
                                    require("bd.php");
                                    mysql_query("SET NAMES UTF8");
                                    mysql_query("SET CHARACTER SET UTF8");
                                    $result = mysql_query("SELECT * FROM  `goods` LIMIT 0 , 30") or die("Invalid query: " . mysql_error());
                                    while ($row = mysql_fetch_array($result)) {
                                       //echo $row["Name"].", Room ".$row["Room"].", Tel ".$row["Telephone"] ;
                                        echo "<li><a href='shop.php?good=".$row['id']."'>".$row["name"]."</a></li>";
                                    }
                                ?>
                               </ul>
                            </div>
                        </div>
                    </div>
                    <!--/.sidebar-offcanvas-->
                    <?php mysql_close(); ?>
                </div>
            </div>
        </body>

        </html>
