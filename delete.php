<?php
require_once 'classes/classes.php';
deleteResultsController::deletePostTable();
var_dump($_POST);
header('Location: index');