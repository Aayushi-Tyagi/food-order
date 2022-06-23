<?php include('partials-front/menu.php'); ?>

<!-- food Search Section Starts here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!--- food search section end here -->

<!--- Catering Section Starts Here --->
<section class="catering">
    <div class="container">
        <h2 class="text-center">Catering</h2>

        <?php
            //Display Catering food that are active
            $sql = "SELECT * FROM tbl_catering WHERE active='Yes'";


            //Execute the query 
            $res=mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether the foods are available or not
            if($count>0)
            {
                //Catering foods Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>

                        <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        //check whether image available or not
                                        if($image_name=="")
                                        {
                                            //Image not Available
                                            echo"<div class='error'>Image not Available.</div>";
                                        }
                                        else{
                                            //Image Available
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/catering/<?php echo $image_name; ?>" alt="Punbjabi Food Catering" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                            
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">Rs.<?php echo $price; ?> </p>
                                    <p class="food-detail">
                                    <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>&type=catering" class="btn btn-primary">Order Now</a>
                                </div>
                        </div>
                    <?php
                }

            }
            else{
                // Not Available
                echo "<div class='error'?Catering not found.</div>";
            }
        ?>

            <div class="clearfix"></div>

    </div>
</section>
<!-- Catering Section End here -->

<?php include('partials-front/footer.php'); ?>