<?php
session_start();
include("../connection/connect.php");
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$sql = "SELECT * FROM tabel_admin";
$result = mysqli_query($conn, $sql);

$sqlUser = "SELECT * FROM tabel_user";
$resultUser = mysqli_query($conn, $sqlUser);

$sql    = "SELECT MAX(id_admin) AS maxid FROM tabel_admin";
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinas Pertanian SPK</title>
    <!-- bootstrap css -->
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- remix icon cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" />

    <!-- my style css -->
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <header class="container-fluid shadow-sm fixed-top">
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container-fluid">
                <div class="d-flex me-3">
                    <img src="../asset/img/logo.png" class="logo-img pe-1" alt="">
                    <a class="navbar-brand lh-1 p-0 fw-bold" href="../index.php">Dinas Pertanian<br><span class="fs-5">Kota Padang</span></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <a class="navbar-brand lh-1 p-0 fw-bold" href="../index.php">Dinas Pertanian<br><span class="fs-5">Kota Padang</span></a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-underline">
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" aria-current="page" href="../index.php">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="../kriteria/kriteria.php">Kriteria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="../alternatif/alternatif.php">Alternatif</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="../vikor/penilaianVikor.php">Penilaian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="../vikor/hasilPerhitungan.php">Hasil Akhir</a>
                            </li>
                        </ul>
                        <div class="setting">
                            <a href="#" class="myakun d-flex align-items-center gap-1 px-2 rounded-5">
                                <label class="fw-bold">Akun</label>
                                <i class="ri-user-star-fill fs-5"></i>
                            </a>
                            <a href="../logout.php" class="mylogout d-flex align-items-center justify-content-center"><i class="ri-logout-circle-r-line fs-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- end navbar -->

    <!-- content -->
    <main>
        <section class="container-fluid p-0 hero">
            <div class="container">
                <div class="row mt-3 d-flex flex-column flex-lg-row text-center text-md-start">
                    <div class="col-md-6">
                        <img src="../asset/img/PNG/admin.png" alt="alternatif" class="img-fluid">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-between">
                        <div class="container">
                            <h3 class="ps-1 mt-5">Data <span class="myadmin fw-semibold">Admin</span>.</h3>
                            <div class="shadow p-3 mb-2 bg-white">
                                <div class="top py-2 mb-2">
                                    <h6 class="m-0 fw-bold">Daftar data admin</h6>
                                </div>
                                <div class="bottom overflow-auto">
                                    <table id="Tabeladmin" class="table table-responsive table-striped table-hover table-bordered">
                                        <thead class="bg-yellow">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Level</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $no . "</td>";
                                                    echo "<td class='text-center'>" . $row['username'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                    echo "<td class='text-center'>" . $row['level'] . "</td>"; ?>
                                                    <td class="iconAksi">
                                                        <a href="deleteAdmin.php?id_admin=<?php echo $row['id_admin'] ?>" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash3"></i></a>
                                                        <a href="" class='btn btn-warning btn-sm' data-bs-toggle="modal" data-bs-target="#updateAdmin<?php echo $no; ?>">
                                                            <i class="bi bi-pencil-square"></i></a>
                                                    </td>
                                                    <!-- Modal Update Data -->
                                                    <div class="modal fade" id="updateAdmin<?php echo $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Data Admin</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body bg-yellow">
                                                                    <!-- Form untuk menampilkan elemen select -->
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-12">
                                                                            <form action="updateAdmin.php" method="post">
                                                                                <div class="col">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="idAdmin" class="form-label">Id Admin</label>
                                                                                            <input type="text" name="idAdmin" id="idAdmin" class="form-control mb-3" value="<?php echo $row['id_admin']; ?>" readonly>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label for="username" class="form-label">Username</label>
                                                                                            <input type="text" id="username" name="username" class="form-control mb-3" value="<?php echo $row['username']; ?>" placeholder="username new" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="nama" class="form-label">Nama</label>
                                                                                            <input type="text" name="nama" id="nama" class="form-control mb-3" value="<?php echo $row['nama']; ?>" placeholder="name new" required>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <label for="password" class="form-label">Password</label>
                                                                                            <input type="password" name="password" id="password" class="form-control mb-3" placeholder="password new" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class=" col">
                                                                                        <label for="email" class="form-label">Email</label>
                                                                                        <input type="email" id="email" name="email" class="form-control mb-3" value="<?php echo $row['email']; ?>" placeholder="email new" required>
                                                                                        <label for="level" class="form-label">Level</label>
                                                                                        <select name="level" id="level" class="form-select mb-3" required>
                                                                                            <option value="Admin" <?php if ($row['level'] == "Admin") echo "selected"; ?>>Admin</option>
                                                                                            <option value="User" <?php if ($row['level'] == "User") echo "selected"; ?>>User</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" class="btn_ms">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal Update Data -->
                                            <?php
                                                    echo "</tr>";
                                                    $no++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Form Tambah Data -->
                        <div class="tambah d-flex justify-content-end mt-3 pb-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="tambahdata border border-0" data-bs-toggle="modal" data-bs-target="#tambahAdmin">
                                Tambah Data
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="tambahAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Admin</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-yellow">
                                            <!-- Form untuk menampilkan elemen select -->
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <form action="tambahAdmin.php" method="post">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="idAdmin" class="form-label">Id Admin</label>
                                                                    <input type="text" name="idAdmin" id="idAdmin" class="form-control mb-3" value="<?php echo $kodeoto; ?>" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="username" class="form-label">Username</label>
                                                                    <input type="text" id="username" name="username" class="form-control mb-3" placeholder="input username" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" id="nama" name="nama" class="form-control mb-3" placeholder="input name" required>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="password" class="form-label">Password</label>
                                                                    <input type="password" id="password" name="password" class="form-control mb-3" placeholder="input password" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" id="email" name="email" class="form-control mb-3" placeholder="input email" required>
                                                            <label for="level" class="form-label">Level</label>
                                                            <select id="level" name="level" class="form-select mb-3" required>
                                                                <option value="">--Pilih--</option>
                                                                <option value="admin">admin</option>
                                                                <option value="user">user</option>
                                                            </select>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="submit" class="btn_ms">Kirim</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                        <!-- End Form Tambah Data -->
                    </div>
                </div>

                <div class="row mt-5 d-flex flex-column flex-lg-row text-center text-md-start">
                    <div class="col-md-6">
                        <div class="shadow p-3 mb-2 bg-white">
                            <div class="top py-2 mb-2">
                                <h6 class="m-0 fw-bold">Daftar data user</h6>
                            </div>
                            <div class="bottom overflow-auto">
                                <table id="TabelUser" class="table table-responsive table-striped table-hover table-bordered">
                                    <thead class="bg-yellow">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Telp</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($resultUser) > 0) {
                                            $no = 1;
                                            while ($row = mysqli_fetch_assoc($resultUser)) {
                                                echo "<tr>";
                                                echo "<td class='text-center'>" . $no . "</td>";
                                                echo "<td class='text-center'>" . $row['username'] . "</td>";
                                                echo "<td class='text-center'>" . $row['nama'] . "</td>";
                                                echo "<td class='text-center'>" . $row['email'] . "</td>";
                                                echo "<td class='text-center'>" . $row['telp'] . "</td>";
                                                echo "<td class='text-center'>" . $row['level'] . "</td>"; ?>
                                                <td class="iconAksi">
                                                    <a href="deleteUser.php?id_user=<?php echo $row['id_user'] ?>" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </td>
                                        <?php
                                                echo "</tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-between">
                        <div class="container">
                            <div class="shadow p-3 mb-2 bg-white">
                                <div class="top py-2 mb-2">
                                    <h5>Input Hasil Rekomendasi pada kelompok tani</h5>
                                </div>
                                <div class="bottom overflow-auto">
                                    <form action="./uploadHasil.php" method="post" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <input type="file" name="pdfFile" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <button class="btn btn-outline-success" type="submit" value="Upload" id="inputGroupFileAddon04">Upload</button>
                                        </div>
                                    </form>
                                    <div class="bg-white mt-3">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th>Nama File</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $uploadDir = 'uploads/';
                                                $pdfFound = false; // Menandai apakah ada file PDF ditemukan
                                                if (is_dir($uploadDir)) {
                                                    if ($dh = opendir($uploadDir)) {
                                                        while (($file = readdir($dh)) !== false) {
                                                            if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
                                                                $pdfFound = true; // Menandai bahwa ada file PDF
                                                                echo '<tr>';
                                                                echo '<td><a href="' . $uploadDir . $file . '" download class="text-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">' . $file . '</a></td>';
                                                                echo '<td><a href="deleteFile.php?file=' . urlencode($file) . '" onclick="return confirm(\'Apakah anda yakin menghapus file ini?\')" class="btn btn-danger">Delete</a></td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                        closedir($dh);
                                                        // Jika tidak ada file PDF ditemukan
                                                        if (!$pdfFound) {
                                                            echo '<tr><td class="text-center" colspan="2">File kosong</td></tr>';
                                                        }
                                                    } else {
                                                        echo '<tr><td colspan="2">Could not open the directory.</td></tr>';
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="2">Upload directory does not exist.</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f4f9f9" fill-opacity="1" d="M0,64L48,90.7C96,117,192,171,288,176C384,181,480,139,576,149.3C672,160,768,224,864,218.7C960,213,1056,139,1152,96C1248,53,1344,43,1392,37.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </main>
    <!-- end content -->

    <!-- footer -->
    <footer class="container-fluid p-0 text-dark putih">
        <div class="container">
            <div class="row">
                <div class="col text-secondary text-center">
                    <p class="m-0 fw-bold">Copyrights © 2024</p>
                    <p class="m-0 fw-bold">Dinas Pertanian Kota Padang</p>
                    <p>Jl. Raya Sei Lareh, Lubuk Minturun, Kec. Koto Tangah, Kota Padang, Sumatera Barat 25586</p>
                </div>
            </div>
            <div class="row">
                <div class="col text-secondary text-center">
                    <span class="fw-bold">Create By Arlaa</span>
                    <div class="text-center pb-3">
                        <p class="d-flex justify-content-center flex-wrap">
                            <span class="me-3">
                                <i class="bi bi-envelope-at"></i> <a href="" class="text-decoration-none text-secondary">febrianusarif19@gmail.com</a>
                            </span>
                            <span class="me-3">
                                <i class="bi bi-instagram"></i> <a href="https://www.instagram.com/arlaaa_19/" class="text-decoration-none text-secondary">arlaaa_19</a>
                            </span>
                            <span><i class="bi bi-whatsapp"></i> <a href="" class="text-decoration-none text-secondary">082289522036</a></span>

                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- end footer -->

    <!-- datatables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $("#Tabeladmin").DataTable({
                pagingType: 'simple',
                lengthMenu: [
                    [5],
                    [5],
                ],
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    zeroRecords: "Tidak ada data yang tersedia.",
                    infoEmpty: "Menampilkan 0 dari 0 data",
                    infoFiltered: "(disaring dari total data)",
                },
            });
        });

        $(document).ready(function() {
            $("#TabelUser").DataTable({
                pagingType: 'simple',
                lengthMenu: [
                    [5],
                    [5],
                ],
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    zeroRecords: "Tidak ada data yang tersedia.",
                    infoEmpty: "Menampilkan 0 dari 0 data",
                    infoFiltered: "(disaring dari total data)",
                },
            });
        });
    </script>


    <!-- bootstrap js -->
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>

</html>