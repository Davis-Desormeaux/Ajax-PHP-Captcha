<?php
session_start();
$good_captcha = $_SESSION['captcha'];
$user_captcha = !isset($_GET['usrcap'])
                ? !isset($_POST['usrcap'])
                    ? ""
                    : $_POST['usrcap']
                : $_GET['usrcap'];      
$is_valid = (empty($good_captcha) || $user_captcha != $good_captcha) ? "bad" : "valid";
header('Content-type: text/plain');
echo $is_valid;
?>