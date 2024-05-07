<?php

// session_start();
if (isset($_SESSION["user_id"])) {

  // $mysqli = require __DIR__ . "../../../resources/config.php";
  $mysqli = require  "../resources/config.php";
  $sql = "SELECT * FROM users
  WHERE user_id = {$_SESSION["user_id"]}";
  $result = $connection->query($sql);
  $useracc = $result->fetch_assoc();
}

?>






<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Male_Fashion Template" />
  <meta name="keywords" content="Male_Fashion, unica, creative, html" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Male-Fashion | Template</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Css Styles -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/magnific-popup.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/nice-select.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="./assets/css/style.css" type="text/css" />

  <script>
    (function(w, d) {
      w.CollectId = "663471711063215eaa11c214";
      var h = d.head || d.getElementsByTagName("head")[0];
      var s = d.createElement("script");
      s.setAttribute("type", "text/javascript");
      s.async = true;
      s.setAttribute("src", "https://collectcdn.com/launcher.js");
      h.appendChild(s);
    })(window, document);
  </script>
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Offcanvas Menu Begin -->
  <div class="offcanvas-menu-overlay"></div>
  <div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
      <div class="offcanvas__links">
        <?php if (isset($useracc)) : ?>
          <a href=""> Welcome <?= htmlspecialchars($useracc["user_name"]) ?></a>
          <a href="./logout.php">Logout</a>
        <?php else : ?>
          <a href="./login.php">Sign in</a>
          <a href="./register">Sign Up</a>
        <?php endif; ?>
      </div>
      <div class="offcanvas__top__hover">
        <span>Usd <i class="arrow_carrot-down"></i></span>
        <ul>
          <li>USD</li>
          <li>EUR</li>
          <li>USD</li>
        </ul>
      </div>
    </div>
    <div class="offcanvas__nav__option">
      <a href="#" class="search-switch"><img src="./assets/img/icon/search.png" alt="" /></a>
      <a href="#"><img src="./assets/img/icon/heart.png" alt="" /></a>
      <a href="./checkout.php"><img src="./assets/img/icon/cart.png" alt="" /> <span>0</span></a>
      <div class="price">$0.00</div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
      <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
  </div>
  <!-- Offcanvas Menu End -->

  <!-- Header Section Begin -->
  <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-7">
            <div class="header__top__left">
              <p>Free shipping, 30-day return or refund guarantee.</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-5">
            <div class="header__top__right">
              <div class="header__top__links">
                <?php if (isset($useracc)) : ?>
                  <a href=""> Welcome <?= htmlspecialchars($useracc["user_name"]) ?></a>
                  <a href="./logout.php">Logout</a>
                <?php else : ?>
                  <a href="./login.php">Sign in</a>
                  <a href="./register.php">Sign up</a>
                <?php endif; ?>
              </div>
              <div class="header__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                  <li>USD</li>
                  <li>EUR</li>
                  <li>USD</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <div class="header__logo">
            <a href="#" style="font-family: 'Arial Black', sans-serif; font-size: 20px; color: #ff3366; text-decoration: none; font-weight: bold;">Exclusive Boutique</a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <nav class="header__menu mobile-menu">
            <ul>
              <li class="active"><a href="./index.php">Home</a></li>
              <li><a href="./shop.php">Shop</a></li>
              <li><a href="./contact.php">Contacts</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="header__nav__option">
            <a href="#" class="search-switch"><img src="./assets/img/icon/search.png" alt="" /></a>
            <a href="#"><img src="./assets/img/icon/heart.png" alt="" /></a>
            <a href="./checkout.php"><img src="./assets/img/icon/cart.png" alt="" /> <span>0</span></a>
            <div class="price">$0.00</div>
          </div>
        </div>
      </div>
      <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
  </header>
  <!-- Header Section End -->