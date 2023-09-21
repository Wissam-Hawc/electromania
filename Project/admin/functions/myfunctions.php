<?php
require_once '../connection.php';
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
// to not repeat the query every time
    function getAll($table){
    global $con;
    $query="SELECT * FROM $table";
    $res=mysqli_query($con,$query);
    return $res;
    }

    function getById($table,$id){
    global $con;
    $query="SELECT * FROM $table WHERE id='$id'";
    $res=mysqli_query($con,$query);
    return $res;
    }

?>