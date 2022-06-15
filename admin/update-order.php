<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>


        <?php
            
            //Check whether id is set or not
            if(isset($_GET['id']))
            {
                //  Get the order Details
                $id=$_GET['id'];

                //Get all the details based on this id
                //SQL query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id = $id";
                //Execute query
                $res = mysqli_query($conn, $sql);
                // Count rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //DETAIL AVAILABLE
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                }else{

                    //Details not Available
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }else{
                //Redirect to Manage Order Page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name </td>
                    <td><b><?php echo $food; ?><b></td>
                </tr>

                 <tr>
                    <td>Price</td>
                    <td>
                        <b> Rs. <?php echo $price; ?><b>
                    </td>
                 </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity;?>">
                    </td>
                </tr>
                  
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Deilvery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="hidden" name="price" value="<?php echo $price; ?>">
                      <input type="submit" name="submit" value="Update Ordered" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
           //check whether update button is clicked or not
           if(isset($_POST['submit']))
           {
            ///echo "Clicked";      
            //get all the values from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $total = $price * $quantity;

            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            //update the values
                $sql2 = "UPDATE tbl_order SET
                quantity = $quantity,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id=$id
                ";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether update or not
                ///AND Redirect to manage order with message
                if($res2==true)
                {
                    //updated
                    $_SESSION['update'] = "<div clss='success'>order updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }else{
                    //failed to update
                    $_SESSION['update'] = "<div clss='error'>Failed to update order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

           }
        ?>
    <div>
<div>

<?php include('Partials/footer.php'); ?>