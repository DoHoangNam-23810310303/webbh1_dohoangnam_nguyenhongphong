<?php
$id_khachhang = $_SESSION['id_khachhang'];
$sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_dangky WHERE tbl_cart.id_khachhang = tbl_dangky.id_dangky AND tbl_cart.id_khachhang = '$id_khachhang' ORDER BY tbl_cart.id_cart DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Mã đơn hàng</th>
    <th>Tên khách hàng</th>
    <th>Địa chỉ nhận hàng</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Tình trạng</th>
    <th>Ngày đặt</th>
    <th>Quản lý</th>
    <th>Hình thức thanh toán</th>
  </tr>
  <?php
  $i = 0;
  while ($row = mysqli_fetch_array($query_lietke_dh)) {
    $i++;
  ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['code_cart'] ?></td>
      <td><?php echo $row['tenkhachhang'] ?></td>
      <td><?php echo $row['diachi'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td><?php echo $row['dienthoai'] ?></td>
      <td>
        <?php
        if ($row['cart_status'] == 1) {
          echo '<b style="color:red"> Đơn hàng mới</b>';
        } else {
          echo '<b style="color:blue">Đơn hàng đang vận chuyển</b>';
        }
        ?>
      </td>
      <td><?php echo $row['thoigian'] ?></td>
      <td>
        <a class="btn btn-primary" href="index.php?quanly=xemdonhang&code=<?php echo  $row['code_cart'] ?>">Xem đơn hàng</a>
      </td>
      <td>
        <?php
        if ($row['cart_payment'] == 'vnpay' || $row['cart_payment'] == 'MOMO' ) {
        ?>
          <a href="index.php?quanly=lichsudonhang&congthanhtoan=<?php echo  $row['cart_payment'] ?>&code_cart=<?php echo $row['code_cart'] ?>"><?php echo $row['cart_payment'] ?></a>
        <?php
        } else {
          echo $row['cart_payment'];
        }
        ?>
      </td>
    </tr>
  <?php } ?>
</table>
<?php
if (isset($_GET['congthanhtoan'])) {
  $congthanhtoan = $_GET['congthanhtoan'];
  $code_cart = $_GET['code_cart'];
  echo '<h4>Chi tiết thanh toán qua cổng thanh toán : ' . $congthanhtoan . ' </h4>';
  if ($congthanhtoan == 'MOMO') {
    $sql_momo = mysqli_query($mysqli, "SELECT * FROM tbl_momo WHERE code_cart='$code_cart' LIMIT 1 ");
    $row_momo = mysqli_fetch_array($sql_momo);
    ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Partner_code</th>
          <th>Order_id</th>
          <th>Tổng tiền</th>
          <th>Thông tin thanh toán</th>
          <th>Loại thanh toán</th>
          <th>ID giao dịch</th>
          <th>Cổng thanh toán</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $row_momo['partner_code'] ?></td>
          <td><?php echo $row_momo['order_id'] ?></td>
          <td><?php echo number_format( $row_momo['amount'],0,',','.').'vnđ'?></td>
          <td><?php echo $row_momo['order_info'] ?></td>
          <td><?php echo $row_momo['order_type'] ?></td>
          <td><?php echo $row_momo['trans_id'] ?></td>
          <td><?php echo $row_momo['pay_type'] ?></td>
        </tr>
      </tbody>
    </table>
  <?php
  } elseif ($congthanhtoan == 'vnpay') {
    $sql_vnpay = mysqli_query($mysqli, "SELECT * FROM tbl_vnpay WHERE code_cart='$code_cart' LIMIT 1 ");
    $row_vnpay = mysqli_fetch_array($sql_vnpay);
    ?>
   <table class="table table-striped">
      <thead>
        <tr>
          <th>Tổng tiền</th>
          <th>Ngân hàng</th>
          <th>Dịch vụ</th>
          <th>Thông tin</th>
          <th>Ngày thanh toán</th>
          <th>Mã tmn</th>
          <th>Mã giao dịch</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo number_format( $row_vnpay['vnp_amount'],0,',','.').'vnđ' ?></td>
          <td><?php echo $row_vnpay['vnp_bankcode'] ?></td>
          <td><?php echo $row_vnpay['vnp_banktranno'] ?></td>
          <td><?php echo $row_vnpay['vnp_orderinfo'] ?></td>
          <td><?php echo $row_vnpay['vnp_paydate'] ?></td>
          <td><?php echo $row_vnpay['vnp_tmncode'] ?></td>
          <td><?php echo $row_vnpay['vnp_transactionno'] ?></td>
        </tr>
      </tbody>
    </table>
<?php
  }
}
?>
