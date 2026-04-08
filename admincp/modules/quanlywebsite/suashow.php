<?php
 $sql_sua_show = "SELECT * FROM tbl_show WHERE id_show = '$_GET[idshow]' LIMIT 1";
 $query_sua_show =   mysqli_query($mysqli,$sql_sua_show);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa thông tin show</h6>
<table border="1px" width="100%" style="border-collapse: collapse;">
<?php
while($row = mysqli_fetch_array($query_sua_show)){
?>
  <form method="POST"  action="modules/quanlywebsite/xuly.php?idshow=<?php echo  $row['id_show'] ?>" enctype="multipart/form-data">
 
  <tr>
    <td>Thông tin show</td>
    <td><input type="text" name="thongtin" value="<?php echo $row['thongtin'] ?>">
  </td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="suashow" value="Sửa show"></td>
  </tr>
  </form>
  <?php
}
?>
</table>