<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Get in touch with our charity to learn more, ask questions, or discuss partnership opportunities. Contact us through our provided email address or by filling out the contact form on our website. We look forward to hearing from you and working together towards our shared goals.">
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/alertbt.css">
    <style>
        .map-container {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .map {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 100%;
            /* Set an appropriate aspect ratio for the map container */
        }

        .map iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container5 {
            width: 90%;
            max-width: 900px;
            /* Adjust the max-width as needed */
            margin: 100px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            padding: 20px;
        }

        .form-wrapper {
            width: 100%;
            padding: 40px;
        }

        .form-wrapper h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0056b3;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            letter-spacing: 1px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 3px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="tel"]:focus,
        .form-group textarea:focus {
            border-color: #3e8da8;
        }
        .form-group.success input {
    border-color: #09c372;
    }

        .form-group.error input[type="text"],
        .form-group.error input[type="email"],
        .form-group.error input[type="tel"]{
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 3px;
            transition: border-color 0.3s ease;
           border-color: #ff3860;
    }

    .form-group.error {
    color: #ff3860;
    }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #0056b3;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #236b86;
        }

        .contact-info {
            width: 100%;
            padding: 40px;
            text-align: center;
            background: #0056b3;
            color: #fff;
        }

        .contact-info h3 {
            font-size: 24px;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .contact-info p {
            margin: 10px 0;
            line-height: 1.6;
        }

        @media (min-width: 768px) {
            .container5 {
                padding: 40px;
            }

            .form-wrapper {
                width: 60%;
            }

            .contact-info {
                width: 40%;
            }
        }
    </style>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="alertbt.css">
    <link rel="stylesheet" href="css/contactstyle.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <!------- pour l ecriture ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- cart and wishist -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="validate.js"></script>
</head>

<body>
<?php include('includes/nav.php'); ?>
    <?php if (isset($_SESSION['message2']) && $_SESSION['page'] == 'contact') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="registration-error" style="z-index:9999;width:100%;">
            <?= $_SESSION['message2'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlert('registration-error')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION['message2']);
        unset($_SESSION['page']);
    } ?>
    <script>
        function closeAlert(alertId) {
            document.getElementById(alertId).style.display = "none";
        }
    </script>

    <body>
        </div>
        <div class="container5">
            <div class="form-wrapper">
                <h2>CONTACT US</h2>
                <form method="POST" action="contact2.php" id="form">
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="pnb" placeholder="Enter your phone number" maxlength="12" required>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="text" placeholder="Enter your message" required></textarea>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                    <input type="hidden" name="check" value="yes" readonly>
                        <button type="submit" name="btn" id="btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="contact-info">
                <h3>Contact Information</h3>
                <p>AZMI Fresco </p>
                <p>Tripoli, 1300</p>
                <p>Lebanon</p>
                <p>Email: electroMania@gmail.com</p>
                <p>Phone: +961 03 333 333</p>
                <p>Fax: +961 06 383 000</p>
                <div class="map-container">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3291.3725281752877!2d35.83704377490398!3d34.417291398368214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1521f6c63d972745%3A0x81a8ba02f94c54d5!2sCNAM!5e0!3m2!1sen!2slb!4v1690830623090!5m2!1sen!2slb" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>
        <?php include('includes/footer.php'); ?>
    </body>