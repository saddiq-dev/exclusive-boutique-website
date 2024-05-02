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
