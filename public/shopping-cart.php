<?php require_once("../resources/config.php");
session_start();

// Check if a product should be added to the cart
if (isset($_GET['add1'])) {

    // Query for the database to get product information
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . " ");
    confirm($query);

    while ($row = fetch_array($query)) {

        // Check if the product quantity is available
        if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {

            // Increase the quantity of the product in the cart
            $_SESSION['product_' . $_GET['add']] += 1;
            redirect("../public/checkout.php");
        } else {

            // Display a message if the product is out of stock
            set_message("We only have " . $row['product_quantity'] . " " . "Available");
            redirect("../public/checkout.php");
        }
    }
}


// Check if a product should be added to the cart
if (isset($_GET['add'])) {

    // Query for the database to get product information
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . " ");
    confirm($query);

    while ($row = fetch_array($query)) {

        // Check if it's a free product
        if ($row['product_cat_id'] == 7) {
            // Check if the free product is already in the cart
            if (isset($_SESSION['product_' . $_GET['add']]) && $_SESSION['product_' . $_GET['add']] >= 1) {
                // Prevent increasing quantity for free products
                set_message("You can only have one unit of this free product in your cart.");
            } else {
                // Add free product to the cart with quantity 1
                $_SESSION['product_' . $_GET['add']] = 1;
            }
        } else {
            // For non-free products, check if the product quantity is available and adjust as needed
            if ($row['product_quantity'] > $_SESSION['product_' . $_GET['add']]) {
                $_SESSION['product_' . $_GET['add']] += 1;
            } else {
                // Display a message if the product is out of stock
                set_message("We only have " . $row['product_quantity'] . " of this product available");
            }
        }

        // Redirect to the checkout page
        redirect("../public/checkout.php");
    }
}


// Check if a product should be removed from the cart
if (isset($_GET['remove'])) {

    // Decrease the quantity of the product in the cart
    $_SESSION['product_' . $_GET['remove']]--;

    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        // Remove the product from the cart if the quantity reaches 0
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);

        redirect("../public/checkout.php");
    } else {
        redirect("../public/checkout.php");
    }
}

// Check if a product should be deleted from the cart
if (isset($_GET['delete'])) {

    // Set the quantity of the product in the cart to 0, effectively deleting it
    $_SESSION['product_' . $_GET['delete']] = '0';

    // Reset the item total and item quantity
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);

    redirect("../public/checkout.php");
}

// Function to display the cart contents
function cart()
{

    $total = 0;
    $item_quantity = 0;
    // $line_items[] = null;

    foreach ($_SESSION as $name => $value) {

        if ($value > 0) {
            if (substr($name, 0, 8) == "product_") {

                $length = strlen($name) - 8;
                $id = substr($name, 8, $length);
                $sub = 0; // Initialize $sub here

                // Query the database to get product information
                $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
                confirm($query);

                while ($row = fetch_array($query)) {

                    // Calculate the subtotal for each product
                    $sub = $row['product_price'] * $value;
                    $item_quantity  += $value;


                    // $line_items[] = ['price' => $row['stripe_product_price'], 'quantity' => $value];


                    // Display the product information in the cart
                    $product = <<<DELIMETER
                        <tr>
                        <td class="product__cart__item">
                        <div class="product__cart__item__pic">
                            <img src="./assets/img/product/{$row['product_img']}" alt="" width="100" height="100">
                        </div>
                        <div class="product__cart__item__text">
                            <h6>{$row['product_name']}</h6>
                            <h5>{$row['product_price']}</h5>
                        </div>
                        </td>
                        <td class="quantity__item">
                        <div class="quantity">
                        <a href="./shopping-cart.php?remove={$row['product_id']}">
                        <i class="fa fa-arrow-left" style="color: gray;"></i>
                        </a>
                        <span>{$value}</span>
                        <a href="./shopping-cart.php?add={$row['product_id']}">
                        <i class="fa fa-arrow-right" style="color: gray;"></i>
                        </a>
                        </div>
                        </td>
                        <td class="cart__price">&#36;{$sub}</td>
                        
                        <td class="cart__close">
                        <a href="./shopping-cart.php?delete={$row['product_id']}">
                        <i class="fa fa-close"></i>
                        </a>
                        </td>
                        
                    </tr>
                    DELIMETER;
                    echo $product;
                }

                // if (!empty($line_items)) {

                //     try {
                //         $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SK_KEY']);

                //         // Retrieve customer email from the session
                //         $customer_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
                //         $customer_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;

                //         // Search for existing customer by email
                //         $existingCustomers = $stripe->customers->all(['email' => $customer_email, 'limit' => 1]);

                //         if (count($existingCustomers->data) > 0) {
                //             // Customer already exists in Stripe, use the existing customer
                //             $customer = $existingCustomers->data[0];
                //         } else {
                //             // Create a Stripe Customer
                //             $customer = $stripe->customers->create([
                //                 'email' => $customer_email,
                //                 'name' => $customer_name,
                //                 // Add other customer details if necessary, like 'name'
                //             ]);
                //         }

                //         $session = $stripe->checkout->sessions->create([
                //             'customer' => $customer->id,
                //             'billing_address_collection' => 'required',
                //             'shipping_address_collection' => [
                //                 'allowed_countries' => ['TT'], // List the countries you want to ship to
                //             ],
                //             'success_url' => 'http://localhost/healthify/public/order-success.php?session_id={CHECKOUT_SESSION}',
                //             'cancel_url' => 'http://localhost/healthify/public/checkout.php',
                //             'payment_method_types' => ['card'],
                //             'mode' => 'payment',
                //             'line_items' => [$line_items]
                //         ]);

                //         $_SESSION['checkout_session_id'] =  $session->id;
                //     } catch (Exception $exception) {
                //         echo $exception->getMessage();
                //     }
                // }

                // Update the session variables for item total and item quantity
                $_SESSION['item_total'] = $total += $sub;
                $_SESSION['item_quantity'] = $item_quantity;
            }
        }
    }
}


function show_buy_button()
{
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
        // User is logged in, show the Buy Now button
        $buy_button = <<<DELIMETER
          <button type="button" id="buybtn" class="btn">Buy Now</button>
      DELIMETER;
    } else {
        // User is not logged in, show a message or redirect
        $buy_button = <<<DELIMETER
          <p>Please <a href="login.php">log in</a> to proceed with your purchase.</p>
      DELIMETER;
    }
    return $buy_button;
}


// if (isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {
// <input type="image" name="upload" border="0"
// src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
// alt="PayPal - The safer, easier way to pay online">

// <!--    <input type="submit" name="upload" class="btn btn-primary" value="Buy Now">-->