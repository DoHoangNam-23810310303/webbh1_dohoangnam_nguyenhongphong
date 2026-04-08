<?php
include('../../config/config.php');
       if(isset($_GET['idbl'])){
      $id = $_GET['idbl'];
      $sql = "SELECT * FROM tbl_comment WHERE id_comment = '$id' LIMIT 1";
      $query = mysqli_query($mysqli,$sql);
      while($row = mysqli_fetch_array($query)){
         unlink('../../../anhcm/'.$row['hinhanh']);
      }
      $sql_xoa = "DELETE FROM tbl_comment WHERE id_comment='".$id."'";
      mysqli_query($mysqli,$sql_xoa);
      header('location:../../index.php?action=quanlybinhluan&query=lietke');
}elseif(isset($_GET['idblbd'])){
      $idblbd = $_GET['idblbd'];
      $sql_xoa_blbd = "DELETE FROM comments WHERE id='".$idblbd."'";
        mysqli_query($mysqli,$sql_xoa_blbd);
        $sql_xoa_blbd_replies = "DELETE FROM comment_replies WHERE comment_id='".$idblbd."'";
        mysqli_query($mysqli,$sql_xoa_blbd_replies);
        header('location:../../index.php?action=quanlybinhluan&query=lietke');
}elseif(isset($_GET['idreplies'])){
      $idreplies = $_GET['idreplies'];
      $sql_xoa_blbd_replies = "DELETE FROM comment_replies WHERE id='".$idreplies."'";
        mysqli_query($mysqli,$sql_xoa_blbd_replies);
        header("Location: ../../index.php?action=quanlybinhluan&query=xembinhluan&idbl=$idreplies");
}
?>
