<?php
session_start();
?>

    <title>Регистрация</title>
<form method="post">
    <p><label>
            <input name="login" placeholder="login">
        </label></p>
    <p><label>
            <input name="password" placeholder="password">
        </label></p>
    <p><label>
            <input name="email" placeholder="EMAIL">
        </label></p>
    <input type="submit">
</form>
<form action="login">
<input type='hidden' ><input type="submit" value="Войти">
</form>

<?php

require_once 'classes/classes.php';


if (!empty($_POST))
{
   bigUser::ResultReg($_POST);
   if (!empty($_SESSION['account_id'])){
    echo  '<br>' . 'Вы уже зарегестрированы' ;
}


  }
else
    {
    errorsReg::checkErrorReg($_POST);



    }




