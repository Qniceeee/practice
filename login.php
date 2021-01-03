<?php
session_start();
?>


<title>Авторизация</title>
<form method="post">
    <p><label>
            <input name="login" placeholder="login">
        </label></p>
    <p><label>
            <input name="password" placeholder="password">
        </label></p>
    <input type="submit"></p>
</form>
<?php

require_once 'classes/classes.php';

if (empty($_SESSION['account_id'])){
    loginUser::RegResulty($_POST);
    if (!empty($_SESSION['account_id'])){
        header('Location: index');
    }
 echo 'Введите данные для авторизации';
}else{

 echo 'вы авторизованы';
    header('Location: index');
}


//var_dump($rowLogin);
