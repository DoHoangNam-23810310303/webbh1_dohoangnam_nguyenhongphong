<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Tin tức mới nhất</h3>

<?php
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = 1;
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 12) - 12;
}
$sql_pro_bv = "SELECT * FROM tbl_baiviet WHERE tinhtrang=1 ORDER BY id_baiviet LIMIT $begin,12";
$query_pro_bv = mysqli_query($mysqli, $sql_pro_bv);
?>

<div class="row">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro_bv)) {
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
<div style="clear: both;"></div>
<?php
$sql_trang = mysqli_query($mysqli, 'SELECT * FROM tbl_baiviet');
$row_count = mysqli_num_rows($sql_trang);
$trang = ceil($row_count / 12);
?>
<p> Trang hiện tại: <?php echo $page; ?>/<?php echo $trang; ?></p>
<ul class="pagination">
    <?php
    for ($i = 1; $i <= $trang; $i++) {
    ?>
    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
        <a class="page-link" href="index.php?quanly=tintuc&trang=<?php echo $i; ?>"><?php echo $i; ?></a>
    </li>
    <?php
    }
    ?>
</ul>
