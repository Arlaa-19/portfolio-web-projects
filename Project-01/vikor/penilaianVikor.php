<?php
session_start();
include("../connection/connect.php");
// $conn = connectDB("localhost", "root", "", "spk_vikor");

// Ambil parameter tanggal dari form
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $_SESSION['start_date'] = $_GET['start_date'];
    $_SESSION['end_date'] = $_GET['end_date'];
}

$start_date = $_SESSION['start_date'] ?? null;
$end_date = $_SESSION['end_date'] ?? null;
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
                                <a class="nav-link text-dark-emphasis active" href="#">Penilaian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="./hasilPerhitungan.php">Hasil Akhir</a>
                            </li>
                        </ul>
                        <div class="setting">
                            <a href="../admin/admin.php" class="myakun d-flex align-items-center gap-1 px-2 rounded-5">
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
        <section class="container-fluid p-0 hero mt-0">
            <div class="container min-vh-100 p-0">
                <?php
                // Pastikan koneksi database telah diinisialisasi sebelumnya
                // Misalnya, menggunakan variabel $conn
                if (isset($start_date) && isset($end_date)) {
                    $queryK = 'SELECT * FROM tabel_kriteria';
                    $resultK = $conn->query($queryK);

                    // Cek jika hasil query tabel_kriteria kosong
                    if ($resultK->num_rows === 0) { ?>
                        <!-- Konten yang ditampilkan ketika data kriteria tidak ada -->
                        <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                            <a href="../kriteria/kriteria.php" class="text-center warning rounded-2 shadow-sm p-4 m-0 fs-5 fw-bold">Tidak ada data Kriteria</a>
                        </div>
                        <?php
                    } else {
                        $queryA = "SELECT * FROM tabel_alternatif WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
                        $resultA = $conn->query($queryA);

                        // Cek jika hasil query tabel_alternatif kosong
                        if ($resultA->num_rows === 0) { ?>
                            <!-- Konten yang ditampilkan ketika data alternatif tidak ada -->
                            <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                                <a href="../alternatif/alternatif.php" class="text-center warning rounded-2 shadow-sm p-4 m-0 fs-5 fw-bold">Tidak ada data Alternatif</a>
                            </div>
                        <?php
                        } else {
                            include("./perhitunganVikor.php");
                            $_SESSION['Q'] = $Q;
                            $_SESSION['alternatif'] = $alternatif;
                        ?>
                            <!-- Jika kondisi terpenuhi, tampilkan konten -->
                            <div class="container-fluid d-flex justify-content-center flex-column align-items-center min-vh-100">
                                <div class="container d-flex mb-3 mt-5 pt-5">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="../asset/img/PNG/penilaian.png" alt="penilaian" class="img-fluid mb-3" style="border: 2px dashed var(--second);">
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="text-center bg-yellow rounded-2 shadow-sm p-4 mb-3">Penilaian Alternatif dengan Perhitungan Metode VIKOR</h5>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="d-flex flex-column justify-content-center p-2" style="border: 2px dashed var(--second);">
                                                        <p class="fw-bolder text-center">Silahakn Klik Tombol di bawah ini untuk mencetak Hasil Perhitungan</p>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btnCetak rounded-2 px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                            Cetak
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Silahkan isi data berikut</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form untuk menampilkan elemen select -->
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-12">
                                                                                <form action="../cetak/cetakPenilaian.php" method="POST" target="_blank">
                                                                                    <div class="mb-3">
                                                                                        <div class="col-12 mb-3">
                                                                                            <label for="kepalaDinas" class="form-label">Nama Kepala Dinas</label>
                                                                                            <input type="text" name="kepalaDinas" class="form-control" id="kepalaDinas" placeholder="input nama kepala dinas" required>
                                                                                        </div>
                                                                                        <div class="col-12 mb-3">
                                                                                            <label for="nipkepalaDinas" class="form-label">NIP Kepala Dinas</label>
                                                                                            <input type="text" name="nipkepalaDinas" class="form-control" id="nipkepalaDinas" placeholder="input NIP" required>
                                                                                        </div>
                                                                                        <!-- <div class="col-12 mb-3">
                                                                                            <label for="kepalaBidang" class="form-label">Nama Kepala Bidang</label>
                                                                                            <input type="text" name="kepalaBidang" class="form-control" id="kepalaBidang" placeholder="input nama kepala bidang" required>
                                                                                        </div>
                                                                                        <div class="col-12 mb-3">
                                                                                            <label for="nipkepalaBidang" class="form-label">NIP Kepala Bidang</label>
                                                                                            <input type="text" name="nipkepalaBidang" class="form-control" id="nipkepalaBidang" placeholder="input NIP" required>
                                                                                        </div> -->
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
                                                        <!-- Tombol Simpan Hasil -->
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <!-- Form untuk memasukkan jumlah top ranking yang diinginkan -->
                                                    <form action="hasilPerhitungan.php" method="get" class="p-3" style="border: 2px dashed var(--second);">
                                                        <label for="floatingInput" class="fw-bolder text-center mb-2">Jumlah Penerima Bantuan Sarana Produksi Pertanian</label>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="topCount" min="1" max="10" required>
                                                            <label for="floatingInput" class="text-secondary">inputkan jumlah</label>
                                                        </div>
                                                        <button type="submit" class="form-control form-control-sm mb-2 btnKirim">Kirim</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pembobotan Alternatif -->
                                <div class="container shadow p-3 mb-5 bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-table"></i> Pembobotan Alternatif</h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th class="text-start">Alternatif</th>
                                                    <th class="text-start">Nama Kelompok</th>
                                                    <?php foreach ($kriteria as $k) { ?>
                                                        <th class="text-start"><?php echo $k['keterangan']; ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alternatif as $key => $rowA) { ?>
                                                    <tr>
                                                        <td class="text-start"><?php echo $rowA['alternatif']; ?></td>
                                                        <td class="text-start"><?php echo $rowA['nama_kelompok']; ?></td>
                                                        <?php foreach ($nilaiAlternatif[$key] as $value) { ?>
                                                            <td><?php echo $value; ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Bobot Kriteria -->
                                <div class="container shadow p-3 mb-5 bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-pie-chart-fill"></i> Bobot Kriteria (/100)</h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <?php foreach ($kriteria as $c) : ?>
                                                        <th class="text-start"><?php echo $c['kriteria']; ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($bobotKriteria as $value) { ?>
                                                        <td><?php echo $value; ?></td>
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Matriks x -->
                                <div class="container shadow p-3 mb-5 bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-graph-down"></i> Matriks Keputusan (X)</h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th class="text-center">Alternatif</th>
                                                    <?php foreach ($kriteria as $c) : ?>
                                                        <th class="text-start"><?php echo $c['kriteria']; ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alternatif as $key => $rowA) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $rowA['alternatif']; ?></td>
                                                        <?php foreach ($nilaiAlternatif[$key] as $value) { ?>
                                                            <td><?php echo $value; ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th class="text-center">Max</th>
                                                    <!-- Loop melalui max untuk menambahkan nilai max -->
                                                    <?php foreach ($max as $key => $mx) { ?>
                                                        <td class="fw-bold"><?php echo $mx; ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Min</th>
                                                    <!-- Loop melalui min untuk menambahkan nilai min -->
                                                    <?php foreach ($min as $key => $mn) { ?>
                                                        <td class="fw-bold"><?php echo $mn; ?></td>
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- Matriks Normalisasi R -->
                                <div class="container shadow p-3 mb-5 bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-grid-3x3-gap-fill"></i> Matriks Normalisasi (R)</h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th class="text-center">Alternatif</th>
                                                    <?php foreach ($kriteria as $c) : ?>
                                                        <th class="text-start"><?php echo $c['kriteria']; ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alternatif as $key => $rowA) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $rowA['alternatif']; ?></td>
                                                        <?php foreach ($normalisasi[$key] as $value) { ?>
                                                            <td><?php echo round($value, 4); ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- Matriks Normalisasi Terbobot F -->
                                <div class="container shadow p-3 mb-5 bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-grid-3x3-gap-fill"></i> Matriks Normalisasi Terbobot (F)</h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th class="text-center">Alternatif</th>
                                                    <?php foreach ($kriteria as $c) : ?>
                                                        <th class="text-start"><?php echo $c['kriteria']; ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alternatif as $key => $rowA) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $rowA['alternatif']; ?></td>
                                                        <?php foreach ($F[$key] as $value) { ?>
                                                            <td><?php echo round($value, 4); ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- Nilai S dan R -->
                                <div class="container shadow p-3 mb-5 rounded bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-grid-3x3-gap-fill"></i> Nilai S<sub>i</sub> dan R<sub>i</sub></h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th class="text-center">Alternatif</th>
                                                    <th class="text-center">(S<sub>i</sub>)</th>
                                                    <th class="text-center">(R<sub>i</sub>)</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alternatif as $key => $rowA) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $rowA['alternatif']; ?></td>
                                                        <td class="text-center"><?php echo round($S[$key], 4); ?></td>
                                                        <td class="text-center"><?php echo round($R[$key], 4); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td class=" text-center fw-bolder">S<sup>-</sup></td>
                                                    <td class="text-center fw-bolder text-danger"><?php echo round($S_min, 4); ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bolder">S<sup>+</sup></td>
                                                    <td class="text-center fw-bolder text-danger"><?php echo round($S_max, 4); ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bolder">R<sup>-</sup></td>
                                                    <td></td>
                                                    <td class="text-center fw-bolder text-danger"><?php echo round($R_min, 4); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center fw-bolder">R<sup>+</sup></td>
                                                    <td></td>
                                                    <td class="text-center fw-bolder text-danger"><?php echo round($R_max, 4); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Nilai Q -->
                                <div class="container shadow p-3 mb-5 bg-white">
                                    <div class="top py-1 mb-2">
                                        <h6 class="m-0 fw-bold"><i class="bi bi-bar-chart-line-fill"></i> Nilai Q<sub>i</sub></h6>
                                    </div>
                                    <div class="bottom overflow-auto">
                                        <table class="table table-responsive table-striped table-hover table-bordered">
                                            <thead class="bg-yellow">
                                                <tr>
                                                    <th class="text-center">Nama Kelompok</th>
                                                    <th class="text-center">Alternatif</th>
                                                    <th class="text-center"><i>(Q<sub>i</sub>)</i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alternatif as $key => $rowA) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $rowA['nama_kelompok']; ?></td>
                                                        <td class="text-center"><?php echo $rowA['alternatif']; ?></td>
                                                        <td class="text-center"><?php echo round($Q[$key], 4); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                } else { ?>
                    <!-- Konten yang ditampilkan ketika kondisi tidak terpenuhi -->
                    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                        <a href="../alternatif/alternatif.php" class="text-center warning rounded-2 shadow-sm p-4 m-0 fs-5 fw-bold">Silahkan Inputkan data Alternatif dan Kriteria</a>
                    </div>
                <?php }
                ?>
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
    <!-- bootstrap js -->
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>

</html>