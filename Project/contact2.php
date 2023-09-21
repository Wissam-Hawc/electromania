       <?php 
        
        require_once 'connection.php';
        include 'function.php';
        session_start() ?>
        <?php


        if (isset($_POST['check']) && $_POST['check']=="yes") { 

                $fname = $_POST['fullname'];
                $email = $_POST['email'];
                $pnb = $_POST['pnb'];
                $msg = $_POST['text'];
                $query = "INSERT INTO contact (fullname, email, pnb, msg) VALUES ('$fname', '$email',
                '$pnb', '$msg')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    $_SESSION['page']='home';
                    redirect("index.php", "Your Message Has Been Sent!");
                }
                else{
                    $_SESSION['page']='contact';
                    redirect2("contact.php", "Something went wrong");

                }
            }
            else{
                header("Location:index.php");
            }
        

        ?>