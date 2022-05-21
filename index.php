<?php
    require './model/DatabaseModel.php';
    $db = new database('localhost', 'root', '', 'webbooksmvcdb');
    $db->connect();
    if(isset($_GET['controller'])){
        $controller = $_GET['controller'];
    }
    else{
        $controller = '';
    }

    if(empty($controller) || $controller == 'home'){
        require './controller/HomeController.php';
    }
    else {
        require "./controller/$controller.php";
    }
?>