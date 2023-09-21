<?php
require_once 'connection.php';
include 'function.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == 1) {
    if (isset($_POST['buyn'])) {
        if (
            $_POST['address'] != ''
            && $_POST['fullname'] != ''
            && $_POST['pnb'] != ''
            && $_POST['email'] != ''
        ) {
            $address = $_POST['address'];
            $name = $_POST['fullname'];
            $pnb = $_POST['pnb'];
            $email = $_POST['email'];
            $id = $_POST['id'];
            $query1 = "SELECT * FROM product WHERE Product_id='$id'";
            $res1 = mysqli_query($con, $query1);
            $row1 = mysqli_fetch_assoc($res1);
            $p_qty=$row1['P_quantity'];
            if($p_qty<=0){
                $_SESSION['page'] = "home";
                redirect2("index.php", "Something Went Wrong");
            }
            else{
            $total = $row1['P_price'];
            $query2 = "INSERT INTO orders (order_id, o_status, user_id, o_address, totalprice, email, pnb,name) VALUES 
            (NULL, 'Pending', '$_SESSION[user_id]', '$address', '$total', '$email', '$pnb','$name')";
            $res2 = mysqli_query($con, $query2);
            if ($res2) {
                $query = "SELECT order_id FROM orders WHERE user_id = '$_SESSION[user_id]' ORDER BY order_id DESC;";
                $res = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($res);
                $order_id = $row['order_id'];
                $product_price = $row1['P_price'];
                $query8 = "INSERT INTO orders_details (id, order_id, product_id, product_price)
             VALUES (NULL , '$order_id', '$id', '$product_price')";
                $res8 = mysqli_query($con, $query8);
                    if($res8) {
                        $query5 = "UPDATE product SET P_quantity = $p_qty - 1 where Product_id='$id'";
                        $res5 = mysqli_query($con, $query5);
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->isHTML(true);
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'electromaniaweb3@gmail.com';
                        $mail->Password = 'nadbiskfjcbzvsng';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                        $mail->setFrom('electromaniaweb3@gmail.com', 'ElectroMania'); 
                        $mail->addAddress($email, $name);
                        $mail->Subject = 'Order Confirmation';
                        $mail->Body = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Order Confirmation</title>
                        </head>
                        <body>
                            <table style="width: 100%; max-width: 650px; margin: 0 auto; font-family: Arial, sans-serif; padding: 20px; border-collapse: collapse;">
                                <tr>
                                    <td>
                                        <h2 style="color: darkblue;">Thank you for your purchase, ' . $name . '!</h1>
                                        <p style="color: black;font-size: 12px;">We will make sure your order makes it as soon as possible.</p>
                                        <p style="color: black;font-size: 12px;"><strong>Total:</strong> ' . $total . '$</p>
                                        <p style="color: black;font-size: 12px;">Please make sure to leave your review in the contact us field, and we will be pleased to take it into consideration.</p>
                                        <p style="color: black;font-size: 12px;">Best regards,<br>Electromania team.</p>
                                    </td>
                                </tr>
                            </table>
                        </body>
                        </html>';                    
                        $mail->send();
                        $_SESSION['page'] = "home";
                        redirect("index.php", "Thank you for your order! Your Item will arrive within the next 24 hours.");
                    } else {
                        $_SESSION['page'] = "cart";
                        redirect2("productsdetails.php?id=$id", "Something Went Wrong");
                    }
                } else {
                    $_SESSION['page'] = "cart";
                    redirect2("productsdetails.php?id=$id", "Went Wrong");
                }
            }}
    } else if (isset($_POST['check'])) {
        if (
            $_POST['address'] != ''
            && $_POST['fullname'] != ''
            && $_POST['pnb'] != ''
            && $_POST['email'] != ''
        ) {
            $address = $_POST['address'];
            $name = $_POST['fullname'];
            $pnb = $_POST['pnb'];
            $email = $_POST['email'];
            $query3 = 'SELECT * FROM cart WHERE user_id= ' . $_SESSION['user_id'] . '';
            $res3 = mysqli_query($con, $query3);
            $nbr = mysqli_num_rows($res3);
            if($nbr<=0){
                $_SESSION['page']='home';
                redirect2("index.php", "Something Went Wrong");
            }else{
            $total = 0;
            $array1 = [];
            $array2 = [];
            $array3 = [];
            for ($i = 0; $i < $nbr; $i++) {
                $row3 = mysqli_fetch_assoc($res3);
                $qty = $row3['quantity'];
                $array1[$i] = $row3['product_id'];
                $query4 = 'SELECT * FROM product WHERE Product_id= ' . $row3['product_id'] . '';
                $res4 = mysqli_query($con, $query4);
                $row4 = mysqli_fetch_assoc($res4);
                $p_qty=$row4['P_quantity'];
                $array2[$i] = $row4['P_price'];
                $array3[$i] = $qty;
                $query5 = "UPDATE product SET P_quantity = $p_qty-$qty where Product_id='$row3[product_id]'";
                $res5 = mysqli_query($con, $query5);
                $unitprice = $row4['P_price'];
                $price = $qty * $unitprice;
                $total = $total + $price;
            }
            $query6 = "INSERT INTO orders (order_id, o_status, user_id, o_address, totalprice, email, pnb, name)
        VALUES (NULL, 'Pending', '$_SESSION[user_id]', '$address', '$total','$email','$pnb','$name');";
            $res6 = mysqli_query($con, $query6);
            if ($res6) {
                $query = "SELECT order_id FROM orders WHERE user_id = '$_SESSION[user_id]' ORDER BY order_id DESC;";
                $res = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($res);
                $order_id = $row['order_id'];
                for ($i = 0; $i < $nbr; $i++) {
                    $query = "INSERT INTO orders_details (id, order_id,product_id,product_price,quantity)
                VALUES (NULL, '$order_id ', '$array1[$i]', '$array2[$i]','$array3[$i]') ";
                    $res = mysqli_query($con, $query);
                }
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->isHTML(true);
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'electromaniaweb3@gmail.com';
                $mail->Password = 'nadbiskfjcbzvsng';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('electromaniaweb3@gmail.com', 'ElectroMania'); 
                $mail->addAddress($email, $name);
                $mail->Subject = 'Order Confirmation';
                $mail->Body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Order Confirmation</title>
                </head>
                <body>
                    <table style="width: 100%; max-width: 650px; margin: 0 auto; font-family: Arial, sans-serif; padding: 20px; border-collapse: collapse;">
                        <tr>
                            <td>
                                <h2 style="color: darkblue;">Thank you for your purchase, ' . $name . '!</h1>
                                <p style="color: black;font-size: 12px;">We will make sure your order makes it as soon as possible.</p>
                                <p style="color: black;font-size: 12px;"><strong>Total:</strong> ' . $total . '$</p>
                                <p style="color: black;font-size: 12px;">Please make sure to leave your review in the contact us field, and we will be pleased to take it into consideration.</p>
                                <p style="color: black;font-size: 12px;">Best regards,<br>Electromania team.</p>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>';   
                $mail->send();
                $query7 = "DELETE FROM cart where user_id = $_SESSION[user_id] ";
                $res7 = mysqli_query($con, $query7);
                $_SESSION['page'] = "home";
                unset($_POST);
                redirect("index.php", "Thank you for your order! It will arrive within the next 24 hours.");

            } else {
                redirect2("checkout1.php", "Something Went Wrong");
            }
        }
    }}
} else {
    header("Location:index.php");
}
