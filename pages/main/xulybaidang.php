<?php
   require("carbon/autoload.php");
   use Carbon\Carbon;
   use Carbon\CarbonInterval;
   $now = Carbon::now('Asia/Ho_Chi_Minh');
   $now->format('Y-m-d H:i:s');
   $tenbaidang = $_POST['tenbaidang'];
    //xulyhinhanh
   $hinhanh = $_FILES['hinhanh']['name'];
   $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
   $hinhanh_time = time().'_'.$hinhanh;
   $tomtat = $_POST['tomtat'];
   $noidung = $_POST['noidung'];
   $tinhtrang = '1';
   $id_khachhang = $_SESSION['id_khachhang'];
   

  

   if(isset($_POST['thembaidang'])){
   //them
   $sql_them = "INSERT INTO tbl_dangbai(id_user,tenbaidang,hinhanh,tomtat,noidung,tinhtrang,thoigian) 
   VALUES('".$id_khachhang."','".$tenbaidang."','".$hinhanh_time."','".$tomtat."','".$noidung."','".$tinhtrang."','".$now."')";
   mysqli_query($mysqli,$sql_them);
   move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);
   echo '<script type="text/javascript">alert("Cảm ơn bạn đã đăng bài. QTV sẽ sớm xem xét!");    window.location.href = "index.php?quanly=quanlybaidang"; </script>';
   }elseif (isset($_POST['suabaidang'])){
            //sua
            if($hinhanh !=''){
               move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh_time);       
               $sql_update = "UPDATE tbl_dangbai SET id_user='".$id_khachhang."', tenbaidang='". $tenbaidang."', hinhanh='". $hinhanh_time."', 
               tomtat='". $tomtat."', noidung='". $noidung."', tinhtrang='". $tinhtrang
               ."', thoigian = '".$now."' WHERE id_baidang='$_GET[id]'";
               $sql = "SELECT * FROM tbl_dangbai WHERE id_baidang= '$_GET[id]' LIMIT 1";
               $query = mysqli_query($mysqli,$sql);
               while($row = mysqli_fetch_array($query)){
                  unlink('uploads/'.$row['hinhanh']);
               }
            }else{
               $sql_update = "UPDATE tbl_dangbai SET tenbaidang='". $tenbaidang."'
               , tomtat='". $tomtat."', noidung='". $noidung."', tinhtrang='". $tinhtrang
               ."',thoigian='". $now."' WHERE id_baidang='$_GET[id]'";
            }
            mysqli_query($mysqli,$sql_update);
            echo '<script type="text/javascript">alert("Cảm ơn bạn đã đăng bài. QTV sẽ sớm xem xét!");    window.location.href = "index.php?quanly=quanlybaidang"; </script>';
         
         }
   else{
      $id = $_GET['xoa'];
      $sql = "SELECT * FROM tbl_dangbai WHERE id_baidang = '$id' LIMIT 1";
      $query = mysqli_query($mysqli,$sql);
      while($row = mysqli_fetch_array($query)){
         unlink('uploads/'.$row['hinhanh']);
      }
      $sql_xoa = "DELETE FROM tbl_dangbai WHERE id_baidang='".$id."'";
      mysqli_query($mysqli,$sql_xoa);
      echo '<script type="text/javascript">alert("Bài viết của bạn đã được xóa");    window.location.href = "index.php?quanly=quanlybaidang"; </script>';
   }
   ?>