<h3 style="text-align: center;text-transform: uppercase;font-weight: bold;">Kết Nối Với Chúng Tôi - Khám Phá Một Thế Giới Bảo Mật An Toàn Thông Tin!</h3>
<?php
 $sql_lh = "SELECT * FROM tbl_lienhe ORDER BY id_lienhe";
 $query_lh =   mysqli_query($mysqli,$sql_lh);
?>
<?php
  $sql_tt =mysqli_query($mysqli,"SELECT * FROM tbl_lh ORDER BY id_lh");
  $range = mysqli_fetch_array($sql_tt);
?>

  <!DOCTYPE html>
<html lang="en">
<style>
      :root {
    --primary-color: #f2726a;
}
body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

#doc {
    width: 80%; 
            max-width: 1200px; 
            margin: 0 auto; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh; 
}
.card {
    background: #f2f2f2;
    width: 300px;
    height: auto;
    border-radius: 10px;
    text-align: center;
    overflow: hidden;
    margin: 0 20px;
}

.img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    object-position: center;
}

.card_img {
    width: 120px;
    height: 120px;
    border: 4px solid var(--primary-color);
    border-radius: 50%;
    overflow: hidden;
    margin: 0px auto;
    transform: translateY(25px);
    transition: 0.5s;
}

.card h2 {
    margin-top: 35px;
    color: #000;
}

.card_img:hover {
    width: 100%;
    height: 150%;
    border-radius: unset;
    transform: unset;
    border: none;
}

.card p {
    color: var(--primary-color);
}

.social {
    margin: 25px;
}

.social a {
    margin: 20px;
    color: darkblue;
    font-size: 15px;
}

.social a:hover {
    color:  #007FFF;
}

.card button {
    width: 150px;
    height: 40px;
    border: 1px solid var(--primary-color);
    background: transparent;
    color: black;
    border-radius: 10px;
    transition: 0.5s;
}

.card button:hover {
    background: #f2726a;
}

#doc {
    display: flex;
}

@media screen and (max-width: 460px) {
    #doc {
        display: block;
        margin: auto;
    }
    .card {
        margin: 80px 0px;
    }
}
.contact-section {
      padding: 10px 0;
      background-color: #fff;
    }
    .contact-section h2 {
      font-size: 36px;
      margin-bottom: 40px;
      text-align: center;
    }
    .contact-info {
      text-align: center;
    }
    .contact-info p {
      margin-bottom: 20px;
    }
    .contact-info i {
      font-size: 24px;
      margin-right: 10px;
      color: #007bff;
    }

</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
</head>

<body>     
<div class="container mt-5">
    <div class="row">
      <div class="col-lg-12 ">
        <div class="text-center mb-4">
          <p style="text-align: justify;font-size: 18px;">
          Đội ngũ của chúng tôi không chỉ là giảng viên, họ là những người dẫn dắt, những chuyên gia có kinh nghiệm thực tiễn trong ngành. Hãy liên hệ với chúng tôi, chúng tôi luôn sẵn lòng lắng nghe và hỗ trợ bạn trên hành trình của mình. Khám phá cùng chúng tôi, để bảo mật và an toàn thông tin không còn là điều xa xỉ, mà trở thành một kiến thức thú vị và có ý nghĩa hơn bao giờ hết! Hãy gửi tin nhắn cho chúng tôi ngay hôm nay. Chúng tôi sẵn lòng đồng hành cùng bạn!
          </p>
        </div>
      </div>
    </div>
</div>
<section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="contact-info">
            <p><i class="fas fa-map-marker-alt"></i> <?php echo $range ['duong'] ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $range ['sdt'] ?></p>
            <p><i class="fas fa-envelope"></i> <?php echo $range ['mail'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
    <h3 style="text-align: center;color: violet; padding:10px 0px">Đội ngũ nhân viên</h3>
    <div id="doc">
        <?php
    while ($dong = mysqli_fetch_array($query_lh)){
        ?> 
        <div class="card">
            <div class="card_img">
                <img src="admincp/modules/thongtinweb/uploads/<?php echo $dong['hinhanh'] ?>" alt="" width="100%">
            </div>
            <h2><?php echo $dong['tenlienhe'] ?></h2>
            <p><?php echo $dong['chuyennganh'] ?></p>
            <div class="social">
                <a href="<?php echo $dong['facebook'] ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="<?php echo $dong['youtube'] ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <a href="<?php echo $dong['instagram'] ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?php echo $dong['github'] ?>" target="_blank"><i class="fa-brands fa-github"></i></a>
            </div>
            <a href="#/"><button>Contact Me</button></a>
        </div>
        <?php
    }
?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="../Script/index.js"></script>

</html>