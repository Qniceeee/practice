<?php


date_default_timezone_set('Europe/Kiev');
$time_date1 = date("Y-m-d");

$driver = 'mysql';
$servername = '127.0.0.1:7070';
$db_name = 'calculator';
$username = 'root';
$password = 'Ujyxther1993@';
$db_name_log = 'auth_users';
$sql_auth = "$driver:host=$servername; dbname=$db_name";
$reg_auth = "$driver:host=$servername; dbname=$db_name_log";

$pdo = new PDO($sql_auth = "$driver:host=$servername; dbname=$db_name", $username, $password);

$pdo_calc = new PDO($sql_auth, $username, $password);
$pdo_auth = new PDO($reg_auth, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$login = null;
$password_auth = null;
$sql_auth_user = "SELECT * FROM users WHERE login='$login' AND password='$password_auth'";


