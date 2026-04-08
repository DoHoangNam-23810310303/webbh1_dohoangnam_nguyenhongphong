<?php
 $sql_sua_lh = "SELECT * FROM tbl_trangchu WHERE id = '$_GET[id]' LIMIT 1";
 $query_sua_lh =   mysqli_query($mysqli,$sql_sua_lh);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa thông tin liên hệ</h6>
<table border="1px" width="100%" style="border-collapse: collapse;">
<?php
while($row = mysqli_fetch_array($query_sua_lh)){
?>
  <form method="POST"  action="modules/quanlywebsite/xuly.php?idslide=<?php echo  $row['id'] ?>" enctype="multipart/form-data">
 
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh">
    <img src="modules/quanlywebsite/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
  </td>
  </tr>
  <tr>
    <td>Link</td>
    <td><input type="text" name="link" value="<?php echo $row['link']?>"></td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="suaslide" value="Sửa liên hệ"></td>
  </tr>
  </form>
  <?php
}
?>
</table>