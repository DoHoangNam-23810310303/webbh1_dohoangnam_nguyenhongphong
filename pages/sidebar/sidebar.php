<style>
    .sidebardanhmuc {
    background-color: #f4f4f4;
    padding: 15px;
    border-radius: 5px;
}
</style>
<div class="sidebardanhmuc">
<h4 >Đăng bài viết</h4>
    <ul class="list_sidebar">
    <li style="text-transform: uppercase;"><a href="index.php?quanly=dangbai"  style="color: darkblue;">Đăng bài</a></li>
    </ul>
    <?php
    if(isset($_SESSION['dangky'])){
                 ?>
    <ul class="list_sidebar">
    <li style="text-transform: uppercase;"><a href="index.php?quanly=quanlybaidang"  style="color: darkblue;">Trạng thái bài đăng</a></li>
    </ul>
    <?php
    }
?>
   <h4 >Tin tức</h4>
           <ul class="list_sidebar">
           <?php
                $sql_danhmuc_bv ="SELECT * FROM tbl_danhmucbaiviet ORDER BY id_danhmucbaiviet DESC";
                $query_danhmuc_bv = mysqli_query($mysqli,$sql_danhmuc_bv);
                while($row = mysqli_fetch_array($query_danhmuc_bv)){
            ?>
                <li style="text-transform: uppercase;"><a href="index.php?quanly=danhmucbaiviet&id=<?php echo $row['id_danhmucbaiviet'] ?>" style="color: darkblue;"><?php echo $row['tendanhmucbaiviet'] ?></a></li>
                <?php
                }
                ?>
            </ul>
   <h4 >Sản phẩm</h4>
           <ul class="list_sidebar">
           <?php
                $sql_danhmuc ="SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
                while($row = mysqli_fetch_array($query_danhmuc)){
            ?>
                <li style="text-transform: uppercase;"><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row['id_danhmuc'] ?>" style="color: darkblue;"><?php echo $row['tendanhmuc'] ?></a></li>
                <?php
                }
                ?>
            </ul>
</div>
