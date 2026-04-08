<?php
  session_start();
  include("../../admincp/config/config.php");
 require("../../carbon/autoload.php");
 require_once("config_vnpay.php");

 use Carbon\Carbon;
 use Carbon\CarbonInterval;
 $now = Carbon::now('Asia/Ho_Chi_Minh');
 $now->format('Y-m-d H:i:s');
 $id_khachhang = $_SESSION['id_khachhang'];
 $code_oder = rand(0,9999);
 $cart_payment = $_POST['payment'];
 //lấy id thông tin vận chuyển
 $id_dangky = $_SESSION['id_khachhang'];
 $sql_getvanchuyen = mysqli_query($mysqli,"SELECT * FROM  tbl_shipping WHERE id_dangky ='$id_dangky' LIMIT 1");
 $row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
 $id_shiping = $row_getvanchuyen["id_shipping"];
 $tongtien = 0;
 foreach($_SESSION['cart'] as $key => $value){
   $thanhtien=$value['soluong']* $value['giasp'];
   $tongtien+=$thanhtien;
 }


if($cart_payment =='tienmat'  || $cart_payment =='chuyenkhoan'){
   //insert vào đơn hàng
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
    header('location:../../index.php?quanly=camon');
   }elseif($cart_payment =='vnpay'){
      //Thanh toán vnpay
      $vnp_TxnRef = $code_oder; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
      $vnp_OrderInfo = 'Thanh toán đã đặt hàng tại web';
      $vnp_OrderType = 'billpayment';

      $vnp_Amount = $tongtien * 100;
      $vnp_Locale = 'vn';
      $vnp_BankCode = 'NCB';
      $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
      //Add Params of 2.0.1 Version
      $vnp_ExpireDate = $expire;
      
      $inputData = array(
          "vnp_Version" => "2.1.0",
          "vnp_TmnCode" => $vnp_TmnCode,
          "vnp_Amount" => $vnp_Amount,
          "vnp_Command" => "pay",
          "vnp_CreateDate" => date('YmdHis'),
          "vnp_CurrCode" => "VND",
          "vnp_IpAddr" => $vnp_IpAddr,
          "vnp_Locale" => $vnp_Locale,
          "vnp_OrderInfo" => $vnp_OrderInfo,
          "vnp_OrderType" => $vnp_OrderType,
          "vnp_ReturnUrl" => $vnp_Returnurl,
          "vnp_TxnRef" => $vnp_TxnRef,
          "vnp_ExpireDate"=>$vnp_ExpireDate
          
      );
      
      if (isset($vnp_BankCode) && $vnp_BankCode != "") {
          $inputData['vnp_BankCode'] = $vnp_BankCode;
      }
      ksort($inputData);
      $query = "";
      $i = 0;
      $hashdata = "";
      foreach ($inputData as $key => $value) {
          if ($i == 1) {
              $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
          } else {
              $hashdata .= urlencode($key) . "=" . urlencode($value);
              $i = 1;
          }
          $query .= urlencode($key) . "=" . urlencode($value) . '&';
      }
      
      $vnp_Url = $vnp_Url . "?" . $query;
      if (isset($vnp_HashSecret)) {
          $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
          $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
      }
      $returnData = array('code' => '00'
          , 'message' => 'success'
          , 'data' => $vnp_Url);
          if (isset($_POST['redirect'])) {
            $_SESSION['$code_cart']=$code_oder;
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
                    
                     unset($_SESSION['cart']);
               }
              header('Location: ' . $vnp_Url);
              die();
              
          } else {
              echo json_encode($returnData);
          }

   }elseif($cart_payment == 'momo'){
   }elseif($cart_payment == 'paypal'){
  }

  unset($_SESSION['cart']);
  header('location:../../index.php?quanly=camon');
  
?>