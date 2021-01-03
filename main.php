<?php
session_start();

require_once 'classes/classes.php';
if(!empty($_SESSION['account_id'])){
    echo '<a href="logout">Выход|</a>';
    echo '<a href="portal"> Статьи|</a>';
    echo 'Hello: ' .
        userNickName::checkId($_SESSION);
}else{
    echo 'вы не авторизованы';
    echo  '<form action="login">';
    echo "<input type='hidden' >" . '<input type="submit" value="Войти">';
    echo '</form>';
    echo  '<form action="registration">';
    echo "<input type='hidden' >" . '<input type="submit" value="Регистрация">';
    echo '</form>';
}





?>

<html>
<head><title>OOP Калькулятор</title></head>
<body>
<form method="post">
    <p><input name="x">X</p>
    <p><input name="y">Y</p>
    <select name="action" >
        <option value="plus" >Прибавить</option>
        <option value="minus" >Отнять</option>
        <option value="divide" >Поделить</option>
        <option value="multiple" >Умножить</option>
        <input type="submit"></p>
    </select>
</form>

</body>
</html>


<?php

require_once 'classes/classes.php';

if (!empty($_POST)){
  calculator::calcResulty($_POST);

}else{
    $errorCache = errorReport::checkErrorCalc($_POST);
   echo implode('<br>',$errorCache);
}
viewResults::viewCalculationsResults();
viewResults::viewCalculationsGroup();
