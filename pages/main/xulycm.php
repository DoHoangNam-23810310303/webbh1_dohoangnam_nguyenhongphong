<?php
include("carbon/autoload.php");
use Carbon\Carbon;

 $now = Carbon::now('Asia/Ho_Chi_Minh');
 $now->format('Y-m-d H:i:s');
    $id_sanpham = $_GET['id'];
    $id_khachhang = $_SESSION['id_khachhang'];
    $sosao = $_POST['sosao'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh_time = time() . '_' . $hinhanh;
    $noidung = $_POST['noidung'];

    if (isset($_POST['binhluan'])) {
        $sql_them = "INSERT INTO tbl_comment(id_user, id_sanpham, hinhanh, thoigian, sosao, noidung) 
        VALUES('" . $id_khachhang . "','" . $id_sanpham . "','" . $hinhanh_time . "','" . $now . "','" . $sosao . "','" . $noidung . "')";
        mysqli_query($mysqli, $sql_them);
        move_uploaded_file($hinhanh_tmp, 'anhcm/' . $hinhanh_time);
        echo '<script>alert("Cảm ơn bạn đã đánh giá sản phẩm!"); window.location.href = "index.php?quanly=sanpham&id=' . $id_sanpham . '";</script>';
    } else {
        $id_sanpham = $_GET['id_sanpham'];
        $id_comment = $_GET['id_comment'];
        $sql = "SELECT * FROM tbl_comment WHERE id_comment = '$id_comment' LIMIT 1";
         $query = mysqli_query($mysqli,$sql);
          while($row = mysqli_fetch_array($query)){
          unlink('anhcm/'.$row['hinhanh']);
       }
        $sql_xoacm = "DELETE FROM tbl_comment WHERE id_comment ='" . $id_comment . "'";
        $kq = mysqli_query($mysqli, $sql_xoacm);
        echo '<script>alert("Bình luận của bạn đã được xóa"); window.location.href = "index.php?quanly=sanpham&id=' . $id_sanpham . '";</script>';

    }
?>
