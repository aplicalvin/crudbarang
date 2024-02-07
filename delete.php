<?php
include 'config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM $table WHERE id=$id";

if ($conn->query($sql) === TRUE) {
      // Redirect to index.php
      header("Location: index.php");
      exit(); // Ensure no further output is sent
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
