<?php
 $sql_sua_danhmuc= "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$_GET[iddanhmuc]' LIMIT 1";
 $query_sua_danhmuc =   mysqli_query($mysqli,$sql_sua_danhmuc);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa danh mục giày</h6>
<table border="1px" width="50%" style="border-collapse: collapse;">
  <form method="POST" action="modules/quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo  $_GET['iddanhmuc'] ?>">
   <?php
        while ($dong = mysqli_fetch_array($query_sua_danhmuc)){
   ?>
  <tr>
    <td>Tên danh mục</td>
    <td><input type="text" name="tendanhmuc" value="<?php echo $dong['tendanhmuc']; ?>"></td>
  </tr>
  <tr>
    <td>Thứ tự</td>
    <td><input type="text" name="thutu" value="<?php echo $dong['thutu']; ?>"></td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="suadanhmuc" value="Sửa danh mục sản phẩm"></td>
  </tr>
  <?php
        }
    ?>
  </form>
</table>