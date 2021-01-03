<?php

session_start();
require_once 'classes/classes.php';

if(!empty($_SESSION['account_id'])){
    echo '<a href="logout">Выход|</a>';
    echo '<a href="index">Калькулятор|</a>';
    echo 'Hello: ' .
        userNickName::checkId($_SESSION);
    $status = userStatus::checkStatus($_SESSION);
    if ($status == 'admin'){
        echo  '<title>Новости</title><form method="post" action="portal/admin">';
        echo "<input type='hidden' >" . '<input type="submit" value="Написать статью">';
        echo '</form>';
    }

}else{
    echo 'вы не авторизованы';
    echo  '<form action="login">';
    echo "<input type='hidden' >" . '<input type="submit" value="Войти">';
    echo '</form>';
    echo  '<form action="registration">';
    echo "<input type='hidden' >" . '<input type="submit" value="Регистрация">';
    echo '</form>';
}

viewArticles::viewArticlesPosts();