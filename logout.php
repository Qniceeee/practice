<?php
session_start();
if (empty($_SESSION)){
    echo 'вы не авторизованы';

}else{
    session_destroy();
    header('Location: index');
}




