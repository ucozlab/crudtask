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
        <title>Редактировать товар</title>
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
                                mysql_query("SET NAMES UTF8");
                                mysql_query("SET CHARACTER SET UTF8");
                                $good = $_GET['good'];

                                if (isset($_POST['name']) && isset($_POST['img']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price'])) {

                                        $name = $_POST['name'];
                                        $img = $_POST['img'];
                                        $desc = $_POST['description'];
                                        $cat = $_POST['category'];
                                        $price = $_POST['price'];
                                        $id = $_POST['id'];
                                        $query = "UPDATE  `xc219455_db`.`goods` SET  `name` =  '$name', `img` =  '$img', `description` =  '$desc', `price` =  '$price', `cat_id` =  '$cat' WHERE  `goods`.`id` = '$good' ";
                                        if ($db->exec($query)) {echo '
                                        <div class="alert alert-success" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <p>Товар успешно отредактирован</p>
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
                                if (isset($_POST['remove'])) {
                                    $query = "DELETE FROM `xc219455_db`.`goods` WHERE `goods`.`id` = '$good' ";

                                    if ($db->exec($query)) {
                                        echo '
                                        <div class="alert alert-danger" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <p>Товар успешно удален</p>
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
                                <?php
                                    try{
                                        $rez = $db->query("SELECT * FROM  `goods` WHERE  `id` = ".$good." ");
                                       // $result = $stmt->execute($query_params);
                                    }
                                    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
                                ?>
                                    <?php
                                        if (isset($_POST['remove'])) {
                                            echo ('<a href="/shop.php" class="btn btn-primary">Вернуться назад</a>');
                                        } else {
                                            $result = $rez->fetch();
                                        ?>
                                        <div class="bs-example" data-example-id="basic-forms">
                                            <form action="/edit.php?good=<?php echo $good?>" method="post" name="form1" accept-charset="UTF-8">
                                                <fieldset disabled="disabled">
                                                    <div class="form-group">
                                                        <label for="id">id товара</label>
                                                        <input type="text" name="id" class="form-control" placeholder="<?php echo $result['id']?>" value="<?php echo $result['id']?>"> </div>
                                                </fieldset>
                                                <div class="form-group">
                                                    <label for="category">Категория</label>
                                                    <select class="form-control" name="category">
                                                        <option value="1">Телевизоры</option>
                                                        <option value="2">Телефоны</option>
                                                        <option value="3">Планшеты</option>
                                                    </select>
                                                    <script>
                                                        $('select.form-control option[value="<?php echo $result['cat_id']?>"]').attr('selected', true);
                                                        $('select.form-control').change();
                                                    </script>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Имя</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Имя" value="<?php echo $result['name']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Изображение(url)</label>
                                                    <input type="text" class="form-control" name="img" placeholder="Изображение" value="<?php echo $result['img']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Описание</label>
                                                    <textarea class="form-control" rows="3" name="description" placeholder="Описание">
                                                        <?php echo $result['description']?>
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Цена</label>
                                                    <input type="text" class="form-control" name="price" placeholder="Цена" value="<?php echo $result['price']?>">
                                                </div>
                                                <button type="submit" class="btn btn-success">Редактировать</button>
                                            </form>
                                        </div>
                                        <?php
                                            }

                            ?>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/.col-xs-12.col-sm-9-->

                    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
                        <?php include('sidebar.php') ?>
                            <form action="/edit.php?good=<?php echo $good?>" method="post" name="form2" accept-charset="UTF-8">
                                <input type="hidden" name="remove" placeholder="Цена" value="<?php echo $good?>">
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                    </div>
                    <!--/.sidebar-offcanvas-->
                    <?php $db = NULL; ?>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <?php require("footer.php"); ?>

    </body>

</html>
