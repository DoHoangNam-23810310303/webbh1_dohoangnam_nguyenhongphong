<?php
        if(isset($_POST['timkiem'])){
            $tukhoa = $_POST['tukhoa'];
        } else{
            $tukhoa = '';
        }
       $sql_pro ="SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE'%".$tukhoa."%'";
       $query_pro = mysqli_query($mysqli,$sql_pro);
      
?>
<style>
 
@media (max-width: 767px) {
    ul.product_list li {
        width: 100%;
    }

    ul.title_product, .price_product {
        text-align: center;
    }
}

</style>
<h3>Từ khóa tìm kiếm: <?php echo $_POST['tukhoa'];  ?></h3>
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
<?php
       $sql_pro ="SELECT * FROM tbl_baiviet,tbl_danhmucbaiviet WHERE tbl_baiviet.id_danhmuc = tbl_danhmucbaiviet.id_danhmucbaiviet AND tbl_baiviet.tenbaiviet LIKE'%".$tukhoa."%'";
       $query_pro = mysqli_query($mysqli,$sql_pro);
      
?>
<div class="row">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
    <div class="col-md-3">
        <div class="news-item">
            <a href="index.php?quanly=baiviet&id=<?php echo $row_pro['id_baiviet']?>">
                <img class="img img-fluid" src="admincp/modules/quanlybaiviet/uploads/<?php echo $row_pro['hinhanh'] ?>" alt="<?php echo $row_pro['tenbaiviet'] ?>">
                <p class="text-center title_product"><?php echo $row_pro['tenbaiviet'] ?></p>
            </a>
        </div>
    </div>
    <?php
    }
    ?>
</div>
