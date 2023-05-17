<?php
// Koneksi ke database
include("database/koneksi.php");

$errorMessage = ""; // Inisialisasi pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form registrasi
    $nama = $_POST['nama'];
    $username = $_POST['user'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username sudah ada
    $checkUsernameQuery = "SELECT * FROM table_user WHERE user='$username'";
    $checkUsernameResult = $koneksi->query($checkUsernameQuery);

    // Periksa apakah username sudah ada
    if ($checkUsernameResult->num_rows == 0) {
        // Jika username belum ada, lakukan registrasi
        $registrasiQuery = "INSERT INTO table_user (user, nama, password, created_at) VALUES ('$username', '$nama', '$password', CURRENT_TIMESTAMP())";
        $registrasiResult = $koneksi->query($registrasiQuery);

        if ($registrasiResult) {
            // Registrasi berhasil
            $errorMessage = "Registrasi berhasil.";
        } else {
            // Registrasi gagal
            $errorMessage = "Registrasi gagal.";
        }
    } else {
        // Jika username sudah ada, tampilkan pesan error
        $errorMessage = "Username sudah ada.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrasi Page</title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">NoteMoney</a>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Registrasi</h3>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="user" class="form-label">Username</label>
                                <input type="text" name="user" class="form-control" id="user"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>

              <button type="submit" class="btn btn-primary w-100 mt-4">Registrasi</button>
            </form><br>
            <p>Sudah punya akun? <a href="index.php">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<!-- Script untuk menampilkan modal -->
<script>
  <?php if (!empty($errorMessage)) { ?>
    document.addEventListener('DOMContentLoaded', function() {
      var errorMessage = "<?php echo $errorMessage; ?>";
      var modal = new bootstrap.Modal(document.getElementById('errorModal'));
      document.getElementById('errorModalBody').innerHTML = errorMessage;
      modal.show();
    });
  <?php } ?>
</script>

<!-- Modal Bootstrap untuk pesan kesalahan -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="errorModalBody">
        <!-- Pesan kesalahan akan ditampilkan di sini -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </script>
  </body>
  </html>