<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];

    $sql = "UPDATE barang SET nama_barang='$nama_barang' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$conn->close();
?>