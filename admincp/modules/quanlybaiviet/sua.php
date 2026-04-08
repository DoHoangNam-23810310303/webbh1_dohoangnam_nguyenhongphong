<?php
 $sql_sua_bv = "SELECT * FROM tbl_baiviet WHERE id_baiviet = '$_GET[idbaiviet]' LIMIT 1";
 $query_sua_bv =   mysqli_query($mysqli,$sql_sua_bv);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Sửa bài viết</h6>
<table border="1px" width="100%" style="border-collapse: collapse;">
<?php
while($row = mysqli_fetch_array($query_sua_bv)){
?>
  <form method="POST"  action="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo  $row['id_baiviet'] ?>" enctype="multipart/form-data">
  <tr>
    <td>Tên bài viết</td>
    <td><input type="text" name="tenbaiviet" value="<?php echo $row['tenbaiviet'] ?>"></td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh">
    <img src="modules/quanlybaiviet/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
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
    <td>Danh mục bài viết</td>
    <td>
      <select name="danhmuc">
        <?php
          $sql_danhmuc ="SELECT * FROM tbl_danhmucbaiviet ORDER BY id_danhmucbaiviet DESC";
          $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
          while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
            if($row_danhmuc['id_danhmucbaiviet']==$row['id_danhmuc']){
        ?>
        <option selected value="<?php echo $row_danhmuc['id_danhmucbaiviet'] ?>"><?php echo $row_danhmuc['tendanhmucbaiviet'] ?></option>
        <?php
            } else {
              ?>
               <option  value="<?php echo $row_danhmuc['id_danhmucbaiviet'] ?>"><?php echo $row_danhmuc['tendanhmucbaiviet'] ?></option>
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
        <option value="1" selected>Kích hoạt</option>
        <option value="0">Ẩn</option>
        <?php
          }else{
        ?>
        <option value="1">Kích hoạt</option>
        <option value="0" selected>Ẩn</option>
        <?php
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="suabaiviet" value="Sửa bài viết"></td>
  </tr>
  </form>
  <?php
}
?>
</table>