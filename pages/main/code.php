<?php
include("../../admincp/config/config.php");
include("../../carbon/autoload.php");
session_start();
use Carbon\Carbon;
$now = Carbon::now('Asia/Ho_Chi_Minh');
$now->format('Y-m-d H:i:s');
if(isset($_POST['add_subreplies'])){
    $cmt_id = $_POST['cmt_id'];
    $reply_msg = $_POST['reply_msg'];
    if(isset($_SESSION['id_khachhang'])) {
      $user_id = $_SESSION["id_khachhang"];
    $query = "INSERT INTO comment_replies (user_id, comment_id, reply_msg,time) VALUES ('$user_id', '$cmt_id', '$reply_msg','$now')";
      $query_run = mysqli_query($mysqli, $query);
  
      if ($query_run) {
          echo "Trả lời bình luận người dùng thành công";
      } else {
          echo "Đã xảy ra lỗi";
      }
  } else {
      echo "Vui lòng đăng nhập để thêm bình luận hoặc trả lời.";
      exit(); 
  }
  }

if (isset($_POST["comment_load_data"])) {
    $post_id = $_POST['post_id'];

    // Lấy danh sách comment dựa trên post_id chỉ định
    $comment_query = "SELECT * FROM comments , tbl_dangky  WHERE comments.user_id = tbl_dangky.id_dangky AND comments.post_id = '$post_id' ORDER BY comments.id DESC   ";
    $run_comment_query = mysqli_query($mysqli, $comment_query);

    $array_result = [];
    if ($run_comment_query) {
        while ($row = mysqli_fetch_assoc($run_comment_query)) {
            array_push($array_result, ['cmt' => $row, 'user' => $row]);
        }

        header('Content-type: application/json');
        echo json_encode($array_result);
    } else {
        echo "Đưa ra nhận xét";
    }
}

if(isset($_POST["view_comment_data"])){
    $cmt_id = $_POST["cmt_id"];
    $query = "SELECT * FROM comment_replies , tbl_dangky WHERE comment_replies.user_id = tbl_dangky.id_dangky AND comment_id='$cmt_id'";
    $qr_run = mysqli_query($mysqli, $query);

    $result_array = [];
    if(mysqli_num_rows($qr_run) > 0){
        while($row = mysqli_fetch_assoc($qr_run)){
            array_push($result_array,['cmt'=>$row, 'user'=> $row]);
        }
        header('Content-type:application/json');
        echo json_encode($result_array);
    }else{
        echo "Không tìm thấy câu trả lời nào";
    }
}


if (isset($_POST['add_reply'])) {
    $cmt_id = $_POST['comment_id']; 
    $reply = $_POST['reply_msg']; 
    if(isset($_SESSION['id_khachhang'])) {
    $user_id = $_SESSION['id_khachhang'];
    $query = "INSERT INTO comment_replies (user_id, comment_id, reply_msg,time) VALUES ('$user_id', '$cmt_id', '$reply','$now')";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        echo "Trả lời bình luận thành công";
    } else {
        echo "Đã xảy ra lỗi";
    }
} else {
  
    echo "Vui lòng đăng nhập để thêm bình luận hoặc trả lời.";
    exit(); 
}
}
if(isset($_POST["add_comment"])){
    $msg = $_POST["msg"];
    $post_id = $_POST["post_id"];
    if(isset($_SESSION['id_khachhang'])) {
        $user_id = $_SESSION["id_khachhang"];
    $comment = "INSERT INTO comments (user_id,post_id, msg,time) VALUES ('$user_id','$post_id', '$msg','$now')";
    $run = mysqli_query($mysqli, $comment);
    if($run){
        echo "Đã thêm bình luận thành công";
    } else {
        echo "Bình luận không được thêm thành công";
    }
} else {
   
    echo "Vui lòng đăng nhập để thêm bình luận hoặc trả lời.";
    exit(); 
}
}
?>
