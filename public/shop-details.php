<!-- 🔴 Including the configuration file which may contain database connections, constants, and other settings -->
<?php require_once("../resources/config.php") ?>

<!-- 🔴 Including the header template from a defined path. TEMPLATE_FRONT and DS are constants defined in the config.php -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<?php
// 🔷 Querying the database for a product with a specific ID. The ID is retrieved from the URL parameter 'product-id'
$query = query(" SELECT * FROM products WHERE product_id =" . escape_string($_GET['product-id']) . " ");

// 🔷 This function checks if the query was successful
confirm($query);

// 🔷 Fetching the product details from the database and displaying them
while ($row = fetch_array($query)) :
?>

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="./assets/img/product/<?php echo $row['product_img']; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4><?php echo $row['product_name']; ?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>$<?php echo $row['product_price']; ?></h3>
                            <p><?php echo $row['product_desc']; ?></p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="xxl">xxl
                                        <input type="radio" id="xxl">
                                    </label>
                                    <label class="active" for="xl">xl
                                        <input type="radio" id="xl">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" id="l">
                                    </label>
                                    <label for="sm">s
                                        <input type="radio" id="sm">
                                    </label>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    <label class="c-1" for="sp-1">
                                        <input type="radio" id="sp-1">
                                    </label>
                                    <label class="c-2" for="sp-2">
                                        <input type="radio" id="sp-2">
                                    </label>
                                    <label class="c-3" for="sp-3">
                                        <input type="radio" id="sp-3">
                                    </label>
                                    <label class="c-4" for="sp-4">
                                        <input type="radio" id="sp-4">
                                    </label>
                                    <label class="c-9" for="sp-9">
                                        <input type="radio" id="sp-9">
                                    </label>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <a href="./shopping-cart.php?add=<?php echo $row['product_id']; ?>" class="primary-btn">add to cart</a>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="./assets/img/shop-details/details-payment.png" alt="">
                                <!-- <ul>
                                    <li><span>SKU:</span> 3812912</li>
                                    <li><span>Categories:</span> Clothes</li>
                                    <li><span>Tag:</span> Clothes, Skin, Body</li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">


                <?php

                $category = $row['product_cat_id'];

                $query = query(" SELECT * FROM products WHERE product_cat_id = $category");
                confirm($query); // Confirm the query execution

                while ($row = fetch_array($query)) {
                    $formattedPrice = '$' . number_format($row['product_price'], 2);

                    $product = <<<DELIMETER
                        <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="./assets/img/product/{$row['product_img']}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="./assets/img/icon/heart.png" alt=""></a></li>
                                    <li><a href="./shop-details.php?product-id={$row['product_id']}"><img src="./assets/img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{$row['product_name']}</h6>
                                <a href="./shopping-cart.php?add={$row['product_id']}" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$formattedPrice</h5>
                                <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                DELIMETER;

                    echo $product;
                }
                ?>


            </div>
        </div>
    <?php endwhile; ?>
    </section>

    <!-- Related Section End -->

    <!-- Including the footer section from a separate PHP file -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>