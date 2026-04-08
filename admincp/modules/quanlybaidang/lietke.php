<div class="quanlybaidang">
<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Bài đăng chờ duyệt</h3>
<?php
 $sql_lietke_bd = "SELECT * FROM tbl_dangbai,tbl_dangky WHERE tbl_dangbai.id_user = tbl_dangky.id_dangky ORDER BY tbl_dangbai.id_baidang DESC";
 $query_lietke_bd =   mysqli_query($mysqli,$sql_lietke_bd);
?>

<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên người đăng</th>
    <th>Tên bài đăng</th>
    <th>Ngày đăng</th>
    <th>Tình trạng</th>
    <th>Quyết định</th>
    <th>Quản lý</th>
  </tr>
  <?php 
    $i=0;
    while($row = mysqli_fetch_array($query_lietke_bd)){
      $i++;
      if($row['tinhtrang'] == '1'){  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['tenkhachhang'] ?></td> 
    <td><?php echo $row['tenbaidang'] ?></td> 
    <td><?php echo $row['thoigian'] ?></td>
    <td>Chờ xét duyêt</td>
    <td>
        <?php
            echo '<a class="btn btn-info" href="modules/quanlybaidang/xuly.php?tinhtrang=0&id='.$row['id_baidang'].'">Duyệt bài viết</a>|| <a class ="btn btn-primary" href="modules/quanlybaidang/xuly.php?tinhtrang=2&id='.$row['id_baidang'].'">Hủy bài viết</a>';
        ?>
    </td>
    <td> <a  class="btn btn-success" href="index.php?action=quanlybaidang&query=xembaidang&id=<?php echo  $row['id_baidang']?>">Xem bài đăng</a></td>
  </tr>
 
  <?php }} ?>
</table>
</div>
<div class="quanlybaidang">
<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Bài đăng đã duyệt</h3>
<?php
 $sql_lietke_da_duyet = "SELECT * FROM tbl_dangbai,tbl_dangky WHERE tbl_dangbai.id_user = tbl_dangky.id_dangky AND tbl_dangbai.tinhtrang = '0' ORDER BY tbl_dangbai.id_baidang DESC";
 $query_lietke_da_duyet =   mysqli_query($mysqli,$sql_lietke_da_duyet);
?>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên người đăng</th>
    <th>Tên bài đăng</th>
    <th>Ngày đăng</th>
    <th>Tình trạng</th>
    <th>Quản lý</th>
  </tr>
  <?php 
    $i=0;
    while($row_dd = mysqli_fetch_array($query_lietke_da_duyet)){
      $i++;
      if($row_dd['tinhtrang'] == '0'){  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row_dd['tenkhachhang'] ?></td> 
    <td><?php echo $row_dd['tenbaidang'] ?></td> 
    <td><?php echo $row_dd['thoigian'] ?></td>
    <td>Đã duyệt</td>
    <td> <a  class="btn btn-success"  href="index.php?action=quanlybaidang&query=xembaidang&id=<?php echo  $row_dd['id_baidang']?>">Xem bài đăng</a></td>
 
  <?php }} ?>
</table>
</div>
<div class="quanlybaidang">
<h3  style="text-align: center;text-transform: uppercase;font-weight: bold;">Bài đăng đã hủy</h3>
<?php
 $sql_lietke_da_huy = "SELECT * FROM tbl_dangbai,tbl_dangky WHERE tbl_dangbai.id_user = tbl_dangky.id_dangky AND tbl_dangbai.tinhtrang = '2' ORDER BY tbl_dangbai.id_baidang DESC";
 $query_lietke_da_huy =   mysqli_query($mysqli,$sql_lietke_da_huy);
?>
<table style="width: 100%;" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID</th>
    <th>Tên người đăng</th>
    <th>Tên bài đăng</th>
    <th>Ngày đăng</th>
    <th>Tình trạng</th>
    <th>Quản lý</th>
  </tr>
  <?php 
    $i=0;
    while($row_dh = mysqli_fetch_array($query_lietke_da_huy)){
      $i++;
      if($row_dh['tinhtrang'] == '2'){  
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row_dh['tenkhachhang'] ?></td> 
    <td><?php echo $row_dh['tenbaidang'] ?></td> 
    <td><?php echo $row_dh['thoigian'] ?></td>
    <td>Đã hủy bài viết</td>
    <td>
    <a  class="btn btn-success" href="index.php?action=quanlybaidang&query=xembaidang&id=<?php echo  $row_dh['id_baidang']?>">Xem bài đăng</a>
    </td>
  </tr>
 
  <?php }} ?>
</table>
</div>
<style>
    div.quanlybaidang{
        padding: 100px 0px;
    }
</style>