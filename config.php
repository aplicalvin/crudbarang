<?php
$host = "localhost";
$username = "root";
$password = "Passwd123";
$database = "data_barang";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
