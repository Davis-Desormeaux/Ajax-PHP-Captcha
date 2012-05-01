<?php

// Suspicious payloads receives a 400.
if (isset($_REQUEST['_SESSION'])) {
  header('HTTP/1.0 400 Bad Request'); 
  die('400 Bad Request'); 
}
session_start();

$good_captcha = $_SESSION['captcha']; // The server generated Captcha.

$user_captcha = !isset($_GET['usrcap'])    // Check for a GET Request.
                ? !isset($_POST['usrcap']) // Else it could be a POST. 
                    ? null                 // Nope, so let it be null.
                    : $_POST['usrcap']     // ...But on the other side
                : $_GET['usrcap'];         // we can take what is sent.

// The empty() check guarantees that a Captcha was rendered. If not, it's a bad one...
$is_valid = (empty($good_captcha) || $user_captcha != $good_captcha) ? "bad" : "valid";

header('Content-type: text/plain');
echo $is_valid;
