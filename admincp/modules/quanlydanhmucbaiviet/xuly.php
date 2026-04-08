<?php
   include('../../config/config.php');


   $tendanhmucbaiviet = $_POST['tendanhmucbaiviet'];
   $thutu = $_POST['thutu'];

   if(isset($_POST['themdanhmucbaiviet'])){
    $sql_them = "INSERT INTO tbl_danhmucbaiviet(tendanhmucbaiviet,thutu) VALUES('".$tendanhmucbaiviet."','".$thutu."')";
    mysqli_query($mysqli,$sql_them);
    header('location:../../index.php?action=quanlydanhmucbaiviet&query=them');
   
   
   } elseif (isset($_POST['suadanhmucbaiviet'])){
      $id = $_GET['iddanhmucbaiviet'];
      $sql_update = "UPDATE tbl_danhmucbaiviet SET tendanhmucbaiviet='". $tendanhmucbaiviet."',thutu='".$thutu."' WHERE id_danhmucbaiviet='$_GET[iddanhmucbaiviet]'";
      mysqli_query($mysqli,$sql_update);
      header('location:../../index.php?action=quanlydanhmucbaiviet&query=them');
   
   
   }else{
      $id = $_GET['iddanhmucbaiviet'];
      $sql_xoa = "DELETE FROM tbl_danhmucbaiviet WHERE id_danhmucbaiviet ='".$id."'";
      mysqli_query($mysqli,$sql_xoa);
      header('location:../../index.php?action=quanlydanhmucbaiviet&query=them');
   }
?>