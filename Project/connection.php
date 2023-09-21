<?php 
$db_hostname='localhost';
$db_database='electromania3';
$db_username='root';
$db_password='';
$con=mysqli_connect($db_hostname,$db_username, $db_password, $db_database);
if(mysqli_connect_errno()){
    echo "failed to connect";
}
?>