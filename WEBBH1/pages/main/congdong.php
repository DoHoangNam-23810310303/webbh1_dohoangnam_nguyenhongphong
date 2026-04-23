<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Bài đăng mới nhất</h3>

<?php
$sql_pro_bd = "SELECT * 
FROM tbl_dangbai 
INNER JOIN tbl_dangky ON tbl_dangbai.id_user = tbl_dangky.id_dangky 
WHERE tbl_dangbai.tinhtrang = 0 
ORDER BY tbl_dangbai.id_baidang DESC";

$query_pro_bd = mysqli_query($mysqli, $sql_pro_bd);

?>

<p style="text-align: center;">
    <a href="index.php?quanly=dangbai" class="btn btn-primary">Đăng bài viết của bạn</a>
    <?php
    if(isset($_SESSION['dangky'])){
        ?>
        <a href="index.php?quanly=quanlybaidang" class="btn btn-info">Trạng thái bài viết bạn đã đăng</a>
        <?php
    }
    ?>
</p>

<div class="row">
    <?php
    while($row_pro = mysqli_fetch_array($query_pro_bd)){
    ?>
    <div class="col-md-3">
        <div class="post-item">
            <a href="index.php?quanly=chitietbaidang&id=<?php echo $row_pro['id_baidang']?>">
                <img class="img img-responsive" width="100%" height="150px" src="uploads/<?php echo $row_pro['hinhanh'] ?>">
                <p class="title_product"><?php echo $row_pro['tenbaidang'] ?></p>
                <span style="color: gray;"><?php echo $row_pro['thoigian'] ?></span>
                <p class="title_product text-success">Tác giả :<?php echo $row_pro['tenkhachhang'] ?></p>
            </a>
        </div>
    </div>
    <?php
    }
    ?>
</div>
