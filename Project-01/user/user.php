<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if (empty($_SESSION['username'])) {
    echo "<script>window.location.href = 'landingPage.php';</script>";
    exit();
} else {
    $myadmin = $_SESSION['username'];
}

$query = "SELECT * FROM tabel_user WHERE username='$myadmin'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $rowUser = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Pengguna tidak ditemukan atau query gagal.'); window.location.href = '../landingPage.php';</script>";
}
$queryHasil = "SELECT * FROM tabel_hasil";
$resultHasil = mysqli_query($conn, $queryHasil);
$rows = [];
while ($row = mysqli_fetch_assoc($resultHasil)) {
    $rows[] = $row;
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
                <div class="d-flex">
                    <img src="../asset/img/logo.png" class="logo-img pe-1" alt="">
                    <a class="navbar-brand lh-1 p-0 fw-bold" href="../index.php">Dinas Pertanian<br><span class="fs-5">Kota Padang</span></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Dinas Pertanian<br><span class="fs-5">Kota Padang</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body navbar-nav justify-content-md-end flex-grow-1">
                        <div class="setting">
                            <a href="#" class="myakun d-flex align-items-center gap-1 px-2 rounded-5" data-bs-toggle="modal" data-bs-target="#updateData">
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
        <!-- Modal Update Data -->
        <div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Data User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-yellow">
                        <!-- Form untuk menampilkan elemen select -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <form action="updateUser.php" method="post">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="idUser" class="form-label">Id Admin</label>
                                                <input type="text" name="idUser" id="idUser" class="form-control mb-2" value="<?php echo $rowUser['id_user']; ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="username" class="form-control mb-2" value="<?php echo $rowUser['username']; ?>" placeholder="username new" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control mb-2" value="<?php echo $rowUser['nama']; ?>" placeholder="name new" required>
                                            </div>
                                            <div class="col">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" id="password" class="form-control mb-2" placeholder="your password / new" required>
                                            </div>
                                        </div>
                                        <div class=" col">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control mb-2" value="<?php echo $rowUser['email']; ?>" placeholder="email new" required>
                                            <label for="telp" class="form-label">Email</label>
                                            <input type="text" id="telp" name="telp" class="form-control mb-2" value="<?php echo $rowUser['telp']; ?>" placeholder="email new" required>
                                            <label for="level" class="form-label">Level</label>
                                            <select name="level" id="level" class="form-select mb-3" required>
                                                <option value="User" <?php if ($rowUser['level'] == "User") echo "selected"; ?>>User</option>
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
        <section class="container-fluid p-0 hero">
            <div class="container">
                <div class="row mt-3 d-flex flex-column-reverse flex-md-row text-center text-md-start">
                    <div class="col align-content-center">
                        <h3 class="ps-1 mt-3">Selamat Datang <span class="myadmin fw-semibold text-uppercase"> <?= $myadmin ?></span>.</h3>
                        <h1 class="display-5 fw-semibold">Kelompok Tani Penerima<br>Bantuan Sarana Produksi Pertanian</h1>
                        <p class="fs-5">
                            <span>Sistem Pendukung Keputusan</span> ini telah menerapkan Metode
                            VIKOR dalam melakukan perhitungannya untuk menghasilkan keputusan yang akurat dan objektif.
                        </p>
                        <div class="b-start justify-content-center justify-content-md-start">
                            <a href="#dinas" class="b-read">Read more<i class="bi bi-caret-down-fill"></i></a>
                        </div>
                    </div>
                    <div class="col">
                        <img src="../asset/img/PNG/user.png" alt="bg1" class="bg-img img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="container-fluid p-0" id="dinas">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#a0deff" fill-opacity="1" d="M0,96L34.3,85.3C68.6,75,137,53,206,42.7C274.3,32,343,32,411,42.7C480,53,549,75,617,101.3C685.7,128,754,160,823,149.3C891.4,139,960,85,1029,53.3C1097.1,21,1166,11,1234,21.3C1302.9,32,1371,64,1406,80L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
            </svg>
            <div class="container">
                <div class="row d-flex px-2 px-md-0">
                    <div class="col-md-7">
                        <!-- Nilai Q -->
                        <div class="shadow p-2 mb-3 bg-white">
                            <div class="top py-2 mb-2">
                                <h6 class="m-0 fw-bold text-dark">Hasil Akhir Seleksi Alternatif</h6>
                            </div>
                            <div class="bottom">
                                <table id="TabelHasil" class="table table-responsive table-striped table-hover table-bordered">
                                    <thead class="bg-yellow">
                                        <tr>
                                            <th class="text-center">Nama Kelompok</th>
                                            <th class="text-center"><i>(Q<sub>i</sub>)</i></th>
                                            <th class="text-center">Rangking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch each row from the result set
                                        asort($rows);
                                        $ranking = 1;
                                        foreach ($rows as $key) {
                                            $nama_kelompok = $key['nama_kelompok'];
                                            $nilai_q = $key['nilai_Q'];
                                            // Display each row in a table row
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $nama_kelompok; ?></td>
                                                <td class="text-center"><?php echo round($nilai_q, 4); ?></td>
                                                <td class="text-center"><?php echo $ranking; ?></td>
                                            </tr>
                                        <?php
                                            $ranking++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="shadow p-3 mb-3 mb-md-0 border-dashed text-light">
                            <p class="m-0">Berdasarkan dari Hasil Akhir Perangkingan di atas, maka <span class="fw-bold myadmin">Rekomendasi</span> Kelompok Tani terpilih penerimana bantuan sarana produksi pertanian, dapat dilihat pada hasil di bawah ini.</p>
                            <div class="bg-white mt-3">
                                <table class="table table-responsive table-striped table-hover table-bordered">
                                    <thead class="bg-yellow">
                                        <tr>
                                            <th>Unduh File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $uploadDir = '../admin/uploads/';
                                        $pdfFound = false; // Menandai apakah ada file PDF ditemukan
                                        if (is_dir($uploadDir)) {
                                            if ($dh = opendir($uploadDir)) {
                                                while (($file = readdir($dh)) !== false) {
                                                    if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
                                                        $pdfFound = true; // Menandai bahwa ada file PDF
                                                        echo '<tr>';
                                                        echo '<td><a href="' . $uploadDir . $file . '" download class="text-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">' . $file . '</a></td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                                closedir($dh);
                                                // Jika tidak ada file PDF ditemukan
                                                if (!$pdfFound) {
                                                    echo '<tr><td class="text-center fst-italic myadmin" colspan="2">File Belum Di Update</td></tr>';
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
                    <div class="col-md-5 border-dashed p-2 text-light">
                        <h2 class="dinasper text-center text-md-start">Dinas Pertanian Kota Padang</h2>
                        <p class="text-center text-md-start">
                            Dinas Perikanan dan Pangan Kota Padang adalah Lembaga Teknis
                            Daerah yang merupakan unsur pelaksanaan Pemerintah Daerah dengan
                            tugas pokok melakukan peaksanaan Pemerintah Daerah di Bidang
                            Perikanan dan Pangan.
                        </p>
                        <p class="m-0 deskripsi">Berikut Visi dan Misi Dinas Perikanan dan Pangan Kota Padang:</p>
                        <p class="m-0">Visi</p>
                        <ul class="m-0 deskripsi">
                            <li>
                                Terwujudnya Pertanian Perkotaan Berbasis Agribisnis Dan
                                Berwawasan Lingkungan
                            </li>
                        </ul>
                        <p class="m-0">Misi</p>
                        <ul class="deskripsi m-0">
                            <li>Memacu Peningkatan Produksi Pertanian Berkelanjutan.</li>
                            <li>
                                Mendorong Peningkatan Pasca Panen, Pengolahan dan Pemasaran
                                Hasil Pertanian.
                            </li>
                            <li>
                                Mewujudkan Sistem Pelayanan Birokrasi Yang Efektif Dan Efisien.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f4f9f9" fill-opacity="1" d="M0,32L40,48C80,64,160,96,240,101.3C320,107,400,85,480,106.7C560,128,640,192,720,208C800,224,880,192,960,197.3C1040,203,1120,245,1200,250.7C1280,256,1360,224,1400,208L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
            </svg>
        </section>
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
                                <i class="bi bi-instagram"></i> <a href="" class="text-decoration-none text-secondary">arlaaa_19</a>
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
            $("#TabelHasil").DataTable({
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