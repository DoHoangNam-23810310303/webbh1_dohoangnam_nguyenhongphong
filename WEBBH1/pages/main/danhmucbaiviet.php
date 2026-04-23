<?php
    $sql_pro_bv ="SELECT * FROM tbl_baiviet WHERE tbl_baiviet.id_danhmuc = '$_GET[id]' ORDER BY id_baiviet DESC";
    $query_pro_bv = mysqli_query($mysqli,$sql_pro_bv);
    //get ten danh muc
    $sql_cate_bv ="SELECT * FROM tbl_danhmucbaiviet WHERE tbl_danhmucbaiviet.id_danhmucbaiviet = '$_GET[id]' LIMIT 1";
    $query_cate_bv = mysqli_query($mysqli,$sql_cate_bv);
    $row_title = mysqli_fetch_array($query_cate_bv);
?>

<h3 style="text-align: center; text-transform: uppercase;">Danh mục bài viết: <?php echo $row_title['tendanhmucbaiviet'] ?></h3>

<div class="row">
    <?php
    while($row_pro = mysqli_fetch_array($query_pro_bv)){
    ?>
    <div class="col-md-3 ">
        <div class="news-item ">
            <a href="index.php?quanly=baiviet&id=<?php echo $row_pro['id_baiviet']?>">
                <img class="img img-fluid"  src="admincp/modules/quanlybaiviet/uploads/<?php echo $row_pro['hinhanh'] ?>">
                <p class="title_product">Tên bài viết: <?php echo $row_pro['tenbaiviet'] ?></p>
            </a>
        </div>
    </div>
    <?php
    }
    ?>
</div>
