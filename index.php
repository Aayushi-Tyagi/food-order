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

<?php 
   if(isset($_SESSION['order']))
   {
       echo $_SESSION['order'];
       unset($_SESSION['order']);
   }
?>

<!-- Categories section starts here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php 
          //create sql query to display categories from database
           $sql  = "SELECT * FROM tbl_category  WHERE active='Yes' AND featured='Yes' LIMIT 3";
           //execute the query
           $res = mysqli_query($conn, $sql);
           // count rows to check whether the category is available or not
           $count = mysqli_num_rows($res);
  
           if($count>0)
           {
               //CATEGORIES available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the value like id, title, image_nam
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //check whether image is available or not
                            if($image_name=="")
                            {
                                //  Display the Messsge
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else{
                                //Image Available
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                <?php
                                } 
                            ?>
                            
                            <h3 class="float-text text-black text-border text-center"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
           }
           else{
               //categories not available
               echo "<div class='error'>Category not Added.</div>";
           }
        ?>

          <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Sections Ends Here -->

<!--- Food Menu Section Starts Here --->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
         //Getting foods from Database that are active and featured
         //Sql query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        //count rows
        $count2 = mysqli_num_rows($res2);
        

        //Check whether food available or not
        if($count2>0)
        {
            //Food Available
            while($row=mysqli_fetch_assoc($res2))
            {
                //get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                        //Check whether image available or not
                        if($image_name=="")
                        {
                            //Image not Available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else{
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Cheese Pasta" class="img-responsive img-curve" >
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

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>&type=food" class="btn btn-primary">Order Now</a>
                   </div>
                </div>
                <?php
            }
        }
        else{
            //Food Not Available
            echo "<div class='error'>Food Not Available.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>
    
    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
    
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
      
    <p class="text-center">
        <a href="catering.php">See All Caterings</a>
    </p>

</section>
<!-- Catering Section End here -->

<?php include('partials-front/footer.php'); ?>