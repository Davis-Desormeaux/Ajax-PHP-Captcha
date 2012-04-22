<?php
session_start();
$good_captcha = $_SESSION['captcha'];
$user_captcha = $_GET['usrcap'];

$is_valid = ( empty($good_captcha) || $user_captcha != $good_captcha) ? "false" : "true";
echo $is_valid;
?>