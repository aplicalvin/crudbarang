<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD PHP Bootstrap 5</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .modal-dialog {
      max-width: 400px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2>Data Barang</h2>
  <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
  <div id="table-container"></div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="create.php" method="post">
          <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode">
          </div>
          <div class="mb-3">
            <label for="nama_brg" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_brg" name="nama_brg">
          </div>
          <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan">
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah">
          </div>
          <div class="mb-3">
            <label for="tgl_beli" class="form-label">Tanggal Beli</label>
            <input type="date" class="form-control" id="tgl_beli" name="tgl_beli">
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga">
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="update.php" method="post">
          <input type="hidden" id="edit_id" name="id">
          <div class="mb-3">
            <label for="edit_kode" class="form-label">Kode</label>
            <input type="text" class="form-control" id="edit_kode" name="kode">
          </div>
          <div class="mb-3">
            <label for="edit_nama_brg" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="edit_nama_brg" name="nama_brg">
          </div>
          <div class="mb-3">
            <label for="edit_satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="edit_satuan" name="satuan">
          </div>
          <div class="mb-3">
            <label for="edit_jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="edit_jumlah" name="jumlah">
          </div>
          <div class="mb-3">
            <label for="edit_tgl_beli" class="form-label">Tanggal Beli</label>
            <input type="date" class="form-control" id="edit_tgl_beli" name="tgl_beli">
          </div>
          <div class="mb-3">
            <label for="edit_harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="edit_harga" name="harga">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
  // Fetch data on page load
  window.onload = function() {
    fetch('fetch.php')
      .then(response => response.text())
      .then(data => document.getElementById('table-container').innerHTML = data);
  };

  // Function to open edit modal and populate data
  function openEditModal(id) {
    fetch('edit.php?id=' + id)
      .then(response => response.text())
      .then(data => {
        document.getElementById('editModal').innerHTML = data;
        new bootstrap.Modal(document.getElementById('editModal')).show();
      });
  }
</script>

</body>
</html>
