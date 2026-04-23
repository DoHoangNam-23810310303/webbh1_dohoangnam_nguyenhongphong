<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Thêm  sản phẩm</h6>
<table border="1px" width="100%" style="border-collapse: collapse;">
  <form method="POST" action="modules/quanlysanpham/xuly.php" enctype="multipart/form-data">
  <tr>
    <td>Tên sản phẩm</td>
    <td><input type="text" name="tensanpham" required></td>
  </tr>
  <tr>
    <td>Mã sp</td>
    <td><input type="text" name="masp" required></td>
  </tr>
  <tr>
    <td>Giá sp</td>
    <td><input type="text" name="giasp" required></td>
  </tr>
  <tr>
    <td>Số lượng</td>
    <td><input type="text" name="soluong" required></td>
  </tr>
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh" required></td>
  </tr>
  <tr>
    <td>tóm tắt</td>
    <td>
      <textarea id="sanphamtt"  rows="10" style="resize: none;" name="tomtat" ></textarea>
    </td>
  </tr>
  <tr>
    <td>Nội dung</td>
    <td>
      <textarea id="sanphamnd" rows="10" style="resize: none;" name="noidung" ></textarea>
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
        ?>
        <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
        <?php
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Tình trạng</td>
    <td>
      <select name="tinhtrang">
        <option value="1">Còn hàng</option>
        <option value="0">Hết hàng</option>
      </select>
    </td>
  </tr>
  <tr>
    <td  colspan="2"><input type="submit"name="themsanpham" value="Thêm sản phẩm"></td>
  </tr>
  </form>
</table>