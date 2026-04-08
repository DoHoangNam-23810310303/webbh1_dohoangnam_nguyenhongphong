<?php
 $sql_sua = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
 $query_sua =   mysqli_query($mysqli,$sql_sua);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa sản phẩm</h6>
<table border="1px" width="100%" style="border-collapse: collapse;">
<?php
while($row = mysqli_fetch_array($query_sua)){
?>
  <form method="POST"  action="modules/quanlysanpham/xuly.php?idsanpham=<?php echo  $row['id_sanpham'] ?>" enctype="multipart/form-data">
  <tr>
    <td>Tên sản phẩm</td>
    <td><input type="text" name="tensanpham" value="<?php echo $row['tensanpham'] ?>"></td>
  </tr>
  <tr>
    <td>Mã sp</td>
    <td><input type="text" name="masp" value="<?php echo $row['masp'] ?>"></td>
  </tr>
  <tr>
    <td>Giá sp</td>
    <td><input type="text" name="giasp" value="<?php echo $row['giasp'] ?>"></td>
  </tr>
  <tr>
    <td>Số lượng</td>
    <td><input type="text" name="soluong" value="<?php echo $row['soluong'] ?>"></td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh">
    <img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
  </td>
  </tr>
  <tr>
    <td>tóm tắt</td>
    <td>
      <textarea id="tomtat" rows="10" style="resize: none;" name="tomtat"> <?php echo $row['tomtat'] ?></textarea>
    </td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td>
      <textarea id="noidung" rows="10" style="resize: none;" name="noidung"><?php echo $row['noidung'] ?></textarea>
    </td>
  </tr>
  <tr>
    <td>Danh mục sản phẩm</td>
    <td>
      <select name="danhmuc">
        <?php
          $sql_danhmuc ="SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
          $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
          while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
            if($row_danhmuc['id_danhmuc']==$row['id_danhmuc']){
        ?>
        <option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
        <?php
            } else {
              ?>
               <option  value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
              <?php
            }
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Tình trạng</td>
    <td>
      <select name="tinhtrang">
        <?php
          if($row['tinhtrang']==1){
        ?>
        <option value="1" selected>Còn hàng</option>
        <option value="0">Hết hàng</option>
        <?php
          }else{
        ?>
        <option value="1">Còn hàng</option>
        <option value="0" selected>Hết hàng</option>
        <?php
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="suasanpham" value="Sửa sản phẩm"></td>
  </tr>
  </form>
  <?php
}
?>
</table>