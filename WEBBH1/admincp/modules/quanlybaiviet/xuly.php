<?php
include('../../config/config.php');


   $tenbaiviet = $_POST['tenbaiviet'];
    //xulyhinhanh
   $hinhanh = $_FILES['hinhanh']['name'];
   $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
   $hinhanh_time = time().'_'.$hinhanh;
   $tomtat = $_POST['tomtat'];
   $noidung = $_POST['noidung'];
   $tinhtrang = $_POST['tinhtrang'];
   $danhmuc = $_POST['danhmuc'];
   

  

   if(isset($_POST['thembaiviet'])){
   //them
    $sql_them = "INSERT INTO tbl_baiviet(tenbaiviet,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE('".$tenbaiviet."
      ','".$hinhanh_time."','".$tomtat."','".$noidung."','".$tinhtrang."','".$danhmuc."')";
   mysqli_query($mysqli,$sql_them);
   move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);
   header('location:../../index.php?action=quanlybaiviet&query=them');
   
   
   }
   elseif (isset($_POST['suabaiviet'])){
      //sua
      if($hinhanh !=''){
         move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);       
         $sql_update = "UPDATE tbl_baiviet SET tenbaiviet='". $tenbaiviet."', hinhanh='". $hinhanh_time."', tomtat='". $tomtat."', noidung='". $noidung."', tinhtrang='". $tinhtrang
         ."',id_danhmuc='". $danhmuc."' WHERE id_baiviet='$_GET[idbaiviet]'";
         $sql = "SELECT * FROM tbl_baiviet WHERE id_baiviet = '$_GET[idbaiviet]' LIMIT 1";
         $query = mysqli_query($mysqli,$sql);
         while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanh']);
         }
      }else{
         $sql_update = "UPDATE tbl_baiviet SET tenbaiviet='". $tenbaiviet."'
         , tomtat='". $tomtat."', noidung='". $noidung."', tinhtrang='". $tinhtrang
         ."',id_danhmuc='". $danhmuc."' WHERE id_baiviet='$_GET[idbaiviet]'";
      }
      mysqli_query($mysqli,$sql_update);
      header('location:../../index.php?action=quanlybaiviet&query=them');
   
   
   }else{
      $id = $_GET['idbaiviet'];
      $sql = "SELECT * FROM tbl_baiviet WHERE id_baiviet = '$id' LIMIT 1";
      $query = mysqli_query($mysqli,$sql);
      while($row = mysqli_fetch_array($query)){
         unlink('uploads/'.$row['hinhanh']);
      }
      $sql_xoa = "DELETE FROM tbl_baiviet WHERE id_baiviet='".$id."'";
      mysqli_query($mysqli,$sql_xoa);
      header('location:../../index.php?action=quanlybaiviet&query=them');
   }
?>