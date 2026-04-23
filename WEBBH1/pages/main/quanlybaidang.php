<?php
$id_khachhang = $_SESSION['id_khachhang'];
$sql_lietke_baidang = "SELECT * FROM tbl_dangbai, tbl_dangky WHERE tbl_dangbai.id_user = tbl_dangky.id_dangky AND tbl_dangbai.id_user = '$id_khachhang' ORDER BY tbl_dangbai.id_baidang DESC";
$query_lietke_baidang = mysqli_query($mysqli, $sql_lietke_baidang);
?>
<div class="container">
    <div class="table-responsive">
          <table style="width: 100%;" border="1" style="border-collapse: collapse;">
            <tr>
              <th>ID</th>
              <th>Tên bài đăng</th>
              <th>Hình ảnh</th>
              <th>Tình trạng</th>
              <th>Thời gian</th>
              <th>Quản lý</th>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke_baidang)) {
              $i++;
            ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tenbaidang'] ?></td>
                <td><img classs="img img-responsive" width="100%" height="150px" src="uploads/<?php echo $row['hinhanh'] ?>"></td>
                <td style="color:darkblue">
                <?php
                if ($row['tinhtrang'] == 1) {
                  echo '<b style="color:red">Đang chờ xét duyệt</b>';
                }else if($row['tinhtrang'] == 2){
                  echo '<b style="color: blueviolet">QTV đã từ chối bài viết</b>';
                }
                else {
                  echo '<b style="color:darkblue">Đã duyệt bài viết</b>';
                }
                ?>
              </td>
                <td><?php echo $row['thoigian'] ?></td>
                <td><a href="index.php?quanly=xulybaidang&xoa=<?php echo $row['id_baidang'] ?>" class="btn btn-danger">Xóa bài viết</a><br><br>
                <a href="index.php?quanly=suabaidang&id=<?php echo $row['id_baidang'] ?>" class="btn btn-success">Sửa bài viết</a><br><br>
                <a href="index.php?quanly=chitietbaidang&id=<?php echo $row['id_baidang'] ?>" class="btn btn-info">Xem bài đăng</a>
              </td>
              </tr>
            <?php }
           ?>
          </table>
          </div>
</div>