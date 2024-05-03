<!-- ------ 💥 PHP for Configuration and Cart Management -->

<!-- 🔴 Including the configuration and cart files, which likely establish database connections and define cart-related functions -->
<?php require_once("../resources/config.php") ?>
<?php require_once("./shopping-cart.php") ?>

<?php
// 🔹 Function call to display any messages (like success or error messages)
echo display_message();
?>

<!-- 🔴 Including the header template from a defined path. TEMPLATE_FRONT and DS are constants defined in the config.php -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__text">
          <h4>Shopping Cart</h4>
          <div class="breadcrumb__links">
            <a href="./index.php">Home</a>
            <a href="./shop.php">Shop</a>
            <span>Shopping Cart</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="shopping__cart__table">
          <table>
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              <?php cart(); ?>


            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="continue__btn">
              <a href="./shop.php">Continue Shopping</a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="continue__btn update__btn">
              <a href="./checkout.php"><i class="fa fa-spinner"></i> Update cart</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="cart__discount">
          <h6>Discount codes</h6>
          <form action="#">
            <input type="text" placeholder="Coupon code">
            <button type="submit">Apply</button>
          </form>
        </div>
        <div class="cart__total">
          <h6>Cart total</h6>
          <ul>
            <!-- <li>Subtotal <span>$ 169.50</span></li> -->
            <li>Total <span>&#36;<?php echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0" ?></span></li>
          </ul>
          <a href="#" class="primary-btn">Proceed to checkout</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shopping Cart Section End -->

<!-- Including the footer section from a separate PHP file -->
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>