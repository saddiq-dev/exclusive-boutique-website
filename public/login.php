<?php
// 🔹 Flag to track if the login attempt is invalid
$is_invalid = false;

// 🔹 Checking if the request method is POST and the 'login' button was clicked
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
  // Including the configuration file to establish database connection
  require_once "../resources/config.php";

  // 🔹 Accessing the global database connection
  global $connection;

  // 🔹Preparing an SQL statement to select the user with the provided email
  $sql = sprintf(
    "SELECT * FROM users
  WHERE user_email = '%s'",
    $connection->real_escape_string($_POST["email"])
  );

  // 🔹 Executing the query
  $result = $connection->query($sql);

  // 🔹Fetching the user data from the query result
  $user = $result->fetch_assoc();

  // 🔹 Checking if the user exists and the password is correct
  if ($user) {
    if (password_verify($_POST["password"], $user["user_password_hash"])) {

      // 🔹 Starting a new session if none exists
      if (session_status() == PHP_SESSION_NONE) {
        // 🔹 If the session is not started, start it
        session_start();
      }

      // 🔹 Regenerating the session ID for security
      session_regenerate_id();

      // 🔹 Setting session variables for the user
      $_SESSION["user_id"] = $user["user_id"];
      $_SESSION["user_email"] = $user["user_email"];
      $_SESSION["user_name"] = $user["user_name"];
      $_SESSION['user_logged_in'] = true;

      // 🔹 Redirecting to the homepage after successful login
      header("Location: ../public/index.php");
      exit;
    }
  }

  // 🔹 Setting the invalid flag to true if login fails
  $is_invalid = true;
}
?>
<!-- 🔹Including the configuration file again, which might not be necessary if it was already included above -->
<?php require_once("../resources/config.php") ?>




<!doctype html>
<html lang="en">

<head>
  <!-- <title>Login 08</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- 🔴 Including the header template from a defined path. TEMPLATE_FRONT and DS are constants defined in the config.php -->
  <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

  <link rel="stylesheet" href="./assets/css/login.css">

</head>



<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <h2 class="heading-section">Sign In</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="login-wrap p-4 p-md-5">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="fa fa-user-o"></span>
            </div>
            <h3 class="text-center mb-4">Have an account?</h3>



            <form method="post" class="login-form">
              <?php if ($is_invalid) : ?>
                <p class="invalid-login">Invalid login</p>
              <?php endif; ?>
              <div class="form-group">
                <input name="email" type="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" class="form-control rounded-left" placeholder="Email" required>
              </div>
              <div class="form-group d-flex">
                <input name="password" type="password" class="form-control rounded-left" placeholder="Password" required>
              </div>
              <div class="form-group d-md-flex">
                <div class="w-50">
                  <label class="checkbox-wrap checkbox-primary">Remember Me
                    <input type="checkbox" checked>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="w-50 text-md-right">
                  <a href="./register.php">Don't have an account? Sign Up</a>
                </div>

              </div>
              <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary rounded submit p-3 px-5">Sign In</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html> -->


  <!-- Including the footer section from a separate PHP file -->
  <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>