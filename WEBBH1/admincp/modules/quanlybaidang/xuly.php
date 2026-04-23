<?php
require('../../../carbon/autoload.php');
include('../../config/config.php');
use Carbon\Carbon;

$now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

if(isset($_GET['tinhtrang']) && isset($_GET['id'])){
    $tinhtrang = $_GET['tinhtrang'];
    $id = $_GET['id'];

    $sql = "UPDATE tbl_dangbai SET tinhtrang = '$tinhtrang' WHERE id_baidang = '$id'";
    $sql_query = mysqli_query($mysqli, $sql);
    header('location:../../index.php?action=quanlybaidang&query=lietke');
}
?>