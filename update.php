<?php
include 'config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$kode = $_POST['kode'];
$nama_brg = $_POST['nama_brg'];
$satuan = $_POST['satuan'];
$jumlah = $_POST['jumlah'];
$tgl_beli = $_POST['tgl_beli'];
$harga = $_POST['harga'];

$sql = "UPDATE $table SET kode='$kode', nama_brg='$nama_brg', satuan='$satuan', jumlah='$jumlah', tgl_beli='$tgl_beli', harga='$harga' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
      // Redirect to index.php
      header("Location: index.php");
      exit(); // Ensure no further output is sent
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
