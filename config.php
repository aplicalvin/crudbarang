<?php
$host = "sql6.freesqldatabase.com";
$username = "sql6682386";
$password = "rEHMPWK5b3";
$database = "sql6682386";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
