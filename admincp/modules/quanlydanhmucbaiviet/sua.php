<?php
 $sql_sua_danhmucbv = "SELECT * FROM tbl_danhmucbaiviet WHERE id_danhmucbaiviet = '$_GET[iddanhmucbaiviet]' LIMIT 1";
 $query_sua_danhmucbv =   mysqli_query($mysqli,$sql_sua_danhmucbv);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa danh mục bài viết</h6>
<table border="1px" width="50%" style="border-collapse: collapse;">
  <form method="POST" action="modules/quanlydanhmucbaiviet/xuly.php?iddanhmucbaiviet=<?php echo $_GET['iddanhmucbaiviet'] ?>">
   <?php
        while ($dong = mysqli_fetch_array($query_sua_danhmucbv)){
   ?>
  <tr>
    <td>Tên danh mục bài viết</td>
    <td><input type="text" name="tendanhmucbaiviet" value="<?php echo $dong['tendanhmucbaiviet']; ?>"></td>
  </tr>
  <tr>
    <td>Thứ tự</td>
    <td><input type="text" name="thutu" value="<?php echo $dong['thutu']; ?>"></td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit" name="suadanhmucbaiviet" value="Sửa danh mục bài viết"></td>
  </tr>
  <?php
        }
    ?>
  </form>
</table>