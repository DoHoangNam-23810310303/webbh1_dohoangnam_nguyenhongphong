<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Hình thức thanh toán</h3>
<div class="container">
<?php
   if(isset($_SESSION['id_khachhang'])){?>
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step current "> <span><a href="index.php?quanly=thongtinthanhtoan" >Thanh toán</a><span> </div>
    <div class="step "> <span><a href="index.php?quanly=donhangdadat" >Đơn hàng đang giao</a><span> </div>
  </div>
  <?php
   }
  ?>

  <form action="pages/main/xulythanhtoan.php" method="POST">
  <div class="row">
  <?php
     $id_dangky = $_SESSION['id_khachhang'];
     $sql_getvanchuyen = mysqli_query($mysqli,"SELECT * FROM  tbl_shipping WHERE id_dangky ='$id_dangky' LIMIT 1");
     $count = mysqli_num_rows($sql_getvanchuyen);
     if($count>0){
      $row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
      $name =  $row_getvanchuyen['name'];
      $phone=  $row_getvanchuyen['phone'];
      $address =  $row_getvanchuyen['address'];
      $note =  $row_getvanchuyen['note'];
     } else{
      $name = '';
      $phone=  '';
      $address =  '';
      $note =  '';
     }
    ?>
    <div class="col-md-8">
      <h4>Thông tin vận chuyển và giỏ hàng</h4>
      <ul>
        <li>Họ và tên vận chuyển: <b><?php echo $name ?></b></li>
        <li>Số điện thoại: <b><?php echo $phone ?></b></li>
        <li>Địa chỉ: <b><?php echo $address ?></b></li>
        <li>Ghi chú: <b><?php echo $note ?></b></li>
      </ul>
      <h5>Giỏ hàng của bạn</h5>
      <div class="container">
    <div class="table-responsive">
    <table style="width: 100%;text-align: center;border-collapse: collapse;" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã sp</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_SESSION['cart'])){
                        $i=0;
                        $tongtien=0;
                        foreach($_SESSION['cart'] as $cart_item){
                            $thanhtien=$cart_item['soluong']* $cart_item['giasp'];
                            $tongtien+=$thanhtien;
                            $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $cart_item['masp']; ?></td>
                    <td><?php echo $cart_item['tensanpham']; ?></td>
                    <td><img src="admincp/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh']; ?>" width="150px" alt=""></td>
                    <td>
                        <?php echo $cart_item['soluong']; ?>
                    </td>
                    <td><?php echo number_format( $cart_item['giasp'],0,',','.').'vnđ'; ?></td>
                    <td><?php echo number_format( $thanhtien,0,',','.').'vnđ'; ?></td>
                </tr>
                <?php
                        }
                ?>
                <tr>
                    <td colspan="8">
                        <p style="float: left;">Tổng tiền: <?php echo number_format( $tongtien,0,',','.').'vnđ'; ?></p>
                        <div style="clear: both;"></div>
                    </td>
                </tr>
                <?php
                    }else {
                ?>
                <tr>
                    <td colspan="8"><p>Hiện tại giỏ hàng trống</p></td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

    </div>
    <style>
      .col-md-4.hinhthucthanhtoan .form-check {
         margin: 11px;
      }
    </style>
    <div class="col-md-4 hinhthucthanhtoan">
      <h4>Phương thức thanh toán</h4>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="tienmat"  checked>
        <label class="form-check-label" for="exampleRadios1">
         Tiền mặt
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="chuyenkhoan">
        <label class="form-check-label" for="exampleRadios2">
          Chuyển khoản
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios4" value="vnpay" >
        <img src="images/VNPAYol.jpg" height="40" width="55" alt="">
        <label class="form-check-label" for="exampleRadios4">
         VNPay
        </label>
      </div>
      <input type="submit" value="Thanh toán ngay" name="redirect" class="btn btn-danger">
      </form>
      <p></p>
      
      <?php
      $tongtien= 0;
        foreach($_SESSION['cart'] as $key => $value){
          $thanhtien=$value['soluong']* $value['giasp'];
          $tongtien+=$thanhtien;
        }
        $tongtien_vnd = $tongtien;
        $tongtien = round($tongtien/23000);
      ?>
      <input type="hidden"  value="<?php echo $tongtien ?>" id="tongtien">
      <div id="paypal-button"></div>


      <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
              action="pages/main/xulythanhtoanmomo.php">
              <input type="hidden"  value="<?php echo  $tongtien_vnd ?>" name="tongtien_vnd">
          <input type="submit" value="Thanh toán MOMO QRcode" class="btn btn-danger">
      </form>


      <p></p>


      <form class="" method="POST" enctype="application/x-www-form-urlencoded"
              action="pages/main/xulythanhtoanmomo_atm.php">
          <input type="hidden"  value="<?php echo  $tongtien_vnd ?>" name="tongtien_vnd">
          <input type="submit" value="Thanh toán MOMO ATM " class="btn btn-danger">
      </form>
    </div>
  </div>
</div>
