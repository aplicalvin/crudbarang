<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #4CAF50; /* Green */
            border: none;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>CRUD PHP Bootstrap</h2>
    <h6>By. Athallaya Dylan Syah Putra</h6>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
        Tambah Barang
    </button>

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="create.php" method="post">
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include 'config.php';
        $sql = "SELECT * FROM barang";
        $result = $conn->query($sql);
        $counter = 1; // Inisialisasi counter

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $counter . "</td>
                    <td>" . $row["nama_barang"] . "</td>
                    <td>
                        <button type='button' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#editBarangModal' data-id='" . $row["id"] . "' data-nama_barang='" . $row["nama_barang"] . "'>Edit</button>
                        <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Hapus</a>
                    </td>
                </tr>";
                $counter++; // Increment counter setiap kali perulangan
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>

    <!-- Modal Edit Barang -->
    <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="update.php" method="post">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Tambahkan skrip berikut di bagian akhir sebelum penutup body tag -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<!-- Tambahkan skrip berikut di bagian akhir sebelum penutup body tag -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Menangani pengiriman formulir edit dengan AJAX
    $('#editForm').submit(function(e) {
        e.preventDefault(); // Menghentikan pengiriman formulir default

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize(); // Mengambil data formulir

        // Kirim data formulir dengan metode POST melalui AJAX
        $.post(url, formData)
            .done(function(response) {
                // Tutup modal setelah berhasil mengirimkan data
                $('#editBarangModal').modal('hide');

                // Muat ulang halaman untuk memperbarui tampilan data
                window.location.reload();
            })
            .fail(function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
                console.error(xhr.responseText);
            });
    });
</script>
<script>
    // Menangani peristiwa saat modal edit dibuka
    $('#editBarangModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button yang membuka modal
        var id = button.data('id'); // Ekstrak data-id dari tombol
        var nama_barang = button.data('nama_barang'); // Ekstrak data-nama_barang dari tombol
        
        // Perbarui nilai field dalam form
        var modal = $(this);
        modal.find('#edit_id').val(id);
        modal.find('#edit_nama_barang').val(nama_barang);
    });
</script>


</body>
</html>
