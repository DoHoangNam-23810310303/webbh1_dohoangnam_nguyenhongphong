<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/khoahoc.css">
    <link rel="stylesheet" href="css/tintuc.css">
    <link rel="stylesheet" href="css/sachattt.css">
    <link rel="stylesheet" href="css/tailieu.css">
    <link rel="stylesheet" href="css/congdong.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>MENITURE</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
       <?php
        session_start();
        include("admincp/config/config.php");
        include("pages/header.php");
        include("pages/menu.php");
        include("pages/main.php");
        include("pages/footer.php");
       ?>
       </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
       // Show the first tab and hide the rest
            $('#tabs-nav li:first-child').addClass('active');
            $('.tab-content').hide();
            $('.tab-content:first').show();

            // Click function
            $('#tabs-nav li').click(function(){
            $('#tabs-nav li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').hide();
            
            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn();
            return false;
            });
    </script>
     <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" 
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AQ4fw9jZY85M-VSuMXei1ihLIKAJfyuJC_lg44cKbigKxZDtOQvFHVoPHpkTl-_32aqVfK3MVikctXxV&currency=USD"></script>
    <script>
        paypal.Buttons({
            createOrder:function(data, actions){
                var tongtien = document.getElementById('tongtien').value;
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: tongtien
                        }
                    }]
                });
            },
     onApprove: function(data, actions){
        return actions.order.capture().then(function(orderData){
            actions
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            var transaction = orderData.purchase_units[0].payments.captures[0];
            alert('Transaction '+ transaction.status + ': '+transaction.id + '\n\nThanh toán thành công');
            window.location.replace('http://localhost/SECURITY/index.php?quanly=camon&thanhtoan=paypal')
        });
     },
     onCancle:function(data){
        window.location.replace('http://localhost/SECURITY/index.php?quanly=thongtinthanhtoan')
     }
        }).render('#paypal-button');
    </script>
     <script>
    ClassicEditor
        .create( document.querySelector( '#tomtat' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#noidung' ) )
        .catch( error => {
            console.error( error );
    } );
    </script>
     <script>
                    $(document).ready(function() {
                var menu = $('.navbar');
                var menuPosition = menu.offset().top;

                $(window).scroll(function() {
                    if($(this).scrollTop() > menuPosition) {
                        menu.addClass('fixed-menu');
                    } else {
                        menu.removeClass('fixed-menu');
                    }
                });
            });

    </script>
    <script>jQuery(document).ready(function ($) {

$('#checkbox').change(function(){
  setInterval(function () {
      moveRight();
  }, 6000);
});

  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
  $('#slider ul li:last-child').prependTo('#slider ul');

  function moveLeft() {
      $('#slider ul').animate({
          left: + slideWidth
      }, 200, function () {
          $('#slider ul li:last-child').prependTo('#slider ul');
          $('#slider ul').css('left', '');
      });
  };

  function moveRight() {
      $('#slider ul').animate({
          left: - slideWidth
      }, 200, function () {
          $('#slider ul li:first-child').appendTo('#slider ul');
          $('#slider ul').css('left', '');
      });
  };

  $('a.control_prev').click(function () {
      moveLeft();
  });

  $('a.control_next').click(function () {
      moveRight();
  });

});    
</script>
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

</body>
</html>