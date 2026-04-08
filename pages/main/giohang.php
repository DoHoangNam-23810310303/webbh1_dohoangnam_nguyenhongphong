<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Giỏ hàng</h3>
  <?php
    if(isset($_SESSION['dangky'])){
      echo 'Xin chào: '.'<span style="color:red">'. $_SESSION['dangky'].'<span>';
    }
  ?>
</p>
<?php
   if(isset($_SESSION['cart'])){
   
   }
?>
<?php
   if(isset($_SESSION['id_khachhang'])){?>
<div class="container">
  <div class="arrow-steps clearfix">
    <div class="step current"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step "> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step "> <span><a href="index.php?quanly=thongtinthanhtoan" >Thanh toán</a><span> </div>
    <div class="step"> <span><a href="index.php?quanly=donhangdadat" >Đơn hàng đang giao</a><span> </div>
  </div>
</div>
<?php
   }
  ?>
<div class="container">
    <div class="table-responsive">
        <table class="table giohang" style="width: 100%; text-align: center;" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã sp</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
                    <th>Quản lý</th>
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
                        <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-square-minus"></i></a>
                        <?php echo $cart_item['soluong']; ?>
                        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-square-plus"></i></a>
                    </td>
                    <td><?php echo number_format( $cart_item['giasp'],0,',','.').'vnđ'; ?></td>
                    <td><?php echo number_format( $thanhtien,0,',','.').'vnđ'; ?></td>
                    <td ><a class="btn btn-danger" href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>">Xóa</a></td>
                </tr>
                <?php
                        }
                ?>
                <tr>
                    <td colspan="8">
                        <p style="float: left;">Tổng tiền: <?php echo number_format( $tongtien,0,',','.').'vnđ'; ?></p>
                        <p style="float: right;"><a class="btn btn-info" href="pages/main/themgiohang.php?xoatatca=1">Xóa tất cả</a></p>
                        <div style="clear: both;"></div>
                        <?php
                            if(isset($_SESSION['dangky'])){
                        ?>
                        <p><a href="index.php?quanly=vanchuyen" class="btn btn-primary">Hình thức vận chuyển</a></p>
                        <?php
                            }else{
                            ?>
                        <p><a href="index.php?quanly=dangky" class="btn btn-primary">Đăng kí đặt hàng</a></p>
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
