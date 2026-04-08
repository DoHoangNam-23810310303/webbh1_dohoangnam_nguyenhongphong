<?php
        if(isset($_GET['trang'])){
            $page = $_GET['trang'];
        }else {
            $page =1;
        }
        if($page == '' || $page == 1){
            $begin = 0;
        }else{
            $begin =($page*12)-12;
        }
       $sql_pro ="SELECT * FROM tbl_sanpham 
       ORDER BY id_sanpham LIMIT $begin,12";
       $query_pro = mysqli_query($mysqli,$sql_pro);
      
?>
<h3 class="text-center text-uppercase font-weight-bold">Sản Phẩm</h3>
<div class="row">
    <?php
    while ($row = mysqli_fetch_array($query_pro)) {
    ?>
    <div class="col-md-3">
        <div class="product-item">
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">
                <img class="img img-fluid" src="admincp/modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" alt="<?php echo $row['tensanpham'] ?>">
                <p class="text-center title_product"><?php echo $row['tensanpham'] ?></p>
                <p class="text-center <?php echo $row['tinhtrang'] == '1' ? 'text-success' : 'text-danger'; ?>">
                    <?php echo $row['tinhtrang'] == '1' ? 'Còn hàng' : 'Hết hàng'; ?>
                </p>
                <p class="text-center price_product">Giá: <?php echo number_format($row['giasp'], 0, ',', '.') . 'vnđ' ?></p>
            </a>
        </div>
    </div>
    <?php
    }
    ?>
</div>
<div class="clearfix"></div>
<?php
$sql_trang = mysqli_query($mysqli, 'SELECT * FROM tbl_sanpham');
$row_count = mysqli_num_rows($sql_trang);
$trang = ceil($row_count / 12);
?>
<p> Trang hiện tại: <?php echo $page; ?>/<?php echo $trang; ?></p>
<ul class="pagination">
    <?php
    for ($i = 1; $i <= $trang; $i++) {
    ?>
    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
        <a class="page-link" href="index.php?quanly=khoahoc&trang=<?php echo $i; ?>"><?php echo $i; ?></a>
    </li>
    <?php
    }
    ?>
</ul>



