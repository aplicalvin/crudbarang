<?php
include 'config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table class='table'><thead><tr><th scope='col'>No</th><th scope='col'>Kode</th><th scope='col'>Nama Barang</th><th scope='col'>Satuan</th><th scope='col'>Jumlah</th><th scope='col'>Tanggal Beli</th><th scope='col'>Harga</th><th scope='col'>Action</th></tr></thead><tbody>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['kode'] . "</td><td>" . $row['nama_brg'] . "</td><td>" . $row['satuan'] . "</td><td>" . $row['jumlah'] . "</td><td>" . $row['tgl_beli'] . "</td><td>" . $row['harga'] . "</td><td><button type='button' class='btn btn-primary' onclick='openEditModal(" . $row['id'] . ")'>Edit</button> <button type='button' class='btn btn-danger'>Remove</button></td></tr>";
  }
  echo "</tbody></table>";
} else {
  echo "0 results";
}
$conn->close();
?>
