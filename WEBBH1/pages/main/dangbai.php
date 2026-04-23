<?php
if (!isset($_SESSION['id_khachhang'])) {
    echo '<script type="text/javascript">
            alert("Bạn cần đăng nhập mới có thể đăng bài");
            window.location.href = "index.php?quanly=dangnhap";
          </script>';
}
?>

<div class="container">
  <h3 class="text-center">Đăng bài viết</h3>
  <form method="POST" action="index.php?quanly=xulybaidang" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="tenbaidang">Tên bài đăng</label>
          <input type="text" class="form-control" id="tenbaidang" name="tenbaidang" required>
        </div>
        <div class="form-group">
          <label for="hinhanh">Hình ảnh</label>
          <input type="file" class="form-control-file" id="hinhanh" name="hinhanh" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="tomtat">Tóm tắt</label>
          <textarea class="form-control" id="tomtat" rows="5" style="resize: none;" name="tomtat"></textarea>
        </div>
        <div class="form-group">
          <label for="noidung">Nội dung</label>
          <textarea class="form-control" id="noidung" rows="5" style="resize: none;" name="noidung"></textarea>
        </div>
      </div>
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" name="thembaidang" value="Đăng bài">
    </div>
  </form>
</div>
