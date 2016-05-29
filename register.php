<?php
    require("config.php");
    if(!empty($_POST))
    {
        // Ensure that the user fills out fields
        if(empty($_POST['username']))
        { die("Please enter a username."); }
        if(empty($_POST['password']))
        { die("Please enter a password."); }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        { die("Invalid E-Mail Address"); }

        // Check if the username is already taken
        $query = "
            SELECT
                1
            FROM users
            WHERE
                username = :username
        ";
        $query_params = array( ':username' => $_POST['username'] );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
        $row = $stmt->fetch();
        if($row){ die("This username is already in use"); }
        $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";
        $query_params = array(
            ':email' => $_POST['email']
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());}
        $row = $stmt->fetch();
        if($row){ die("This email address is already registered"); }

        // Add row to database
        $query = "
            INSERT INTO users (
                username,
                password,
                salt,
                email
            ) VALUES (
                :username,
                :password,
                :salt,
                :email
            )
        ";

        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $_POST['password'] . $salt);
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); }
        $query_params = array(
            ':username' => $_POST['username'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
        header("Location: index.php");
        die("Redirecting to index.php");
    }
?>

    <!doctype html>
    <html lang="ru">

    <head>
        <meta charset="utf-8">
        <title>Регистрация</title>
        <meta name="description" content="my work">
        <?php require("links.php"); ?>
    </head>

    <body>
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
                        <li><a href="index.php">Главная</a></li>
                        <li class="active"><a href="register.php">Регистрация</a></li>
                        <!-- <li><a href="#contact">Contact</a></li>-->
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
        <div id="main">
            <div class="container">
				<div class="row">
                <div class="col-md-4 col-xs-12">
					<h1>Регистрация</h1>
						<br />
						<form action="register.php" method="post">
							<div class="form-group">
								<label for="username">Логин:</label>
								<input class="form-control" type="text" name="username" value="" />
							</div>
							<div class="form-group">
								<label for="email">Е-мейл:</label>
								<input class="form-control" type="text" name="email" value="" />
							</div>
							<div class="form-group">
								<label for="password">Пароль:</label>
								<input class="form-control" type="password" name="password" value="" />
							</div>
							<br/><input type="submit" class="btn btn-primary btn-lg" value="Регистрация">
						</form>
					</div>
                </div>
            </div>
        </div>
    </body>

    </html>
