<?php
        if(isset($_POST['timkiem'])){
            $tukhoa = $_POST['tukhoa'];
        } else{
            $tukhoa = '';
        }
       $sql_pro ="SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE'%".$tukhoa."%'";
       $query_pro = mysqli_query($mysqli,$sql_pro);
      
?>
<style>
 
@media (max-width: 767px) {
    ul.product_list li {
        width: 100%;
    }

    ul.title_product, .price_product {
        text-align: center;
    }
}

</style>
<h3>Từ khóa tìm kiếm: <?php echo $_POST['tukhoa'];  ?></h3>
<p>Liệt kê danh mục sản phẩm</p>
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
    while($row = mysqli_fetch_array($query_pro)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tensanpham'] ?></td> 
    <td><img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td> 
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
    <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo  $row['id_sanpham']?>">Xóa</a> ||
    <a href="index.php?action=quanlysp&query=sua&idsanpham=<?php echo  $row['id_sanpham']?>">Sửa</a>
  </td>
  </tr>
  <?php } ?>
</table>
<?php
       $sql_pro ="SELECT * FROM tbl_baiviet,tbl_danhmucbaiviet WHERE tbl_baiviet.id_danhmuc = tbl_danhmucbaiviet.id_danhmucbaiviet AND tbl_baiviet.tenbaiviet LIKE'%".$tukhoa."%'";
       $query_pro = mysqli_query($mysqli,$sql_pro);
      
?>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên bài viết</th>
    <th>Hình ảnh</th>
    <th>Danh muc</th>
    <th>Tóm tắt</th>
    <th>Trạng thái</th>
    <th>Quản lý</th>
    
  </tr>
  <?php 
    $i=0;
    while($row = mysqli_fetch_array($query_pro)){
      $i++;  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tenbaiviet'] ?></td> 
    <td><img src="modules/quanlybaiviet/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td> 
    <td><?php echo $row['tendanhmucbaiviet'] ?></td>
    <td><?php echo $row['tomtat'] ?></td> 
    <td><?php if($row['tinhtrang']==1){
      echo 'Kích hoạt';
    } else {
      echo 'Ẩn';
    }
     ?>
     </td> 
    <td>
    <a href="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo  $row['id_baiviet']?>">Xóa</a> | 
    <a href="index.php?action=quanlybaiviet&query=sua&idbaiviet=<?php echo  $row['id_baiviet']?>">Sửa</a></td>
  </tr>
  <?php } ?>
</table>