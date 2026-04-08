<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php
      $sql_pro_bd = "SELECT * FROM tbl_dangbai, tbl_dangky WHERE tbl_dangbai.id_user = tbl_dangky.id_dangky
       AND tbl_dangbai.id_baidang = '$_GET[id]' LIMIT 1";

       $query_pro_bd = mysqli_query($mysqli,$sql_pro_bd);
       $row_bd_title = mysqli_fetch_array($query_pro_bd);
       
?>
<b><?php echo  $row_bd_title['tenkhachhang']  ?></b>: <?php echo  $row_bd_title['thoigian']  ?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                    <h3  style="text-align: center; text-transform: uppercase; display: flex; justify-content: center;" >
                       <?php echo $row_bd_title['tenbaidang'] ?>
                    </h3>
                    </div>
                    <div class="card-body">
                    <?php echo $row_bd_title['noidung'] ?>
                    </div>
                    <div class="card-body">
                    <img src="uploads/<?php echo $row_bd_title['hinhanh'] ?>" alt=""style="width: 150px;"> 
                    </div>
                  </div>
            </div>
        </div>
    </div>
 </div>
<div class="py-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                  <div class="card">
                    <div class="card-header">
                        <h4 style="text-align: center;">Bình luận</h4>
                    </div>
                    <div class="card-body">
                        <div class="main-comment">
                        <div id="error_status"></div>
                            <textarea  class="comment_textbox form-control mb-1" rows="2"></textarea>
                            <button type="button" class="btn btn-primary add_comment_btn">Comment</button>
                            <hr>
                            <div class="comment-container">
                             
                            </div>
                        </div>

                    </div>
                  </div>
            </div>
        </div>
    </div>
 </div>
 <script>
function load_comment() {
        $.ajax({
            type: "POST",
            url: "pages/main/code.php",
            data: {
                'comment_load_data': true,
                'post_id': <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                $('.comment-container').html("");
                $.each(response, function(key, value) {
                    $('.comment-container').append('\
                    <div class="reply_box border p-2 mb-2">\
                        <h6 class="border-bottom d-inline">' + value.user['tenkhachhang'] +
                        ' : ' + value.cmt['time'] +
                        ' </h6>\
                        <p class="para">' + value.cmt['msg'] +
                        ' </p>\
                        <button value="' + value.cmt['id'] +
                        '" class="badge btn btn-warning text-dark reply_btn">Reply</button>\
                        <button  value="' + value.cmt['id'] +
                        '" class="badge btn btn-danger view_reply_btn">View Replies</button>\
                        <div class="ml-4 reply_section"></div>\
                    </div>');
                });
            }
        });
    }
$(document).ready(function() {
        load_comment();
});

$(document).on('click', '.reply_btn', function() {

var thisClicked = $(this);
var cmt_id = thisClicked;


$('.reply_section').html("");
thisClicked.closest('.reply_box').find('.reply_section').html('\
                <input type="text" class="reply-msg form-control my-2" placeholder="Reply">\
                <div class="text-end">\
                    <div class="btn btn-sm btn-primary reply_add_btn">Reply</div>\
                    <div class="btn btn-sm btn-danger reply_cancel_btn">Cancel</div>\
                </div>');

});
$(document).on('click', '.reply_cancel_btn', function() {
        $('.reply_section').html("");
    });


$(document).on('click', '.reply_add_btn', function(e) {
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.closest('.reply_box').find('.reply_btn').val();
        var reply = thisClicked.closest('.reply_box').find('.reply-msg').val();

        var data = {
            'comment_id': cmt_id,
            'reply_msg': reply,
            'add_reply': true
        };

        $.ajax({
            type: "POST",
            url: "pages/main/code.php",
            data: data,
            success: function(response) {
                alert(response);
            }
        });
    });


$(document).on('click', '.view_reply_btn', function(e) {
    e.preventDefault();

    var thisClicked = $(this);
    var cmt_id = thisClicked.val();

    var commentContainer = thisClicked.closest('.reply_box').find('.reply_section');

    $.ajax({
        type: "POST",
        url: "pages/main/code.php",
        data: {
            'cmt_id': cmt_id,
            'view_comment_data': true
        },
        success: function(response) {
            commentContainer.html("");
            $.each(response, function(key, value) {
                commentContainer.append('\
                <div class="sub_reply_box border-bottom p-2 mb-2">\
                <input type="hidden" class="get_username" value="' + value.user['tenkhachhang'] +
                            '"/>\
                    <h6 class="border-bottom d-inline">' + value.user['tenkhachhang'] +
                    ' : ' + value.cmt['time'] +
                    ' </h6>\
                    <p class="para">' + value.cmt['reply_msg'] +
                    ' </p>\
                    <button value="' + value.cmt['comment_id'] +
                            '" class="badge btn btn-warning text-dark sub_reply_btn">Reply</button>\
                    <div class="ml-4 sub_reply_section"></div>\
                </div>');
            });
        }
    });
});



$(document).on('click', '.sub_reply_btn', function(e) {
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.val();
        var username = thisClicked.closest('.sub_reply_box').find('.get_username').val();
        $('.sub_reply_section').html("");
        thisClicked.closest('.sub_reply_box').find('.sub_reply_section').append('<div>\
                    <input type="text" value="@' +
            username + '" class="sub_reply_msg form-control my-2" placeholder="Your Reply">\
                </div>\
                <div class="text-end">\
                        <button class="btn btn-sm btn-primary text-dark sub_reply_add_btn">Reply</button>\
                        <button class="btn btn-sm btn-danger text-dark sub_reply_cancel_btn">Cancel</button>\
                    </div>\
                    ');
    });


$(document).on('click', '.sub_reply_add_btn', function(e) {
        e.preventDefault();
        var thisClicked = $(this);
        var cmt_id = thisClicked.closest('.sub_reply_box').find('.sub_reply_btn').val();
        var reply = thisClicked.closest('.sub_reply_box').find('.sub_reply_msg').val();
        var data = {
            'cmt_id': cmt_id,
            'reply_msg': reply,
            'add_subreplies': true
        }
        $.ajax({
            type: "POST",
            url: "pages/main/code.php",
            data: data,
            success: function(response) {
                $('.reply_section').html("")
                alert(response);
            }
        });
});

$(document).on('click', '.sub_reply_cancel_btn', function(e) {
        e.preventDefault();
        $('.sub_reply_section').html("");

});


$('.add_comment_btn').click(function(e) {
    e.preventDefault();

    var msg = $('.comment_textbox').val();
    if ($.trim(msg).length == 0) {
        var error_msg = 'Please type a comment';
        $('#error_status').text(error_msg);
    } else {
        var error_msg = '';
        $('#error_status').text(error_msg);

        var data = {
            'msg': msg,
            'add_comment': true,
            'post_id': <?php echo $_GET['id']; ?> 
        };

        $.ajax({
            type: "POST",
            url: "pages/main/code.php",
            data: data,
            success: function(response) {
                alert(response);
                load_comment();
            }
        });
    }
});

</script>