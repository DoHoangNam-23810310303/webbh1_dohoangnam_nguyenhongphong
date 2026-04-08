<?php
  include("admincp/config/config.php");
  require("carbon/autoload.php");
  
  use Carbon\Carbon;
 use Carbon\CarbonInterval;

 $now = Carbon::now('Asia/Ho_Chi_Minh');
 $now->format('Y-m-d H:i:s');
 if(isset($_GET['vnp_Amount'])) {
   $vnp_Amount =$_GET['vnp_Amount'];
   $vnp_BankCode = $_GET['vnp_BankCode'];
   $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
   $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
   $vnp_PayDate = $_GET['vnp_PayDate'];
   $vnp_TmnCode = $_GET['vnp_TmnCode'];
   $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
   $vnp_CardType = $_GET['vnp_CardType'];
   $code_cart = $_SESSION['$code_cart'];
   
   
   $insert_vnpay = "INSERT INTO tbl_vnpay(vnp_amount,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno,code_cart)
   VALUE ('". $vnp_Amount."','". $vnp_BankCode ."','".$vnp_BankTranNo."','".$vnp_CardType."','".$vnp_OrderInfo."','".$vnp_PayDate."','".$vnp_TmnCode."','".$vnp_TransactionNo ."','".$code_cart ."')";
   $cart_query = mysqli_query($mysqli,$insert_vnpay);


   if($cart_query){
      echo "<h3>Giao dịch thanh toán bằng VNPAY thành công</h3>";
      echo '<p>Vui lòng vào trang <a target="_blank" href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</p>';
   }else{
      echo 'Giao dịch thất bại';
   }
}elseif(isset($_GET['partnerCode'])){
   $code_oder = rand(0,9999);
   $id_khachhang = $_SESSION['id_khachhang'];
   $partnerCode =$_GET['partnerCode'];
   $orderId = $_GET['orderId'];
   $amount= $_GET['amount'];
   $orderInfo = $_GET['orderInfo'];
   $orderType = $_GET['orderType'];
   $transId = $_GET['transId'];
   $payType = $_GET['payType'];
   $cart_payment='MOMO';
    //lay id thong tin de van chuyen
    $sql_getvanchuyen = mysqli_query($mysqli,"SELECT * FROM  tbl_shipping WHERE id_dangky ='$id_khachhang' LIMIT 1");
    $row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
    $id_shiping = $row_getvanchuyen["id_shipping"];
   $insert_vnpay = "INSERT INTO tbl_momo(partner_code,order_id,amount,order_info,order_type,trans_id,pay_type,code_cart)
   VALUE ('". $partnerCode."','". $orderId ."','".$amount."','".$orderInfo."','".$orderType."','".$transId."','".$payType."','".$code_oder ."')";
   $cart_query = mysqli_query($mysqli,$insert_vnpay);
     //insert database momo
     $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status,thoigian,cart_payment,cart_shipping) 
     VALUES ('".$id_khachhang."','".$code_oder."',1,'".$now."','".$cart_payment."','".$id_shiping."')";
     $cart_query = mysqli_query($mysqli,$insert_cart);
     foreach($_SESSION['cart'] as $key => $value){
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
          
        $sql_get_soluong = "SELECT soluong FROM tbl_sanpham WHERE id_sanpham = $id_sanpham";
        $query_get_soluong = mysqli_query($mysqli, $sql_get_soluong);
        $row_soluong = mysqli_fetch_array($query_get_soluong);
        $soluong_hientai = $row_soluong['soluong'];
        
        // Trừ số lượng đã mua
        $soluong_moi = $soluong_hientai - $soluong;
        
        // Cập nhật số lượng mới vào CSDL
        $sql_update_soluong = "UPDATE tbl_sanpham SET soluong = $soluong_moi WHERE id_sanpham = $id_sanpham";
        mysqli_query($mysqli, $sql_update_soluong);
        
        $insert_oder_details = "INSERT INTO tbl_cart_details(id_sanpham,code_cart,soluongmua,thoigian) VALUES ('".$id_sanpham."','".$code_oder."','".$soluong."','".$now."')";
        mysqli_query($mysqli,$insert_oder_details);
      }
  
   if($cart_query){
      unset($_SESSION['cart']);
      echo "<h3>Giao dịch thanh toán bằng VNPAY thành công</h3>";
      echo '<p>Vui lòng vào trang <a target="_blank" href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</p>';
   }else{
      echo 'Giao dịch thất bại';
   }
}
else{
   if(isset($_GET['thanhtoan'])=='paypal'){
      $code_oder = rand(0,9999);
      $cart_payment = 'paypal';
      $id_khachhang = $_SESSION['id_khachhang'];
      $sql_getvanchuyen = mysqli_query($mysqli,"SELECT * FROM  tbl_shipping WHERE id_dangky ='$id_khachhang' LIMIT 1");
      $row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
      $id_shiping = $row_getvanchuyen["id_shipping"];
      $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status,thoigian,cart_payment,cart_shipping) 
    VALUES ('".$id_khachhang."','".$code_oder."',1,'".$now."','".$cart_payment."','".$id_shiping."')";
   
    $cart_query = mysqli_query($mysqli,$insert_cart);
    //lấy đơn hàng chi tiết
       foreach($_SESSION['cart'] as $key => $value){
         $id_sanpham = $value['id'];
         $soluong = $value['soluong'];
           
         $sql_get_soluong = "SELECT soluong FROM tbl_sanpham WHERE id_sanpham = $id_sanpham";
         $query_get_soluong = mysqli_query($mysqli, $sql_get_soluong);
         $row_soluong = mysqli_fetch_array($query_get_soluong);
         $soluong_hientai = $row_soluong['soluong'];
         
         // Trừ số lượng đã mua
         $soluong_moi = $soluong_hientai - $soluong;
         
         // Cập nhật số lượng mới vào CSDL
         $sql_update_soluong = "UPDATE tbl_sanpham SET soluong = $soluong_moi WHERE id_sanpham = $id_sanpham";
         mysqli_query($mysqli, $sql_update_soluong);
         
         $insert_oder_details = "INSERT INTO tbl_cart_details(id_sanpham,code_cart,soluongmua,thoigian) VALUES ('".$id_sanpham."','".$code_oder."','".$soluong."','".$now."')";
         mysqli_query($mysqli,$insert_oder_details);
       }
       if($cart_query){
         unset($_SESSION['cart']);
         echo "<h3>Giao dịch thanh toán bằng PAYPAL thành công</h3>";
         echo '<p>Vui lòng vào trang <a target="_blank" href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</p>';
      }else{
         echo 'Giao dịch thất bại';
         }
   }
}
?>
<p>Cảm ơn bạn đã mua hàng, chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất</p>