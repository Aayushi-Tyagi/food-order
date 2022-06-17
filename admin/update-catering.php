<?php include('partials/menu.php'); ?>


        <?php
             //check whether the id is set or not
             if(isset($_GET['id']))
             {
                 //get the ID  and all other details
                 //echo "Getting the Data";
                 $id = $_GET['id'];
                 //create sql query to get all other details
                 $sql2 = "SELECT * FROM tbl_catering WHERE id=$id";

                 //execute the query
                 $res2 = mysqli_query($conn, $sql2);

                  /// Get the value based on query executed 
                $row2 = mysqli_fetch_assoc($res2);

                 {
                     //get all the data
                     $title = $row2['title'];
                     $price = $row2['price'];
                     $description = $row2['description'];
                     $current_image = $row2['image_name'];
                     $current_catering = $row2['catering_id'];
                     $featured = $row2['featured'];
                     $active = $row2['active'];
                 }
                
            }
                else
                 {
                 //redirect to manage catering
                 header('location:'.SITEURL.'admin/manage-catering.php');
                 }
          ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Catering </h1>

        <br><br>


            <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
            

            <tr>
            <td>Current Image: </td>
            <td>
                <?php
                    if($current_image != "")
                    {
                        //display the image
                        ?>
                        <img src="<?php echo SITEURL; ?>images/catering/<?php echo $current_image; ?>" width="150">
                        <?php
                    }
                    else
                    {
                        //display message
                        echo "<div class='error'>Image Not Added.</div>";
                    }
                ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td> 
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Catering: </td>
                <td>
                    <select name="catering">
                        <?php
                            //query to get active catering
                            $sql = "SELECT * FROM tbl_catering WHERE active='Yes'";
                            //Execute the query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                        //check whether catering available or not
                        if($count>0)
                        {
                            //Catering available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $catering_title = $row['title'];
                                $catering_id = $row['id'];
                                    
                                //echo "<option value='$cateringy_id'>$catering_title</option>";
                                ?>
                                <option <?php if($current_catering==$catering_id){echo "selected";} ?> value="<?php echo $catering_id; ?>"><?php echo $catering_title; ?></option>
                                <?php
                            }
                        }
                        else{
                            // catering not available
                            echo "<option value='0'>Catering Not Available.</option>";
                        }

                        ?>
                    
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                    <input type="submit" name="submit" value="Update Catering" class="btn-secondary">
                </td>
            </tr>

            </table>

            </form>

<?php
    if(isset($_POST['submit']))
    {
        //echo "Clicked";
        //1. Get all the values from our form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];     
        $current_image = $_POST['current_image'];
        $catering = $_POST['catering'];

        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2.Updating New Image if selected 
        //check whether the image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //Get the image details
            $image_name = $_FILES['image']['name'];

            //check whether the image is available or not
            if($image_name != "")
            {
                //Image Available
                //A.Upload the new image

                //Auto rename our image
                //Get the extension of our image (jpg,png,gif, etc)e.g. "specialfood1.jpg"
                $ext = end(explode('.', $image_name));

                //Rename the image
                $image_name = "Food_Catering_".rand(000,999).'.'.$ext; ///e.g food_catering_834.jpg
            
                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/catering/".$image_name;  
            
                ///finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
            
                
                //check whether the image is uploaded or not
                //and if the image is not uploaded then we will stop the process redirect with error message
                if($upload==false)
                {
                    //Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload Image. </div>";
                    //Redirect to add catering page
                    header('location:'.SITEURL.'admin/manage-catering.php');
                    //Stop the process
                    die();
                }

                //B.Remove the current image if available
                if($current_image!="")
                {

                    $remove_path = "../images/catering/".$current_image;

                    $remove = unlink($remove_path);

                    //check whether the image is removed or not
                    //if failed to remove then display message and stop the process
                    if($remove==false)
                    {
                        //failed to remove image
                        $_SESSION['failed-remove'] = "<div class='error>Failed to remove current Image.</div>";
                        header('location:'.SITEURL.'admin/manage-catering.php');
                        die();//stop the process
                    }
                }
                
            } else {
                $image_name = $current_image; // Default image when image is not selected
            }
        } else {
            $image_name = $current_image; // Default image when image button is not clicked
        }

        //3. Update the database
        $sql3 = "UPDATE tbl_catering SET
        title = '$title',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        catering_id = '$catering',
        featured = '$featured',
        active = '$active'
        WHERE id=$id                
        ";

        // Execute the query 
        $res3 = mysqli_query($conn, $sql3);

        //4.Redirect to manage cateringy with message
        //check whether executed or not
        if($res3==true)
        {
            //catering updated 
            $_SESSION['update'] = "<div class='success'>Catering Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-catering.php');
        } else {
            //failed to update catering
            $_SESSION['update'] = "<div class='error'>Failed to Update Catering.</div>";
            header('location:'.SITEURL.'admin/manage-catering.php');
        }
       
    }
?>

</div>
</div>



<?php include("partials/footer.php"); ?>

