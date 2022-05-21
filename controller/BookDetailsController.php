<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $BookDetails = $db->get_row("select * from sach where MaSach = $id");
    $NameOfAuthor = $db->get_row("select * from tacgia where MaTG = {$BookDetails['MaTG']}");
    $ChildCategory = $db->get_row("select * from danhmuccon where MaDMCon = {$BookDetails['MaDMCon']}");
    $MainCategory = $db->get_row("select * from danhmuc where MaDM = {$ChildCategory['MaDM']}");
    require './views/BookDetails.php';
?>