<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Thông tin vận chuyển</h3>
<div class="container">
<?php
   if(isset($_SESSION['id_khachhang'])){?>
  <div class="arrow-steps clearfix">
    <div class="step done "> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step current"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step "> <span><a href="index.php?quanly=thongtinthanhtoan" >Thanh toán</a><span> </div>
    <div class="step "> <span><a href="index.php?quanly=donhangdadat" >Đơn hàng đang giao</a><span> </div>
  </div>
  <?php
   }
   ?>
  <h4>Thông tin vận chuyển</h4>
  <?php
      if(isset($_POST['themvanchuyen'])){
        $name = $_POST['name'];
        $phone= $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $id_dangky = $_SESSION['id_khachhang'];
        $sql_them_vanchuyen = mysqli_query($mysqli,"INSERT INTO tbl_shipping(name,phone,address,note,id_dangky) 
        VALUE('$name','$phone','$address','$note','$id_dangky')");
      if($sql_them_vanchuyen){
        echo '<script>alert("Thêm vận chuyển thành công")</script>';
      }
      }elseif(isset($_POST['capnhapvanchuyen'])){
        $name = $_POST['name'];
        $phone= $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $id_dangky = $_SESSION['id_khachhang'];
        $sql_update_vanchuyen = mysqli_query($mysqli,"UPDATE tbl_shipping 
        SET name='$name',phone='$phone',address='$address',note='$note',id_dangky='$id_dangky' WHERE id_dangky = '$id_dangky'");
      if($sql_update_vanchuyen){
        echo '<script>alert("Cập nhập vận chuyển thành công")</script>';
      }
      }
  ?>
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
    <form action="" autocomplete="off" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" name="name" placeholder="...." class="form-control" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" placeholder="...." class="form-control" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" placeholder="...." class="form-control" value="<?php echo $address; ?>">
                </div>
                <div class="form-group">
                    <label for="note">Ghi chú</label>
                    <input type="text" name="note" placeholder="...." class="form-control" value="<?php echo $note; ?>">
                </div>
            </div>
        </div>
        <?php
        if($name == '' && $phone == ''){
        ?>
            <button type="submit" name="themvanchuyen" class="btn btn-primary">Thêm vận chuyển</button>
        <?php
        } elseif($name != '' && $phone != ''){
        ?>
            <button type="submit" name="capnhapvanchuyen" class="btn btn-success">Cập nhập vận chuyển</button>
        <?php
        }
        ?>
    </div>
</form>

  
    <!---------------------------------------------->
    <div class="container">
    <div class="table-responsive">
        <table class="table giohang" style="width: 100%; text-align: center;" border="1" style="border-collapse: collapse;">
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
                        <?php
                            if(isset($_SESSION['dangky'])){
                        ?>
                        <p><a href="index.php?quanly=thongtinthanhtoan" class="btn btn-primary">Hình thức thanh toán</a></p>
                        <?php
                            }else{
                            ?>
                        <p><a href="index.php?quanly=dangky">Đăng kí đặt hàng</a></p>
                            <?php
                            }
                        ?>
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
</div>