<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: index.php");
        die("Redirecting to index.php");
    }
?>
    <!doctype html>
    <html lang="ru">

    <head>
        <title>Добавить новый товар</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="my work">
        <?php require("links.php"); ?>
    </head>

    <body>
        <div id="wrap">
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
                        <div class="row">
                            <?php
                                header('Content-Type: text/html; charset=utf-8');
                                require("bd.php");
                                if (isset($_POST['name']) && isset($_POST['img']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {
                                        $name = $_POST['name'];
                                        $img = $_POST['img'];
                                        $desc = $_POST['description'];
                                        $cat = $_POST['category'];
                                        $price = $_POST['price'];
                                        $rez = mysql_query("INSERT INTO goods (name,img,description,price,cat_id) VALUES ('$name','$img','$desc','$price','$cat')");

                                        if ($rez == 'true') {echo '
                                        <div class="alert alert-success" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <p>Товар успешно добавлен</p>
                                                            </div>
                                        ';
                                        } else {
                                        echo '
                                         <div class="alert alert-danger" role="alert">
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <p>Что-то пошло не так</p>
                                         </div>
                                        ';
                                        }
                                    }
                                ?>
                                <div class="bs-example" data-example-id="basic-forms">
                                    <form action="/add.php" method="post" name="form1" accept-charset="UTF-8">
                                        <div class="form-group">
                                            <label for="category">Категория</label>
                                            <select class="form-control" name="category">
                                                <option value="1">Телевизоры</option>
                                                <option value="2">Телефоны</option>
                                                <option value="3">Планшеты</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Имя</label>
                                            <input type="text" class="form-control" name="name" placeholder="Имя">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Изображение(url)</label>
                                            <input type="text" class="form-control" name="img" placeholder="Изображение">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Описание</label>
                                            <textarea class="form-control" rows="3" name="description" placeholder="Описание"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Цена</label>
                                            <input type="text" class="form-control" name="price" placeholder="Цена">
                                        </div>
                                        <button type="submit" class="btn btn-default">Добавить</button>
                                    </form>
                                </div>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/.col-xs-12.col-sm-9-->

                    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
                        <?php include('sidebar.php') ?>
                    </div>
                    <!--/.sidebar-offcanvas-->
                    <?php mysql_close(); ?>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <?php require("footer.php"); ?>

    </body>

    </html>
