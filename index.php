<?php
include 'config.php';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table_content = ''; // Variable to store table content

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode'];
    $nama_brg = $_POST['nama_brg'];
    $satuan = $_POST['satuan'];
    $jumlah = $_POST['jumlah'];
    $tgl_beli = $_POST['tgl_beli'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO $table (kode, nama_brg, satuan, jumlah, tgl_beli, harga) VALUES ('$kode', '$nama_brg', '$satuan', '$jumlah', '$tgl_beli', '$harga')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php
        header("Location: index.php");
        exit(); // Ensure no further output is sent
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $table_content .= "<table class='table'><thead><tr><th scope='col'>No</th><th scope='col'>Kode</th><th scope='col'>Nama Barang</th><th scope='col'>Satuan</th><th scope='col'>Jumlah</th><th scope='col'>Tanggal Beli</th><th scope='col'>Harga</th><th scope='col'>Action</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        $table_content .= "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['kode'] . "</td><td>" . $row['nama_brg'] . "</td><td>" . $row['satuan'] . "</td><td>" . $row['jumlah'] . "</td><td>" . $row['tgl_beli'] . "</td><td>" . $row['harga'] . "</td><td><button type='button' class='btn btn-primary' onclick='openEditModal(" . $row['id'] . ")'>Edit</button> <button type='button' class='btn btn-danger' onclick='openRemoveModal(" . $row['id'] . ")'>Remove</button></td></tr>";
    }
    $table_content .= "</tbody></table>";
} else {
    $table_content = "0 results";
}
$conn->close();
?>

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
    <div id="table-container">
        <?php echo $table_content; ?>
    </div>
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
            <div class="modal-body" id="editModalBody">
                <!-- Modal body will be filled dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Remove -->
<div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeModalLabel">Remove Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="removeModalBody">
                <!-- Modal body will be filled dynamically -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    // Function to open edit modal and populate data
    function openEditModal(id) {
        fetch('edit.php?id=' + id)
            .then(response => response.text())
            .then(data => {
                document.getElementById('editModalBody').innerHTML = data;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
    }

    // Function to open remove modal
function openRemoveModal(id) {
    var confirmation = confirm("Are you sure you want to remove this item?");
    if (confirmation) {
        // Redirect to delete.php with the ID parameter
        window.location.href = "delete.php?id=" + id;
    }
}

</script>

</body>
</html>
