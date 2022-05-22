<?php

      ///including constant.php for SITEURL
      include('../config/constant.php');

       //1.Destroy the Session
       session_destroy(); //unsets $_Session['user']

       //2.Redirect to login page
       header('location:'.SITEURL.'admin/login.php');
?>