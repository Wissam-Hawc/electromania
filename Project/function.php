<?php
// for success messages
    function redirect($url, $message){
    $_SESSION['message']=$message;
    header('location:'.$url);
    exit();
    }
// for failed messages
    function redirect2($url, $message){
    $_SESSION['message2']=$message;
    header('location:'.$url);
    exit();
    }
?>