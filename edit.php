<?php
include 'config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT * FROM $table WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo "
    <form action='update.php' method='post'>
      <input type='hidden' name='id' value='" . $row['id'] . "'>
      <div class='mb-3'>
        <label for='kode' class='form-label'>Kode</label>
        <input type='text' class='form-control' id='kode' name='kode' value='" . $row['kode'] . "'>
      </div>
      <div class='mb-3'>
        <label for='nama_brg' class='form-label'>Nama Barang</label>
        <input type='text' class='form-control' id='nama_brg' name='nama_brg' value='" . $row['nama_brg'] . "'>
      </div>
      <div class='mb-3'>
        <label for='satuan' class='form-label'>Satuan</label>
        <input type='text' class='form-control' id='satuan' name='satuan' value='" . $row['satuan'] . "'>
      </div>
      <div class='mb-3'>
        <label for='jumlah' class='form-label'>Jumlah</label>
        <input type='number' class='form-control' id='jumlah' name='jumlah' value='" . $row['jumlah'] . "'>
      </div>
      <div class='mb-3'>
        <label for='tgl_beli' class='form-label'>Tanggal Beli</label>
        <input type='date' class='form-control' id='tgl_beli' name='tgl_beli' value='" . $row['tgl_beli'] . "'>
      </div>
      <div class='mb-3'>
        <label for='harga' class='form-label'>Harga</label>
        <input type='number' class='form-control' id='harga' name='harga' value='" . $row['harga'] . "'>
      </div>
      <button type='submit' class='btn btn-primary'>Update</button>
    </form>
  ";
} else {
  echo "Data not found";
}
$conn->close();
?>
