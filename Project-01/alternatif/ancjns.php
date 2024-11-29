<?php
include('../connection/connect.php');
$conn = connectDB("localhost", "root", "", "spk_vikor");

// Fetch kriteria data
$queryKriteria = "SELECT * FROM tabel_kriteria";
$resultKriteria = mysqli_query($conn, $queryKriteria);
$kriteriaList = array();
while ($rowKriteria = mysqli_fetch_assoc($resultKriteria)) {
    $kriteriaList[] = $rowKriteria;
}


if (isset(($_POST['start_date'])) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $queryAlternatif = "SELECT * FROM tabel_alternatif WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
    $resultAlternatif = mysqli_query($conn, $queryAlternatif);
} else {
    // Query default jika tidak ada data sesi
    $queryAlternatif = "SELECT * FROM tabel_alternatif";
    $resultAlternatif = mysqli_query($conn, $queryAlternatif);
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
                                <a class="nav-link text-dark-emphasis active" href="#">Alternatif</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="../vikor/penilaianVikor.php">Penilaian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="../vikor/hasilPerhitungan.php">Hasil Akhir</a>
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
        <section class="container-fluid p-0 hero">
            <div class="container">
                <div class="row mt-3 d-flex flex-column flex-lg-row text-center text-md-start">
                    <div class="col-md-5">
                        <img src="../asset/img/PNG/al.png" alt="alternatif" class="img-fluid">
                    </div>
                    <div class="col-md-7 d-flex flex-column justify-content-between">
                        <div class="container">
                            <h3 class="ps-1 mt-5">List Alternatif Bantuan<br><span class="myadmin fw-semibold">Sarana Produksi Pertanian</span>.</h3>
                            <!-- input form -->
                            <form action="" method="POST" class="row mt-4 py-3 formInput">
                                <div class="inputAksi col-9">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" name="nama" class="form-control form-control-sm mb-2" placeholder="Tanggal awal -->" disabled>
                                            <input type="text" name="jabatan" class="form-control form-control-sm" placeholder="Tanggal akhir -->" disabled>
                                        </div>
                                        <div class="col-6">
                                            <input type="date" name="start_date" class="form-control form-control-sm mb-2" placeholder="First name" aria-label="First name">
                                            <input type="date" name="end_date" class="form-control form-control-sm" placeholder="First name" aria-label="First name">
                                        </div>
                                    </div>
                                </div>
                                <div class="aksi col-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" name="filter" class="form-control form-control-sm mb-2 filter">Filter</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <a href="../vikor/penilaianVikor.php?start_date=<?= $start_date; ?> &end_date=<?= $end_date; ?>" class="form-control form-control-sm cetak">Hitung</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- end input form -->
                        </div>

                        <div class="tambah d-flex justify-content-between mt-3 pb-3">
                            <a href="./deleteAll.php" class="deldata">Kosongkan Data</a>
                            <a href="./tambahAlternatif.php" class="tambahdata">Tambah Alternatif</a>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <!-- table -->
                        <div class="container overflow-auto">
                            <table id="example" class="table table-responsive table-striped table-hover table-bordered">
                                <thead class="bgtosca">
                                    <tr>
                                        <th class="text-start text-light">Tanggal</th>
                                        <th class="text-start text-light">Nama Kelompok</th>
                                        <th class="text-start text-light">Kecamatan</th>
                                        <th class="text-start text-light">Kelurahan</th>
                                        <th class="text-start text-light">Kriteria</th>
                                        <th class="text-start text-light">Keterangan</th>
                                        <th class="text-start text-light">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <?php
                                    // Loop melalui hasil query alternatif dan tampilkan setiap baris
                                    while ($row = mysqli_fetch_assoc($resultAlternatif)) {
                                        $rowspan = count($kriteriaList);
                                        $firstRow = true;
                                        foreach ($kriteriaList as $kriteria) {
                                            echo "<tr>";
                                            if ($firstRow) {
                                                echo "<td class='text-center' rowspan='{$rowspan}'>{$row['tanggal']}</td>";
                                                echo "<td class='text-center' rowspan='{$rowspan}'>{$row['nama_kelompok']}</td>";
                                                echo "<td class='text-center' rowspan='{$rowspan}'>{$row['kecamatan']}</td>";
                                                echo "<td class='text-center' rowspan='{$rowspan}'>{$row['kelurahan']}</td>";
                                            }
                                            echo "<td class='text-center'>{$kriteria['keterangan']}</td>";
                                            $kriteriaField = str_replace(' ', '_', $kriteria['keterangan']);
                                            echo "<td class='text-center'>{$row[$kriteriaField]}</td>";

                                            if ($firstRow) {
                                                echo "<td rowspan='{$rowspan}'>
                                                    <div class='iconAksi'>
                                                        <a href='deleteAlternatif.php?id_alternatif={$row['id_alternatif']}' class='sampah'><i class='bi bi-trash3'></i></a>
                                                        <a href='updateAlternatif.php?id_alternatif={$row['id_alternatif']}' class='edit'><i class='bi bi-pencil-square'></i></a>
                                                    </div>
                                                </td>";
                                            }
                                            $firstRow = false; // Set to false after the first row
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- end table -->
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
            $("#example").DataTable({
                pagingType: 'simple',
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"],
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