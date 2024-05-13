<?php

// Define database credentials (replace with your actual values)
define('DB_HOST', 'localhost');
define('DB_NAME', 'user');
define('DB_USER', 'root');
define('DB_PASSWORD', ''); // **Never store passwords in plain text!**

try {
  // Create a PDO connection object
  $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected to database successfully"; // Optional success message for development (remove in production)
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
?>
