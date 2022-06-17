<?php include('partials-front/menu.php'); ?>

<!-- food Search Section Starts here -->
<section class="food-search text-center">
    <div class="container">

    <?php

       //GEt the search keyword
       //$search = $_POST['search'];
       $search = mysqli_real_escape_string($conn, $_POST['search']);

    ?>

    <h2 class="text-white">Foods on your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!--- food search section end here -->

<!--- Food Menu Section Starts Here --->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php  
           //sql query to Get foods based on search keyword
           //$search = burger '; DROP database name; 
           //*SELECT* FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger'%'";
           $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

           //Execute the query 
           $res = mysqli_query($conn, $sql);

           ///count Rows
           $count = mysqli_num_rows($res);

           ///Check whether food available or not
           if($count>0)
           {
              //Food Available 
              while($row=mysqli_fetch_assoc($res)) 
              {
                  //Get the details
                  $id = $row['id'];
                  $title = $row['title'];
                  $price = $row['price'];
                  $description = $row['description'];
                  $image_name = $row['image_name'];
                  ?>
                  <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // Check whether image name is available or not
                            if($image_name=="")
                            {
                                //Image not Available
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else{
                                // Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Cheese Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                           
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?></p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                       </div>
                  </div>

                  <?php
              }     
           }
           else{
               //Food Not Available
               echo "<div class='error'>Food not found.</div> ";
           }

        ?>

            <div class="clearfix"></div>

    </div>
</section>
<!-- Food menu Section End here -->

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

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
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