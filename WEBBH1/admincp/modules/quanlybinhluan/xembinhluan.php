<?php
$sql_lietke_cm_bd = "SELECT * FROM comment_replies,tbl_dangky WHERE comment_replies.user_id =tbl_dangky.id_dangky ORDER BY comment_replies.id = '$_GET[idbl]'";
$query_lietke_cm_bd = mysqli_query($mysqli, $sql_lietke_cm_bd);
?>
<h6 style="text-align: center;text-transform: uppercase;font-weight: bold;">Liệt kê bình luận trong cộng đồng reply</h6>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên người bình luận</th>
    <th>Nội dung bình luận</th>
    <th>Thời gian</th>
    <th>Quản lý</th>
  </tr>
  <?php
  $num_rows = mysqli_num_rows($query_lietke_cm_bd); // Đếm số dòng trả về từ truy vấn

  if ($num_rows > 0) {
    $i = 0;
    while ($row_bd = mysqli_fetch_array($query_lietke_cm_bd)) {
      $i++;
  ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row_bd['tenkhachhang'] ?></td>
        <td><?php echo $row_bd['reply_msg'] ?></td>
        <td><?php echo $row_bd['time'] ?></td>
        <td>
          <a class="btn btn-primary" href="modules/quanlybinhluan/xuly.php?idreplies=<?php echo  $row_bd['id'] ?>">Xóa</a>
        </td>
      </tr>
    <?php }
  } else { ?>
    <tr>
      <td colspan="5" style="text-align: center;color: violet;"><?php echo 'Không có bình luận nào khác'; ?></td>
    </tr>
  <?php } ?>
</table>
