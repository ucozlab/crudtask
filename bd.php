<?php
// Соединяемся с сервером БД
$link = mysql_connect("xc219455.mysql.ukraine.com.ua", "xc219455_db", "ekjr5gkY") or die (mysql_error ());
// Выбираем нашу Базу Данных
mysql_set_charset('utf8', $link);
mysql_select_db("xc219455_db") or die(mysql_error());
?>
