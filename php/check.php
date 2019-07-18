
<?php
    session_start();

    $currentTime = date("H:i:s", strtotime('-1 hour'));
    $start = microtime(true);
    $x = (float) str_replace(",", ".", $_POST['x_value']);
    $y = (int) $_POST['y_value'];
    $r = (int) $_POST['r_value'];

    function check($x, $y, $r){
        return true;
    }
//    if (!in_array($y, array(-5, -4, -3, -2, -1, 0, 1, 2, 3)) || !is_numeric($x) || $x < -3 || $x > 5 || !in_array($r, array( -3, -2, -1, 0, 1, 2, 3, 4, 5))) {
//        http_response_code(400);
//        return;
//    }
    $res = check ($x, $y, $r);
    $time = microtime(true) - $start;
    $result = array($x, $y, $r, $res, $currentTime, $time);
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = array();
    }

    array_push($_SESSION['history'], $result);

    include "table.php";
