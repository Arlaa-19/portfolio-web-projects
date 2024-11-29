<?php
session_start();
include("./connection/connect.php");
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$sql = "SELECT * FROM tabel_user";
$result = mysqli_query($conn, $sql);

$sql    = "SELECT MAX(id_user) AS maxid FROM tabel_user";
$carkod = mysqli_query($conn, $sql);
$datkod = mysqli_fetch_array($carkod, MYSQLI_ASSOC);
if ($datkod) {
  $nilkod  = $datkod['maxid'];
  $kode    = $nilkod + 1;
  $kodeoto = $kode;
} else {
  $kodeoto = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page Dinas Pertanian Kota Padang</title>

  <!-- bootstrap css -->
  <link href="./bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet" />

  <!-- remix icon cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="asset/css/styleIndex.css" />
</head>

<body>
  <main class="min-vh-100">
    <div class="boom d-flex justify-content-center align-items-center min-vh-100 min-vw-100">
      <div class="content text-center text-light d-flex flex-column justify-content-between">
        <div class="top d-flex flex-column align-items-center">
          <h1 class="fw-bold">Welcome to Dinas Pertanian Kota Padang</h1>
          <p class="text-center mt-3">Bantuan Sarana Produksi Pertanian dengan sistem terkomputerisasi</p>
          <!-- Button trigger modal -->
          <div class="d-flex gap-2">
            <button type="button" class="regis" data-bs-toggle="modal" data-bs-target="#register">Register <i class="ri-account-pin-circle-line fs-4"></i></button>
            <button type="button" class="get" data-bs-toggle="modal" data-bs-target="#getStart">Get Start <i class="ri-arrow-right-double-fill fs-4"></i></button>
          </div>
          <!-- Modal Login-->
          <div class="modal fade" id="getStart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">Form Login</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body formLogin">
                  <!-- Form untuk menampilkan elemen select -->
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <form action="./login.php" method="POST">
                        <div class="mb-3">
                          <div class="col-12 mb-2">
                            <label for="username" class="form-label text-secondary fw-bold">Username</label>
                            <input type="text" name="username" class="form-control text-secondary" id="username" placeholder="input username" required />
                          </div>
                          <div class="col-12 mb-2">
                            <label for="password" class="form-label text-secondary fw-bold">Password</label>
                            <input type="password" name="password" class="form-control text-secondary" id="password" placeholder="input password" required />
                          </div>
                          <div class="col-12 mb-2">
                            <label for="level" class="form-label text-secondary fw-bold">Level</label>
                            <select id="level" name="level" class="form-select mb-3 text-secondary" required>
                              <option value="">--Pilih--</option>
                              <option value="admin">admin</option>
                              <option value="user">user</option>
                            </select>
                          </div>

                          <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn_ms rounded-5 fw-bolder">Masuk</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal Login -->

          <!-- Form Register Data -->
          <div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Register User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body formRegister">
                  <!-- Form untuk menampilkan elemen select -->
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <form action="./user/tambahUser.php" method="post">
                        <div class="col">
                          <div class="row">
                            <div class="col">
                              <label for="idAdmin" class="form-label">Id Admin</label>
                              <input type="text" name="idAdmin" id="idAdmin" class="form-control mb-2 text-danger" value="<?php echo $kodeoto; ?>" readonly>
                            </div>
                            <div class="col">
                              <label for="username" class="form-label">Username</label>
                              <input type="text" id="username" name="username" class="form-control mb-2" placeholder="input username" required>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="row">
                            <div class="col">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" id="nama" name="nama" class="form-control mb-2" placeholder="input name" required>
                            </div>
                            <div class="col">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" id="password" name="password" class="form-control mb-2" placeholder="input password" required>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" id="email" name="email" class="form-control mb-2" placeholder="input email" required>
                          <label for="telp" class="form-label">Telp</label>
                          <input type="text" id="telp" name="telp" class="form-control mb-2" placeholder="input no telp" required>
                          <label for="level" class="form-label">Level</label>
                          <select id="level" name="level" class="form-select mb-3" required>
                            <option value="user">user</option>
                          </select>
                          <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn_ms rounded-5 fw-bolder">Register</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Form Register Data -->
        </div>
      </div>
    </div>
  </main>

  <!-- bootstrap js -->
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>

</html>