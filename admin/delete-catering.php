<?php
     //include constants file
     include('../config/constant.php');

    //echo "Delete page";
    // check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is avaiable
         if($image_name != "")
         {
             //Image is available. so remove it
             $path = "../images/catering/".$image_name;
             //remove the image
             $remove = unlink($path);

             //if failed to remove image then add an error message and stop the process
             if($remove==false)
             {
                 //set the session message
                 $_SESSION['remove'] = "<div class='error'>Failed to Remove Catering Image.</div>";
                 //redirect to manage catering page\
                 header('location:'.SITEURL.'admin/manage-catering.php');
                 //stop  the process
                 die();
                
             }
         }

          //Delete data from database
           //sql query delete data from database
           $sql = "DELETE FROM tbl_catering WHERE id=$id";

           //execute the query
           $res = mysqli_query($conn, $sql);

           //check whether the data is delete from database or not
           if($res==true)
           {
               //set success message and redirect
               $_SESSION['delete'] = "<div class='success'>Catering Deleted Successfully.</div>";
               //redirect to manage catering
               header('location:'.SITEURL.'admin/manage-catering.php'); 
           }
           else
           {
               //set FAIL message and redirect
               $_SESSION['delete'] = "<div class='error'>Failed to Delete Catering.</div>";
               //redirect to manage catering
               header('location:'.SITEURL.'admin/manage-catering.php'); 
           }
       }
        else
       {
          //redirect to manage catering page
          header('location:'.SITEURL.'admin/manage-catering.php');
      }
?>