<?php
include('../../config/config.php');
include("../../../carbon/autoload.php");
use Carbon\Carbon;
$now = Carbon::now('Asia/Ho_Chi_Minh');
$now->format('Y-m-d H:i:s');
    //xulyhinhanh
   $hinhanh = $_FILES['hinhanh']['name'];
   $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
   $hinhanh_time = time().'_'.$hinhanh;
   $thongtin = $_POST['thongtin'];
   $link = $_POST['link'];
   if(isset($_POST['themslide'])){
   //them
    $sql_themslide = "INSERT INTO tbl_trangchu(hinhanh,link,thoigian) VALUE('".$hinhanh_time."','".$link."','".$now."')";
   mysqli_query($mysqli,$sql_themslide);
   move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);
   header('location:../../index.php?action=quanlywebsite&query=them');
   
   
   }elseif(isset($_POST['themshow'])){
      $sql_themshow = "INSERT INTO tbl_show(thongtin,thoigian) VALUE('".$thongtin."','".$now."')";
      mysqli_query($mysqli,$sql_themshow);
      header('location:../../index.php?action=quanlywebsite&query=them');
   }elseif(isset($_POST['suashow'])){
      $sql_suashow= "UPDATE tbl_show SET thongtin='".$thongtin."',thoigian='".$now."'
      WHERE id_show='$_GET[idshow]'";
      mysqli_query($mysqli,$sql_suashow);
      header('location:../../index.php?action=quanlywebsite&query=them');
   }elseif(isset($_GET['idshow'])){
      $sql_xoa_show = "DELETE FROM tbl_show WHERE id_show ='$_GET[idshow]'";
      mysqli_query($mysqli,$sql_xoa_show);
      header('location:../../index.php?action=quanlywebsite&query=them');
   }
   elseif (isset($_POST['suaslide'])){
      //sua
      if($hinhanh !=''){
         move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);       
         $sql_update = "UPDATE tbl_trangchu SET hinhanh='". $hinhanh_time."',link='".$link."',thoigian='". $now."'
           WHERE id='$_GET[idslide]'";
         $sql = "SELECT * FROM tbl_trangchu WHERE id = '$_GET[idslide]' LIMIT 1";
         $query = mysqli_query($mysqli,$sql);
         while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanh']);
         }
      }else{
         $sql_update = "UPDATE tbl_trangchu SET link='".$link."',thoigian='". $now."'
          WHERE id='$_GET[idslide]'";
      }
      mysqli_query($mysqli,$sql_update);
      header('location:../../index.php?action=quanlywebsite&query=them');
   }else{
      $id = $_GET['id'];
      $sql = "SELECT * FROM tbl_trangchu WHERE id = '$id' LIMIT 1";
      $query = mysqli_query($mysqli,$sql);
      while($row = mysqli_fetch_array($query)){
         unlink('uploads/'.$row['hinhanh']);
      }
      $sql_xoa = "DELETE FROM tbl_trangchu WHERE id ='".$id."'";
      mysqli_query($mysqli,$sql_xoa);
      header('location:../../index.php?action=quanlywebsite&query=them');
   }
?>