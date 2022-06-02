<?php include('partials-front/menu.php'); ?>

<!-- food Search Section Starts here -->
<section class="food-search">
    <div class="container">

    <h2 class="text-center text-white">Fill this form to confirm your order. </h2>

    <form action="#" class="order">
      <fieldset>
          <legend>Selected Food</legend>

          <div class="food-menu-img">
          <img src="images/pasta.jpg" alt="Cheese Pasta" class="img-responsive img-curve">
          </div>

          <div class="food-menu-desc">
            <h3>Food Title</h3>
            <p class="food-price">Rs.200</p>
            <div class="order-label">Quantity</div>
            <input type="number" name="qty" class="input-responsive" value="1" required>
          </div>
      </fieldset>

      <fieldset>
          <legend>Delivery Details</legend>
          <div class="order-label">Full Name</div>
          <input type="text" name="full_name" placeholder="E.g. Aayushi Tyagi" class="input-responsive" required>

          <div class="order-label">Phone Number</div>
          <input type="tel" name="contact" placeholder="E.g. 234xxxxxxx" class="input-responsive" required>

          <div class="order-label">Email</div>
          <input type="email" name="email" placeholder="E.g. xyz@gmail.com" class="input-responsive" required>

          <div class="order-label">Address</div>
          <textarea name="address" rows="10" placeholder="E.g. Street, city,Country" class="input-responsive" required></textarea>

          <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
       </fieldset>

     </form>
      
   </div>
</section>
<!-- food search section ends here -->

<?php include('partials-front/footer.php'); ?>