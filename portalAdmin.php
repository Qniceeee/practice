<?php
session_start();
require_once 'classes/classes.php';
if(!empty($_SESSION['account_id'])){
    echo '<a href="/state1/news/logout">Выход|</a>';
    echo '<a href="/state1/news/index">Калькулятор|</a>';
    echo 'Hello: ' .
        userNickName::checkId($_SESSION);
   $status = userStatus::checkStatus($_SESSION);

}else{
    echo 'вы не авторизованы';
    echo  '<form action="login">';
    echo "<input type='hidden' >" . '<input type="submit" value="Войти">';
    echo '</form>';
    echo  '<form action="registration">';
    echo "<input type='hidden' >" . '<input type="submit" value="Регистрация">';
    echo '</form>';
}


$watd2 = '<title>Админ панель</title>


<form method="post" action="createArticle">
    <input type="text" name="newCategory" placeholder="Введите название">
    <input type="submit" value="Создать Категорию">
</form>';



if(!empty($newCategory)){
}else{
    $newCategory = null;
}
$watd3 = '<form method="post">
    <select name="category" >';





$watd1 = '    </select>
    <p><input type="text" name="title_article" placeholder="Введите заголовок"></p>
    <textarea name="text_article">

    </textarea>
    <p><input type="submit" name="createArticle"></p>
</form>';
if ($status == 'admin'){
    echo $watd2;
    echo $watd3;
    articles::renderArticles();
    echo $watd1;
    if (!empty($_POST)){
        $title_article = $_POST['title_article'];
        $text_article = $_POST['text_article'];
        $category = $_POST['category'];
        $login = userNickName::checkId($_SESSION);
        $account_id = $_SESSION['account_id'];
        postArticles::sqlArticles($title_article,$text_article,$category,$login,$account_id);
        echo 'Статья сохранена';
    }
    else{
        echo 'Введите текст';
    }

}else{
    echo '<title>Недостаточно прав</title>';
    echo '<br>' . 'У вас недостаточно прав';
}

        ?>









