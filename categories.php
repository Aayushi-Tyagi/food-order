<?php include('partials-front/menu.php'); ?>


<!-- Categories section starts here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
           //Display all th categories that are active
           //sql query
           $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

           //Execute the query
           $res = mysqli_query($conn, $sql);

           //count the rows
           $count = mysqli_num_rows($res);

           //check whether categories available or not
           if($count>0)
           {
               //Categories Available
               while($row=mysqli_fetch_assoc($res))
               {
                   //GET the values
                   $id = $row['id'];
                   $title = $row['title'];
                   $image_name = $row['image_name'];
                   ?>
                      <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else{
                                        //image Available
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
               //Categories Not AVailable
               echo "<div class='error'>Category not found.</div>";
           }
        ?>
 
          <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Sections Ends Here -->

<?php include('partials-front/footer.php'); ?>