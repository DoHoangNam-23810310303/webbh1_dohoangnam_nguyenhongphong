<Style>
.navbar {
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 1000; 
}
body {
  padding-top: 56px; 
}
</Style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"></i> MENITURE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Thống kê <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlydanhmucsanpham&query=them">Danh mục sản phẩm</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlysanpham&query=them">Sản phẩm</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlydanhmucbaiviet&query=them">Danh mục bài viết</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlybaiviet&query=them">Bài viết</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlydonhang&query=lietke">Quản lý đơn hàng</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=thongtinweb&query=them">Thông tin liên hệ</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlybaidang&query=lietke">Quản lý bài đăng</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlybinhluan&query=lietke">Bình luận</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=quanlywebsite&query=them">Slider</a>
      </li>
    </ul>
  </div>
</nav>
<form class="form-inline my-2 my-lg-0 d-flex justify-content-center" action="index.php?action=timkiem&query=timkiem" method="POST">
  <input class="form-control mr-sm-2" type="search" name="tukhoa" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" name="timkiem" type="submit">Search</button>
</form>

<!-- <div class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Thống kê</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=quanlydanhmucsanpham&query=them">Danh mục khóa học</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=quanlysp&query=them">Khóa học</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=quanlydanhmucbaiviet&query=them">Danh mục bài viết</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=quanlybaiviet&query=them">Bài viết</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=danhmucsach&query=them">Danh mục sách</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=sach&query=them">Sách</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=quanlydonhang&query=lietke">Quản lý đơn hàng</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=quanlyweb&query=capnhap">Quản lý website</a></li>
    </ul>
</div> -->

