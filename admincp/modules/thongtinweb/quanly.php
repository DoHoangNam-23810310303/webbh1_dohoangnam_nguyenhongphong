<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Quản lý thông tin web</h6>
<?php

 $sql_lh = "SELECT * FROM tbl_lh WHERE id_lh=1";
 $query_lh =   mysqli_query($mysqli,$sql_lh);
?>
<table border="1px" width="100%" style="border-collapse: collapse;">
<?php
        while ($dong = mysqli_fetch_array($query_lh)){
?>
  <form method="POST" action="modules/thongtinweb/xuly.php?id=<?php echo $dong['id_lh'] ?>" enctype="multipart/form-data">
  <tr>
    <td>Đường</td>
    <td>
     <input type="text" name="duong" value="<?php echo $dong['duong'] ?>" required>
    </td>
  </tr>
  <tr>
    <td>Số điện thoại</td>
    <td>
     <input type="text" name="sdt" value="<?php echo $dong['sdt'] ?>" required>
    </td>
  </tr>
  <tr>
    <td>Mail</td>
    <td>
     <input type="text" name="mail" value="<?php echo $dong['mail'] ?>" required>
    </td>
  </tr>
  
  <tr>
    <td  colspan="2"><input type="submit" name="lienhe" value="Cập nhật"></td>
  </tr>
  <?php
        }
  ?>
  </form>
</table>