<?php
    //Include constant page
    include('../config/constant.php');

    //echo "Delete Food Page";
    

    if(isset($_GET['id']) && isset($_GET['image_name'])) //either we will use && or AND 
    {
        //process to delete
       // echo "Process to Delete";


       // 1. Get ID and image name
       $id = $_GET['id'];
       $image_name = $_GET['image_name'];

       //Remove the image if available
       //check whether the image is available or not and delete only if available
       if($image_name != "")
       {
           //It has image and need to remove from folder
           //Get the image path
           $path = "../images/food/".$image_name;

           //remove image file from folder
           $remove = unlink($path);

           //check whether th eimage is removed or not 
           if($remove==false)
           {
               //Failed to remove image
               $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
               //REdirect to manage food
               header('location:'.SITEURL.'admin/manage-food.php');
               //stop the process of deleting food
               die();
           }
       }


       //3.Delete food from database
       $sql = "DELETE FROM tbl_food WHERE id=$id";
       //execeute the query
       $res = mysqli_query($conn, $sql);

       //check whether the query executed or not and set the session message respectively
       //4.Redirect to Manage food with session message
       if($res==true)
       {
           //food deleted
           $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
           header('location:'.SITEURL.'admin/manage-food.php');
       }
       else{
        
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
       }
      
    }
    else{
        //REdirect to Manage food page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>