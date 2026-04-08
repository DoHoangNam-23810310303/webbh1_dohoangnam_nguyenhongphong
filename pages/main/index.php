<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/index.css">
  <title>Trang chủ</title>
</head>
<body>
<?php
  $sql = "SELECT * FROM tbl_trangchu";
  $query = mysqli_query($mysqli,$sql);
?>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
  <div class="carousel-inner">
    <?php 
      $active = true; // Biến này để kiểm soát slide đầu tiên là active
      while($row = mysqli_fetch_array($query)){
    ?>
    <div class="carousel-item <?php if($active){ echo 'active'; $active = false; } ?>">
      <a href="<?php echo $row['link'] ?>"><img src="admincp/modules/quanlywebsite/uploads/<?php echo $row['hinhanh'] ?>" class="d-block w-100" alt="Slide"></a>
    </div>
    <?php
      }
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="image-container">
        <img src="images/p20.webp" class="img-fluid" alt="Responsive Image">
      </div>
    </div>
  </div>
</div>

<h1 style="text-align: center;color: red;">FALL WINTER 2019</h1>
<?php
        if(isset($_GET['trang'])){
            $page = $_GET['trang'];
        }else {
            $page =1;
        }
        if($page == '' || $page == 1){
            $begin = 0;
        }else{
            $begin =($page*2)-2;
        }
       $sql_pro ="SELECT * FROM tbl_sanpham 
       ORDER BY id_sanpham LIMIT $begin,2";
       $query_pro = mysqli_query($mysqli,$sql_pro);
      
?>
<h3 class="text-center text-uppercase font-weight-bold">Sản phẩm mới nhất</h3>
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
$trang = ceil($row_count / 2);
?>
<p> Trang hiện tại: <?php echo $page; ?>/<?php echo $trang; ?></p>
<ul class="pagination">
    <?php
    for ($i = 1; $i <= $trang; $i++) {
    ?>
    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
        <a class="page-link" href="index.php?trang=<?php echo $i; ?>"><?php echo $i; ?></a>
    </li>
    <?php
    }
    ?>
</ul>




</body>
</html>
