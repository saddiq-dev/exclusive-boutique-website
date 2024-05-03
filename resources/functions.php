<?php

/* ===================== EXECUTE SQL QUERY ======================
Input: $sql (a string representing the SQL query)

This function executes a SQL query against the database.
It uses the 'mysqli_query' function, which sends a query to the currently active database.
*/

function query($sql)
{
  // Access the global variable $connection, which holds the database connection.
  global $connection;

  return mysqli_query($connection, $sql);
}


/* ===================== VERIFY QUERY SUCCESS ======================
Input: $result (the result object returned by the query function)

This function checks if the SQL query was successful.
If the query failed, it terminates the script and prints an error message.
*/

function confirm($result)
{
  global $connection;

  if (!$result) {
    // Terminate the script and output an error message with the specific SQL error.
    die("QUERY FAILED" . mysqli_error($connection));
  }
}




/* ===================== FETCH ROW AS ARRAY ======================
Input: $result (MySQLi result object)
This function fetches a row from the given result set as an associative array.
*/
function fetch_array($result)
{

  return mysqli_fetch_array($result);
}


/* ===================== SANAITIZE SQL STRING ======================
Input: $string (a string to be escaped)

This function escapes special characters in a string for use in an SQL query.
It uses 'mysqli_real_escape_string' to prevent SQL injection attacks.
*/

function escape_string($string)
{
  global $connection;
  return mysqli_real_escape_string($connection, $string);
}




function last_id()
{

  global $connection;

  return mysqli_insert_id($connection);
}


function redirect($location)
{
  header("Location: $location");
}



function set_message($msg)
{

  if (!empty($msg)) {
    $_SESSION['message'] = "<p class='alert-message'>" . $msg . "<p>";
  } else {

    $msg = "";
  }
}


function display_message()
{

  if (isset($_SESSION['message'])) {

    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}
