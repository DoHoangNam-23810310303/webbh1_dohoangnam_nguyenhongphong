<?php
include('../../config/config.php');


   $tenlienhe= $_POST['tenlienhe'];
   $facebook = $_POST['facebook'];
   $youtube = $_POST['youtube'];
   $instagram = $_POST['instagram'];
   $github = $_POST['github'];
   $chuyennganh = $_POST['chuyennganh'];
    //xulyhinhanh
   $hinhanh = $_FILES['hinhanh']['name'];
   $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
   $hinhanh_time = time().'_'.$hinhanh;
   $duong = $_POST['duong'];
   $sdt = $_POST['sdt'];
   $mail = $_POST['mail'];
   $id = $_GET['id'];
   if(isset($_POST['themlienhe'])){
   //them
    $sql_them = "INSERT INTO tbl_lienhe(tenlienhe,chuyennganh,facebook,youtube,instagram,github,hinhanh) VALUE('".$tenlienhe."
      ','".$chuyennganh."','".$facebook."','".$youtube."','".$instagram."','".$github."','".$hinhanh_time."')";
   mysqli_query($mysqli,$sql_them);
   move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);
   header('location:../../index.php?action=thongtinweb&query=them');
   
   
   }elseif(isset($_POST['lienhe'])){
      $sql_update = "UPDATE tbl_lh SET duong='". $duong."',sdt='". $sdt."',mail='". $mail."' WHERE id_lh='".$id."'";
      mysqli_query($mysqli,$sql_update);
      header('location:../../index.php?action=thongtinweb&query=them');
   }
   elseif (isset($_POST['sualienhe'])){
      //sua
      if($hinhanh !=''){
         move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);       
         $sql_update = "UPDATE tbl_lienhe SET tenlienhe='". $tenlienhe."',chuyennganh='".$chuyennganh."', facebook='". $facebook."',
          youtube='". $youtube."',instagram='". $instagram."',github='". $github."', hinhanh='". $hinhanh_time."'
           WHERE id_lienhe='$_GET[idlienhe]'";
         $sql = "SELECT * FROM tbl_lienhe WHERE id_lienhe = '$_GET[idlienhe]' LIMIT 1";
         $query = mysqli_query($mysqli,$sql);
         while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanh']);
         }
      }else{
         $sql_update = "UPDATE tbl_lienhe SET tenlienhe='". $tenlienhe."',chuyennganh='".$chuyennganh."', facebook='". $facebook."',
         youtube='". $youtube."',instagram='". $instagram."',github='". $github."'
          WHERE id_lienhe='$_GET[idlienhe]'";
      }
      mysqli_query($mysqli,$sql_update);
      header('location:../../index.php?action=thongtinweb&query=them');
   }else{
      $id = $_GET['idlienhe'];
      $sql = "SELECT * FROM tbl_lienhe WHERE id_lienhe = '$id' LIMIT 1";
      $query = mysqli_query($mysqli,$sql);
      while($row = mysqli_fetch_array($query)){
         unlink('uploads/'.$row['hinhanh']);
      }
      $sql_xoa = "DELETE FROM tbl_lienhe WHERE id_lienhe ='".$id."'";
      mysqli_query($mysqli,$sql_xoa);
      header('location:../../index.php?action=thongtinweb&query=them');
   }
?>