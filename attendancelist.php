<?php
    session_start();
    sleep(5);
    header('Content-Type: application/json; charset=utf-8');
    if ( !isset($_SESSION['attendance']) ) $_SESSION['attendance'] = array();
    echo(json_encode($_SESSION['attendance'], JSON_PRETTY_PRINT));
?>
