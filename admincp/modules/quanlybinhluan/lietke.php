<?php
$sql_lietke_cm = "SELECT tbl_comment.id_comment, tbl_sanpham.tensanpham, tbl_dangky.tenkhachhang, tbl_comment.hinhanh, tbl_comment.sosao, tbl_comment.noidung
FROM tbl_comment
JOIN tbl_dangky ON tbl_comment.id_user = tbl_dangky.id_dangky
JOIN tbl_sanpham ON tbl_comment.id_sanpham = tbl_sanpham.id_sanpham
ORDER BY tbl_comment.id_comment DESC";

$query_lietke_cm = mysqli_query($mysqli, $sql_lietke_cm);
?>


<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Liệt kê bình luận trong khóa học</h6>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên sản phẩm</th>
    <th>Name</th>
    <th>Hình ảnh</th>
    <th>Số sao</th>
    <th>Nội dung bình luận</th>
    <th>Quản lý</th>
    
  </tr>
  <?php 
    $i=0;
    while($row = mysqli_fetch_array($query_lietke_cm)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tensanpham'] ?></td> 
    <td><?php echo $row['tenkhachhang'] ?></td> 
    <td><img src="../anhcm/<?php echo $row['hinhanh'] ?>" width="150px"></td> 
    <td><?php echo $row['sosao'] ?></td> 
    <td><?php echo $row['noidung'] ?></td> 
    <td>
    <a  class="btn btn-primary"  href="modules/quanlybinhluan/xuly.php?idbl=<?php echo  $row['id_comment']?>">Xóa</a>
  </td>
  </tr>
  <?php } ?>
</table>
<?php
$sql_lietke_cm_bd = "SELECT * FROM comments,tbl_dangbai,tbl_dangky WHERE comments.user_id = tbl_dangky.id_dangky AND comments.post_id =  tbl_dangbai.id_baidang
ORDER BY comments.id DESC";

$query_lietke_cm_bd = mysqli_query($mysqli, $sql_lietke_cm_bd);
?>
<div class="quanly">
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Liệt kê bình luận trong cộng đồng</h6>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên bài đăng</th>
    <th>Name</th>
    <th>Nội dung bình luận</th>
    <th>Quản lý</th>
    
  </tr>
  <?php 
    $i=0;
    while($row_bd = mysqli_fetch_array($query_lietke_cm_bd)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row_bd['tenbaidang'] ?></td> 
    <td><?php echo $row_bd['tenkhachhang'] ?></td> 
    <td><?php echo $row_bd['msg'] ?></td>

    <td>
    <a  class="btn btn-success" href="index.php?action=quanlybinhluan&query=xembinhluan&idbl=<?php echo  $row_bd['id']?>">Xem bình luận reply</a>
    <a  class="btn btn-primary"  href="modules/quanlybinhluan/xuly.php?idblbd=<?php echo  $row_bd['id']?>">Xóa</a>
  </td>
  </tr>
  <?php } ?>
</table>
</div>
<style>
    div.quanly{
        padding: 100px 0px;
    }
</style>