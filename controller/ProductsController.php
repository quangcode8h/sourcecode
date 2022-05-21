<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $category = $db->get_row("select * from danhmuccon where MaDMCon = $id");
    $listBooksByCategory = $db->get_list("select * from sach where MaDMCon = {$category['MaDMCon']}");
    require './views/products.php';
?>