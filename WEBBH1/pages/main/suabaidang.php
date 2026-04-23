<?php
 $sql_sua_bd = "SELECT * FROM tbl_dangbai WHERE id_baidang = '$_GET[id]' LIMIT 1";
 $query_sua_bd =   mysqli_query($mysqli,$sql_sua_bd);
?>
<div class="container">
  <h3 class="text-center">Đăng bài viết</h3>
  <?php
   while($row = mysqli_fetch_array($query_sua_bd)){
   ?>
  <form method="POST" action="index.php?quanly=xulybaidang&id=<?php echo  $row['id_baidang'] ?>" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="tenbaidang">Tên bài đăng</label>
          <input type="text" class="form-control" id="tenbaidang" name="tenbaidang" value="<?php echo $row['tenbaidang']  ?>" required>
        </div>
        <div class="form-group">
          <label for="hinhanh">Hình ảnh</label>
          <input type="file" name="hinhanh">
          <img src="uploads/<?php echo $row['hinhanh'] ?>" width="150px">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="tomtat">Tóm tắt</label>
          <textarea class="form-control" id="tomtat" rows="5" style="resize: none;" name="tomtat" ><?php echo $row['tomtat']  ?></textarea>
        </div>
        <div class="form-group">
          <label for="noidung">Nội dung</label>
          <textarea class="form-control" id="noidung" rows="5" style="resize: none;" name="noidung" ><?php echo $row['noidung']  ?></textarea>
        </div>
      </div>
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" name="suabaidang" value="Sửa bài">
    </div>
  </form>
  <?php
}
?>
</div>
