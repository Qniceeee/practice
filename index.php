<?php
require_once 'classes/classes.php';

$route = $_GET['route'];


switch ($route) {

    case 'index':
        require 'main.php';
        break;
    case 'login':
        require 'login.php';
        break;
    case 'delete':
        require 'delete.php';
        break;
    case 'logout':
        require 'logout.php';
        break;
    case 'registration':
        require 'registration.php';
        break;
    case 'portal/admin':
        require 'portalAdmin.php';
        break;
    case 'portal/createArticle':
        require 'createArticle.php';
        break;
    case 'portal':
        require 'portal.php';
        break;
}

?>