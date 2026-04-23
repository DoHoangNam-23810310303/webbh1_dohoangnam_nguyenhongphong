<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Chi tiết sản phẩm</h3>
<?php
       $sql_chitiet ="SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham= '$_GET[id]' 
      LIMIT 1";
       $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
        while($row_chitiet = mysqli_fetch_array($query_chitiet)){
      
?>
<div class="wrapper_chitiet">
    <div class="hinhanh_sanpham">
                <img width="100%" class="img img responsive" height="270px"  src="admincp/modules/quanlysanpham/uploads/<?php  echo $row_chitiet['hinhanh'] ?>" alt="">
    </div>
 <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
                <h3 style="margin: 0;">Tên sản phẩm: <?php echo $row_chitiet['tensanpham']?></h3>
                <p>Mã sản phẩm: <?php echo $row_chitiet['masp']?></p>
                <p>Giá sản phẩm: <?php echo number_format($row_chitiet['giasp'],0,',','.').'vnđ'?></p>
                <p>Số lượng sp: <?php echo $row_chitiet['soluong']?></p>
                <p>Danh mục sản phẩm: <?php echo $row_chitiet['tendanhmuc']?></p>
                <p style="text-align: center;"><input class="themgiohang" name="themgiohang" type="submit" value="Thêm giỏ hàng">
              </p>
    </div>
    </form>
    <div style="text-align: center;">
    <?php
    if(isset($_SESSION['id_khachhang'])){
    ?>
    <button class="btn btn-primary open-form " onclick="displayForm()">Đánh giá sản phẩm</button>
    <?php
    }else{
        echo' <p><a href="index.php?quanly=dangnhap">Bạn cần đăng nhập để có thể đánh giá sản phẩm</a></p>';
    }
    ?>
</div>

<!-- Form ẩn ban đầu -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Nội dung của form sẽ ở đây -->
        <h2>Bình luận khách hàng</h2>
        <section>
            <div class="rt-container">
                <div class="col-rt-12">
                    <div class="Scriptcontent">
                        <div class="feedback">
                            <form method="POST" action="index.php?quanly=xulycm&id=<?php echo $row_chitiet['id_sanpham'] ?>" enctype="multipart/form-data" id="commentForm">
                                <label>Đánh giá sao</label><br>
                                <span class="star-rating">
                                    <input type="radio" name="sosao" value="1"><i></i>
                                    <input type="radio" name="sosao" value="2"><i></i>
                                    <input type="radio" name="sosao" value="3"><i></i>
                                    <input type="radio" name="sosao" value="4"><i></i>
                                    <input type="radio" name="sosao" value="5"><i></i>
                                </span>
                                <div class="clear"></div>
                                <hr class="survey-hr">
                                <label>Hình ảnh đi kèm</label>
                                <span>
                                    <input type="file" name="hinhanh" required>
                                </span>
                                <div class="clear"></div>
                                <hr class="survey-hr">
                                <label for="m_3189847521540640526commentText">Nhận xét của khách hàng về sản phẩm</label><br /><br />
                                <textarea cols="75" name="noidung" rows="5" style="width: 100%;resize: none;"></textarea><br>
                                <br>
                                <div class="clear"></div>
                                <input style="background:#43a7d5;color:#fff;padding:12px;border:0" type="submit" name="binhluan" value="Bình luận">&nbsp;
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script>
    // Hiển thị form khi nút được nhấp
    function displayForm() {
        $("#myModal").css("display", "block");
    }

    // Ẩn form khi nút đóng hoặc màn hình mờ được nhấp
    $(".close, #myModal").on("click", function (event) {
        if (event.target === this || event.target.classList.contains("close")) {
            $("#myModal").css("display", "none");
        }
    });

    // Kiểm tra sự kiện click có xảy ra trên nút "Bình luận" hay không
    $(".binhluan").on("click", function (event) {
        if (event.target.classList.contains("open-form")) {
            displayForm();
        }
    });

</script>

    <div class="clear"></div>
<div class="tabs">
  <ul id="tabs-nav">
    <li><a href="#tab1">Tóm tắt</a></li>
    <li><a href="#tab2">Nội dung chi tiết</a></li>
    <li><a href="#tab3">Hình ảnh</a></li>
  </ul> <!-- END tabs-nav -->
  <div id="tabs-content">
    <div id="tab1" class="tab-content">
    <?php echo $row_chitiet['tomtat']?>
    </div>
    <div id="tab2" class="tab-content" width="100%">
    <?php echo $row_chitiet['noidung']?>
    </div>
    <div id="tab3" class="tab-content">
    <img width="100%" src="admincp/modules/quanlysanpham/uploads/<?php  echo $row_chitiet['hinhanh'] ?>" alt="">
    </div>
  </div> <!-- END tabs-content -->
</div> <!-- END tabs -->
</div>

<?php
        }
    ?>
    <section>
    <div class="rt-container">
        <div class="col-rt-12">
            <div class="Scriptcontent">
                <div class="feedback">
                    <h2 style="text-align: center; color: violet;">Bình luận của Người dùng</h2>

                    <?php
                    // $id_user = $_SESSION['id_khachhang'];

                    $sql = "SELECT * FROM tbl_comment, tbl_dangky WHERE tbl_comment.id_user = tbl_dangky.id_dangky AND tbl_comment.id_sanpham = '$_GET[id]' ORDER BY tbl_comment.id_comment DESC";
                    $result = mysqli_query($mysqli, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Hiển thị bình luận
                            echo "<div class='card mt-3'>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text'><strong>Thời gian bình luận:</strong> " . $row['thoigian'] . "</p>";
                            echo "<p class='card-text'><strong>ID Người dùng:</strong> " . $row['tenkhachhang'] . "</p>";
                            echo "<p class='card-text'><strong>Đánh giá:</strong> " . $row['sosao'] . " sao</p>";
                            echo "<p class='card-text'><strong>Bình luận:</strong> " . $row['noidung'] . "</p>";
                            echo '<img class="img img-responsive" width="auto" height="100px" src="anhcm/' . $row['hinhanh'] . '">';
                            if (isset($_SESSION['id_khachhang'])) {
                                // Lấy id người đăng nhập
                                $id_nguoidung = $_SESSION['id_khachhang'];
                            
                                // Kiểm tra xem người đăng nhập có phải là người bình luận không
                                if ($id_nguoidung == $row['id_user']) {
                                    // Nếu là người bình luận, hiển thị nút "Xóa bình luận"
                                    echo "<p class='card-text' style='text-align:center;'> <a class='btn btn-danger' href='index.php?quanly=xulycm&id_comment=" . $row['id_comment'] . "&id_sanpham=" . $row['id_sanpham'] . "'>Xóa bình luận của bạn</a></p>";
                                }
                            }
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo '<p style="text-align: center; color: red;">Chưa có bình luận nào.</p>';
                    }

                    mysqli_close($mysqli);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
