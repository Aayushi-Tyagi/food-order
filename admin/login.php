<?php include('../config/constant.php');?>


<html>
    <head>
        <title> Login - Food order System </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

      <div class="login">
          <h1 class="text-center">Login</h1>
          <br><br>

        <?php
         if(isset($_SESSION['login']))
          {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }

          if(isset($_SESSION['no-login-message']))
          {
              echo $_SESSION['no-login-message'];
              unset($_SESSION['no-login-message']);
          }
        ?>
        <br><br>

          <!--Login form Starts Here-->

          <form action="" method="POST" class="text-center">
              Username:
              <input type="text" name="username" placeholder="Enter Username">
              <br><br>
              Password:
              <input type="password" name="password" placeholder="Enter Password">
              <br><br>

              <input type="submit" name="submit" value="Login" class="btn-primary">

          </form>
          <!-- Login ends here--->
          <br><br>
          <p class="text-center">Created By - <a href="www.aayushityagi.com">Aayushi Tyagi</a></p>
      </div>
    
    </body>
</html>

<?php
  //(check whether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
      //process for login
      //1.Get the data from login form
      //$username = $_POST['username'];
      //$password = md5($_POST['password']);
      $username = mysqli_real_escape_string($conn, $_POST['username']);

      $raw_password = md5($_POST['password']);
      $password = mysqli_real_escape_string($conn, $raw_password);

      //2. SQL to check  whwther the user with username and password exists or not
      $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

      //Execute the query
      $res = mysqli_query($conn, $sql);

      //4. Count rows to check whether the user exists or not
      $count = mysqli_num_rows($res);
      
      if($count==1)
      {
          //User Available and Login Successs
          $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
          $_SESSION['user'] = $username; // to check whether the user is logged in or not and logout will unset it

          //Redirect to Home Page/Dashboard
          header('location:'.SITEURL.'admin/');
      }
      else
      {
          //User not Available and Login Fail
          $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
          //Redirect to Home Page/Dashboard
          header('location:'.SITEURL.'admin/login.php');
      }

  }

?>