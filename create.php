<?php
include 'config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kode = $_POST['kode'];
  $nama_brg = $_POST['nama_brg'];
  $satuan = $_POST['satuan'];
  $jumlah = $_POST['jumlah'];
  $tgl_beli = $_POST['tgl_beli'];
  $harga = $_POST['harga'];

  $sql = "INSERT INTO $table (kode, nama_brg, satuan, jumlah, tgl_beli, harga) VALUES ('$kode', '$nama_brg', '$satuan', '$jumlah', '$tgl_beli', '$harga')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
