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
        <title>CRUD WORK</title>
        <meta name="description" content="my work">
		<?php require("links.php"); ?>
    </head>
    <body>
        <div id="wrap">
            <nav class="navbar navbar-inverse" style="margin-bottom: 0;">
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
                            <li class="active"><a href="#">Главная</a></li>
                            <li><a href="shop.php">Магазин</a></li>
                            <li><a href="register.php">Регистрация</a></li>
                            <!-- <li><a href="#contact">Contact</a></li>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Войти <span class="caret"></span></a>
                                <div class="dropdown-menu" style="padding: 15px;width: 220px;">
                                    <form action="index.php" method="post">
                                        <div class="form-group">
                                            <label for="username">Логин:</label>
                                            <input type="text" class="form-control" name="username" value="<?php echo $submitted_username; ?>" /> </div>
                                        <div class="form-group">
                                            <label for="password">Пароль:</label>
                                            <input type="password" class="form-control" name="password" value="" /> </div>
                                        <input type="submit" class="btn btn-info" value="Войти" />
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>
            <div class="jumbotron">
                <div class="container">
                    <h1>Добрый день!</h1>
                    <br/>
                    <p>Для того чтобы зайти в магазин необходимо <a href="register.php">Зарегистрироваться</a>, либо можно использовать дефолнтый логин и пароль:<br/>
                    <pre>login: admin<br/>password: password</pre>
                    </p>
                    <br/>
                    <p><a class="btn btn-primary btn-lg" href="register.php" role="button">Регистрация</a></p>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <?php require("footer.php"); ?>
    </body>
</html>
