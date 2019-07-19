
<?php
    session_start();

    $currentTime = date("H:i:s", strtotime('-1 hour'));
    $start = microtime(true);

    $x = (int) str_replace(",", ".", $_POST['x_value']);
    $y = (float) $_POST['y_value'];
    $r = (double) $_POST['r_value'];

    if (!in_array($x, array(-4, -3, -2, -1, 0, 1, 2, 3, 4)) || !is_numeric($y) || $y < -3 || $y > 5 || !in_array($r, array( 1, 1.5, 2, 2.5, 3))) {
        http_response_code(400);
        return;
    }

    function check($x, $y, $r){
        if (($x >= -$r/2 && $x <= 0 && $y <= $r && $y >= 0) || ($y >= (-$x/2 - $r/2) && $y <= 0 && $x <= 0) || (($x*$x + $y*$y) <= $r*$r && $x >= 0 && $y >= 0)){
            return "<span style='color: green'>True</span>";
        } else {
            return "<span style='color: red'>False</span>";
        }
    }

    $res = check ($x, $y, $r);
    $time = microtime(true) - $start;
    $result = array($x, $y, $r, $res, $currentTime, $time);
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = array();
    }

    array_push($_SESSION['history'], $result);

    include "table.php";
