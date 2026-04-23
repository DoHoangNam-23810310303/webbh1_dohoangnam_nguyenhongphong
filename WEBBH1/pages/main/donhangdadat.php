<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Chi tiết đơn hàng đã đặt</h3>
<div class="container">
<?php
   if(isset($_SESSION['id_khachhang'])){?>
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step done"> <span><a href="index.php?quanly=thongtinthanhtoan" >Thanh toán</a><span> </div>
    <div class="step current"> <span><a href="index.php?quanly=donhangdadat" >Đơn hàng đang giao</a><span> </div>
  </div>
  <?php
   }
  ?>
</div>
<?php
$id_khachhang = $_SESSION['id_khachhang'];
$sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_dangky WHERE tbl_cart.id_khachhang = tbl_dangky.id_dangky AND tbl_cart.id_khachhang = '$id_khachhang' ORDER BY tbl_cart.id_cart DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<div class="container">
    <div class="table-responsive">
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
              if ($row['cart_status'] == 0) {
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
                  if ($row['cart_status'] == 0) {
                    echo '<b style="color:blue">Đơn hàng đang vận chuyển</b>';
                  }
                  ?>
                </td>
                <td><?php echo $row['thoigian'] ?></td>
                <td>
                  <a class="btn btn-primary" href="index.php?quanly=xemdonhang&code=<?php echo  $row['code_cart'] ?>">Xem đơn hàng</a>
                </td>
                <td><?php echo $row['cart_payment'] ?></td>
              </tr>
            <?php }} ?>
          </table>
          </div>
</div>
<?php
if (isset($_GET['congthanhtoan'])) {
  $congthanhtoan = $_GET['congthanhtoan'];
  $code_cart = $_GET['code_cart'];
  echo '<h4>Chi tiết thanh toán qua cổng thanh toán : ' . $congthanhtoan . ' </h4>';
  if ($congthanhtoan == 'MOMO') {
    $sql_momo = mysqli_query($mysqli, "SELECT * FROM tbl_momo WHERE code_cart='$code_cart' LIMIT 1 ");
    $row_momo = mysqli_fetch_array($sql_momo);
    ?>
  <div class="container">
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Partner_code</th>
          <th>Order_id</th>
          <th>Amount</th>
          <th>Order_info</th>
          <th>Order_Type</th>
          <th>Trans_id</th>
          <th>Pay_type</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $row_momo['partner_code'] ?></td>
          <td><?php echo $row_momo['order_id'] ?></td>
          <td><?php echo $row_momo['amount'] ?></td>
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
<div class="container">
    <div class="table-responsive">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th>vnp_amount</th>
                  <th>vnp_bankCode</th>
                  <th>vnp_banktranno</th>
                  <th>vnp_oderinfo</th>
                  <th>vnp_paydate</th>
                  <th>vnp_tmncode</th>
                  <th>vnp_transactionno</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $row_vnpay['vnp_amount'] ?></td>
                  <td><?php echo $row_vnpay['vnp_bankcode'] ?></td>
                  <td><?php echo $row_vnpay['vnp_banktranno'] ?></td>
                  <td><?php echo $row_vnpay['vnp_orderinfo'] ?></td>
                  <td><?php echo $row_vnpay['vnp_paydate'] ?></td>
                  <td><?php echo $row_vnpay['vnp_tmncode'] ?></td>
                  <td><?php echo $row_vnpay['vnp_transactionno'] ?></td>
                </tr>
              </tbody>
          </table>
  </div>
</div>
<?php
  }
}
?>
