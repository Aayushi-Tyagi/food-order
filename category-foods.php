<?php include('partials-front/menu.php'); ?>


<?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category_id is set and get the id
        $category_id = $_GET['category_id'];
        //GET the category title based on category ID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Get the value from Database
        $row = mysqli_fetch_assoc($res);
        //Get the title
        $category_title = $row['title'];

    }
    else{
        //category not passed
        //Reduce to Home Page
        header('location:'.SITEURL);
    }

?>

<!-- food Search Section Starts here -->
<section class="food-search text-center">
    <div class="container">

    <h2 class="text-white">Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!--- food search section end here -->


<!--- Food Menu Section Starts Here --->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        
           ///Create SQL Query to Get foods based on selected category
           $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";


           //Execute the query
           $res2 = mysqli_query($conn, $sql2);

           //count the rows
           $count2 = mysqli_num_rows($res2);

           //check whether food is available or not
           if($count2>0)
           {
               //food is available
               while($row2=mysqli_fetch_assoc($res2))
               {
                   $title = $row2['title'];
                   $price = $row2['price'];
                   $description = $row2['description'];
                   $image_name = $row2['image_name'];
                   ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if($image_name=="")
                                {
                                    ///Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else{
                                    //Image Available
                                   ?>
                                       <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Cheese Pasta" class="img-responsive img-curve">
                                   <?php
                                }
                            ?>
                           
                        </div>
            
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                   <?php
                }
           }
           else{
               //food not available
               echo"<div class='error'>Food NOT Available.</div>";
           }
        ?>

            <div class="clearfix"></div>

    </div>
</section>

<!-- Food menu Section End here -->

<?php include('partials-front/footer.php'); ?>