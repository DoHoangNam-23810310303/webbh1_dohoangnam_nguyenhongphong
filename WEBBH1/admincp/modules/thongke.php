<?php
use Carbon\Carbon;
include('../config/config.php');
require('../../carbon/autoload.php');

if(isset($_POST['thoigian'])){
    $thoigian = $_POST['thoigian'];
} else {
    $thoigian = '';
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->format('Y-m-d');
}

if($thoigian == '7ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->format('Y-m-d');
} elseif($thoigian == '28ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->format('Y-m-d');
} elseif($thoigian == '90ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->format('Y-m-d');
} elseif($thoigian == '365ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->format('Y-m-d');
}

$now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

// Thong ke truc tiep tu don hang thay vi bang tong hop tbl_thongke
$sql = "
    SELECT 
        DATE(c.thoigian) AS ngaydat,
        COUNT(DISTINCT c.code_cart) AS donhang,
        COALESCE(SUM(d.soluongmua * s.giasp), 0) AS doanhthu,
        COALESCE(SUM(d.soluongmua), 0) AS soluongban
    FROM tbl_cart c
    LEFT JOIN tbl_cart_details d ON c.code_cart = d.code_cart
    LEFT JOIN tbl_sanpham s ON d.id_sanpham = s.id_sanpham
    WHERE DATE(c.thoigian) BETWEEN '$subdays' AND '$now'
    GROUP BY DATE(c.thoigian)
    ORDER BY DATE(c.thoigian) ASC
";
$sql_query = mysqli_query($mysqli, $sql);

$chart_data = array();

while($val = mysqli_fetch_array($sql_query)){
    $chart_data[] = array(
        'date' => $val['ngaydat'],
        'order' => $val['donhang'],
        'sales' => $val['doanhthu'],
        'quantity' => $val['soluongban']
    );
}

echo json_encode($chart_data);
?>
