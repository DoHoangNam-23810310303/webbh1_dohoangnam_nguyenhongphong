<?php
 $sql_lh = "SELECT * FROM tbl_lienhe ORDER BY id_lienhe DESC";
 $query_lh =   mysqli_query($mysqli,$sql_lh);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Liệt kê liên hệ </h6>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên </th>
    <th>Chuyên ngành </th>
    <th>Hình ảnh</th>
    <th>Quản lý</th>
  </tr>
  <?php 
    $i=0;
    while($row = mysqli_fetch_array($query_lh)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tenlienhe'] ?></td> 
    <td><?php echo $row['chuyennganh'] ?></td> 
    <td><img src="modules/thongtinweb/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td> 
    <td>
    <a  class="btn btn-primary" href="modules/thongtinweb/xuly.php?idlienhe=<?php echo  $row['id_lienhe']?>">Xóa</a> ||
    <a  class="btn btn-secondary" href="index.php?action=thongtinweb&query=sua&idlienhe=<?php echo  $row['id_lienhe']?>">Sửa</a>
  </td>
  </tr>
  <?php } ?>
</table>
