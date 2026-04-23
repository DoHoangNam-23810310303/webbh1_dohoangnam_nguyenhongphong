<?php
require('../carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('Asia/Ho_Chi_Minh');

printf("Now: %s", $now->format('Y-m-d H:i:s'));


// $oneDay = CarbonInterval::day();

// printf("1 day: %s", $oneDay->forHumans());
?>
