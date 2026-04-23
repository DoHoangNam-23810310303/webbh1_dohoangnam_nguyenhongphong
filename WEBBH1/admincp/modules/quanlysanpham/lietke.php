<?php
 $sql_lietke = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC";
 $query_lietke=   mysqli_query($mysqli,$sql_lietke);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Liệt kê danh mục giày</h6>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Giá sp</th>
    <th>Số lượng</th>
    <th>Danh muc</th>
    <th>Mã sp</th>
    <th>Tóm tắt</th>
    <th>Trạng thái</th>
    <th>Quản lý</th>
    
  </tr>
  <?php 
    $i=0;
    while($row = mysqli_fetch_array($query_lietke)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tensanpham'] ?></td> 
    <td><img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td> 
    <td><?php echo $row['giasp'] ?></td> 
    <td><?php echo $row['soluong'] ?></td> 
    <td><?php echo $row['tendanhmuc'] ?></td>
    <td><?php echo $row['masp'] ?></td> 
    <td><?php echo $row['tomtat'] ?></td> 
    <td><?php if($row['tinhtrang']==1){
      echo 'Còn hàng';
    } else {
      echo 'Hết hàng';
    }
     ?>
     </td> 
    <td>
    <a  class="btn btn-primary"  href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo  $row['id_sanpham']?>">Xóa</a> ||
    <a  class="btn btn-secondary" href="index.php?action=quanlysanpham&query=sua&idsanpham=<?php echo  $row['id_sanpham']?>">Sửa</a>
  </td>
  </tr>
  <?php } ?>
</table>