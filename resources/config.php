<?php

// Start output buffering to capture and control the output
ob_start();

// Check if the session is not already started, and if not, start it
if (session_status() == PHP_SESSION_NONE) {
  // If the session is not started, start it
  session_start();
}
// session_destroy();

// Define a constant for the directory separator (DS) for file path consistency
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

// Define a constant for the front-end templates directory
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

// Define a constant for the back-end templates directory
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

// Create a new MySQLi database connection with the specified credentials
$connection = new mysqli("localhost", "root", "", "exclusive_boutique_db");

// Check for a connection error and terminate with an error message if one occurs
if ($connection->connect_errno) {
  die("Connection error: " . $connection->connect_error);
}

// Include the functions.php file, which contains various functions for the application
require_once("functions.php");
