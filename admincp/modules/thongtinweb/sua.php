<?php
 $sql_sua_lh = "SELECT * FROM tbl_lienhe WHERE id_lienhe = '$_GET[idlienhe]' LIMIT 1";
 $query_sua_lh =   mysqli_query($mysqli,$sql_sua_lh);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa thông tin liên hệ</h6>
<table border="1px" width="100%" style="border-collapse: collapse;">
<?php
while($row = mysqli_fetch_array($query_sua_lh)){
?>
  <form method="POST"  action="modules/thongtinweb/xuly.php?idlienhe=<?php echo  $row['id_lienhe'] ?>" enctype="multipart/form-data">
  <tr>
    <td>Tên liên hệ</td>
    <td><input type="text" name="tenlienhe" value="<?php echo $row['tenlienhe'] ?>"></td>
  </tr>
  <tr>
    <td>Chuyên ngành</td>
    <td><input type="text" name="chuyennganh" value="<?php echo $row['chuyennganh'] ?>"></td>
  </tr>
  <tr>
    <td>Facebook</td>
    <td><input type="text" name="facebook" value="<?php echo $row['facebook'] ?>"></td>
  </tr>
  <tr>
    <td>Youtube</td>
    <td><input type="text" name="youtube" value="<?php echo $row['youtube'] ?>"></td>
  </tr>
  <tr>
    <td>Instagram</td>
    <td><input type="text" name="instagram" value="<?php echo $row['instagram'] ?>"></td>
  </tr>
  <tr>
    <td>Github</td>
    <td><input type="text" name="github" value="<?php echo $row['github'] ?>"></td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh">
    <img src="modules/thongtinweb/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
  </td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="sualienhe" value="Sửa liên hệ"></td>
  </tr>
  </form>
  <?php
}
?>
</table>