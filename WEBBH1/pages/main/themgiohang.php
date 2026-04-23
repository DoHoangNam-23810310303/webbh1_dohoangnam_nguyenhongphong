<?php
   session_start();
   include('../../admincp/config/config.php');
   //them so luong
   if (isset($_GET['cong'])){
    $id = $_GET['cong'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham ='".$id."' LIMIT 1";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($query);
    if($row){
        $soluong_con_lai = $row['soluong']; // Số lượng sản phẩm còn lại trong kho

        // Kiểm tra số lượng sản phẩm đã có trong giỏ hàng
        $so_luong_da_co_trong_gio_hang = 0;
        foreach($_SESSION['cart'] as $cart_item){
            if ($cart_item['id'] == $id){
                $so_luong_da_co_trong_gio_hang = $cart_item['soluong'];
                break;
            }
        }

        // Kiểm tra nếu số lượng trong giỏ hàng cộng với 1 vượt quá số lượng còn lại
        if (($so_luong_da_co_trong_gio_hang + 1) <= $soluong_con_lai){
            foreach($_SESSION['cart'] as &$cart_item){
                if ($cart_item['id'] != $id){
                    $product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp']
                    ,'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                }else{
                    $tangsoluong =$cart_item['soluong']+1;
                    $product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'giasp'=>$cart_item['giasp']
                    ,'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
                }
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('location:../../index.php?quanly=giohang');
}

   //tru so luong
   if (isset($_GET['tru'])){
    $id = $_GET['tru'];
    foreach($_SESSION['cart'] as $cart_item ){
        if ($cart_item['id']!=$id){
            $product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp']
            ,'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
            $_SESSION['cart'] = $product;
        }else{
            $tangsoluong =$cart_item['soluong']-1;
            if($cart_item['soluong']>1){
            $product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'giasp'=>$cart_item['giasp']
            ,'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
            }else{
                $product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp']
            ,'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
            }
            $_SESSION['cart'] = $product;
        }
    }
    header('location:../../index.php?quanly=giohang');
   }
   //xoa san pham
   if (isset($_SESSION['cart'])&&isset($_GET['xoa'])){
    $id = $_GET['xoa'];
    foreach($_SESSION['cart'] as $cart_item){
        if ($cart_item['id']!=$id){
            $product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp']
            ,'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
        }
        $_SESSION['cart'] = $product;
        header('location:../../index.php?quanly=giohang');
    }
   }
   //xoa tat ca
    if (isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
        unset($_SESSION['cart']);
        header('location:../../index.php?quanly=giohang');
    }

//them san pham vao gio hang
if(isset($_POST['themgiohang'])){
    $id = $_GET['idsanpham'];
    $soluong = 1;
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham ='".$id."' LIMIT 1";
    $query = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($query);
    if($row){
        // Kiểm tra số lượng có sẵn trong cơ sở dữ liệu
        if($soluong > $row['soluong']){
            // Nếu số lượng vượt quá, hãy giới hạn lại số lượng
            $soluong = $row['soluong'];
        }
        
        $new_product = array(array('tensanpham'=>$row['tensanpham'],'id'=>$id,'soluong'=>$soluong,'giasp'=>$row['giasp']
        ,'hinhanh'=>$row['hinhanh'],'masp'=>$row['masp']));
        // kiem tra session gio hang ton tai
        if(isset($_SESSION['cart'])){
            $found = false;
            foreach($_SESSION['cart'] as &$cart_item){
                // neu du lieu trung
                if($cart_item['id'] == $id){
                    // Kiểm tra xem có vượt quá số lượng không
                    if(($cart_item['soluong'] + $soluong) > $row['soluong']){
                        $cart_item['soluong'] = $row['soluong'];
                    } else {
                        $cart_item['soluong'] += $soluong;
                    }
                    $found = true;
                }
            }
            if($found == false){
                // lien ket du lieu product voi new_product
                $_SESSION['cart'] = array_merge($_SESSION['cart'], $new_product);
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('location:../../index.php?quanly=giohang');
}

?>