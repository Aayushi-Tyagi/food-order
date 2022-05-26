<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Food </h1>

        <br><br>

        <?php
             if(isset($_SESSION['upload']))
             {
                 echo $_SESSION['upload'];
                 unset($_SESSION['upload']);
             }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the Food"> 
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Seclect Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php
                         ///create php code to display categories from database
                         ///1. create sql to get all active categories from database
                         $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //  Execute the query
                         $res = mysqli_query($conn, $sql);

                         //count rows to check whether we have categories or not
                         $count = mysqli_num_rows($res);
                         
                         //If count is greater than zero, we have catgories else we donot have categories
                         if($count>0)
                         {
                             //We have categories
                             while($rows=mysqli_fetch_assoc($res))
                             {
                                 //get the details of categories
                                 $id = $rows['id'];
                                 $title = $rows['title'];
                                 ?>

                                  <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                 <?php
                             }
                         }
                         else
                         {
                             //we donot have category
                             ?>
                                <option value="0">No Category Found</option>
                             <?php
                         }
                           
                            //2. Display on Dropdown
                        
                        ?>

                     </select>   
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                     <input type="radio" name="active" value="Yes"> Yes
                     <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>

        </table>

    </form>
          
       <?php
            //check whether the button is clicked or not 
            if(isset($_POST['submit']))
            {
                //Add the food in database
                //echo "Clicked";

                //1. Get the Data from form
                $title =  $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                   $featured = $_POST['featured']; 
                }
                else
                {
                    $featured = "No"; // setting the default value 
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                 }
                else{
                    $active = "No"; //Setting Default Value 
                }

                //2. Upload the Image if selected
                //check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                    {
                        //get the details of the selected image
                        $image_name = $_FILES['image']['name'];

                        //check whether the image is selected or not and upload image only if selected
                        if($image_name!="")
                        {
                            //Image is selected
                            // A. Rename the image
                            //Get the extension of  selected image (jpg, png, gif, etc) 
                            $ext = end(explode('.', $image_name));

                            //create New name for image
                            $image_name = "Food_Name_".rand(000,999).".".$ext; //New image name may be "Food_Name_657.jpg"

                            //B. Upload the image
                            //Get the Source path and destination path
                            //source path is the current location of the image
                            $src = $_FILES['image']['tmp_name'];

                            //destination path for the image to be uploaded
                            $dst = "../images/food/".$image_name;

                            //finally upload the food image
                            $upload = move_uploaded_file($src, $dst);

                            //check whether image uploaded or not
                            if($upload==false)
                            {
                                //Failed to Upload the image
                                //Redirect to Add Food Page with Error Message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else{
                        $image_name=""; //setting default value as blank
                    }

                //3. Insert Into Database

                //create the sql query to save or add food
                //for nummerical value we donot need to pass value inside quotes '' but for string value it is compulsory to add quotes
                $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether data inserted or not
                //4. Redirect with Message to Manage Food Page 
                if($res2==true)
                {
                    //data inserted successfully 
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to inserted Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            
            }
       ?>

    </div>

</div>



<?php include('partials/footer.php'); ?>