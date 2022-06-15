<?php include('config/constant.php'); ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant website</title>

        <!-- Link our css file --->
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <!---Navbar section starts here -->
        <section class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="#" title="logo">
                        <img src="images/Foodie.png" alt="Restaurant Logo" class="img-responsive">
                    </a> 
                </div>
                
                <div class="menu text-right">
                    <ul>
                        <li>
                            <a href="<?php echo SITEURL; ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>Catering.php">Catering</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>admin/login.php">Admin</a>
                        </li>
                    </ul>
                </div>

                     <div class="clearfix"></div>
               </div>
        </section>
        <!-- Navbar Section Ends Here -->


        