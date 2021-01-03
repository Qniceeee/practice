<?php

if(!empty($_POST['newCategory'])){
    $newCategory = $_POST['newCategory'];
    articles::postArticles($newCategory);
    header('Location: admin');

}else{
    header('Location: admin');
}