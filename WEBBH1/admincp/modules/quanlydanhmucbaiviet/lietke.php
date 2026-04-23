<?php
 $sql_lietke_danhmucbv = "SELECT * FROM tbl_danhmucbaiviet ORDER BY thutu DESC";
 $query_lietke_danhmucbv =   mysqli_query($mysqli,$sql_lietke_danhmucbv);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Liệt kê danh mục bài viết</h6>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên danh mục bài viết</th>
    <th>Quản lý</th>
    
  </tr>
  <?php 
    $i=0;
    while($row = mysqli_fetch_array($query_lietke_danhmucbv)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tendanhmucbaiviet'] ?></td> 
    <td><a  class="btn btn-primary"  href="modules/quanlydanhmucbaiviet/xuly.php?iddanhmucbaiviet=<?php echo  $row['id_danhmucbaiviet']?>">Xóa</a> | 
    <a  class="btn btn-secondary" href="index.php?action=quanlydanhmucbaiviet&query=sua&iddanhmucbaiviet=<?php echo  $row['id_danhmucbaiviet']?>">Sửa</a></td>
  </tr>
  <?php } ?>
</table>