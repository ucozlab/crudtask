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
            <meta charset="utf-8">
            <title>Магазин</title>
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

                    <div class="col-xs-12 col-sm-9">
                        <p class="pull-right visible-xs">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                        </p>
                        <div class="jumbotron">
                            <h1>Добро пожаловать!</h1>
                            <p>Теперь можно добавить категории и товары магазина</p>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                            </div>
                            <!--/.col-xs-6.col-lg-4-->
                            <div class="col-xs-6 col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                            </div>
                            <!--/.col-xs-6.col-lg-4-->
                            <div class="col-xs-6 col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                            </div>
                            <!--/.col-xs-6.col-lg-4-->
                            <div class="col-xs-6 col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                            </div>
                            <!--/.col-xs-6.col-lg-4-->
                            <div class="col-xs-6 col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                            </div>
                            <!--/.col-xs-6.col-lg-4-->
                            <div class="col-xs-6 col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                            </div>
                            <!--/.col-xs-6.col-lg-4-->
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
                                Panel content
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Товары</h3>
                            </div>
                            <div class="panel-body">
                                Panel content
                            </div>
                        </div>
                    </div>
                    <!--/.sidebar-offcanvas-->
                </div>
            </div>
        </body>

        </html>
