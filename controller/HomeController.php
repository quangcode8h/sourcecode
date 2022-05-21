<?php
   $MainTitle = $db->get_list('select * from danhmuc');
   $ChildTitle = $db->get_list('select * from danhmuccon');
   $listBooks = $db->get_list('select * from sach');
   $length = count($listBooks);
   $listBooksHot = $db->get_list('select * from sach where GiamGia = 25 limit 0, 10 ');
   $listBooksUpcoming = $db->get_list('select * from sachsapphathanh');
   require './views/home.php'; 
?>