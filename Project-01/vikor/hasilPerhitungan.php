<?php
session_start();
include("../connection/connect.php");
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if (isset($_GET['topCount'])) {
    $_SESSION['topCount'] = $_GET['topCount'];
}

$topCount = $_SESSION['topCount'] ?? null;
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
                                <a class="nav-link text-dark-emphasis" href="./penilaianVikor.php">Penilaian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis active" href="#">Hasil Akhir</a>
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
        <section class="container-fluid p-0 hero mt-0 overflow-auto">
            <?php
            if (isset($topCount)) {
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
                            include("./perhitunganVikor.php"); ?>
                            <!-- Jika kondisi terpenuhi, tampilkan konten -->

                            <div class="container d-flex mb-3 mt-5 pt-5">
                                <div class="row">
                                    <div class="col-md-5 d-flex flex-md-column flex-column-reverse">
                                        <div class="shadow p-2 mb-2 bg-white">
                                            <h5 class="text-center bg-yellow rounded-2 shadow-sm p-2 mb-2">Hasil Penilaian Alternatif dengan Perangkingan</h5>
                                            <p class="m-0 fw-bold text-secondary text-center">Silahkan simpan hasil terlebih dahulu sebelum mencetak hasil.</p>
                                            <div class="myaction d-flex gap-2 justify-content-center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btnCetak rounded-2 px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Cetak Hasil
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
                                                                        <form action="../cetak/cetakHasil.php" method="POST" target="_blank">
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
                                                <form method="post" action="simpan_hasil.php">
                                                    <button type="submit" class="btnHasil rounded-2 px-3 fw-semibold">Simpan Hasil</button>
                                                </form>
                                            </div>
                                        </div>
                                        <img src="../asset/img/PNG/hasil.png" alt="penilaian" class="img-fluid mb-3" style="border: 2px dashed var(--second);">
                                    </div>

                                    <div class="col-md-7">
                                        <!-- Nilai Q -->
                                        <div class="shadow p-2 mb-2 bg-white">
                                            <div class="top py-2 mb-2">
                                                <h6 class="m-0 fw-bold">Hasil Akhir Seleksi Alternatif</h6>
                                            </div>
                                            <div class="bottom">
                                                <table id="TabelHasil" class="table table-responsive table-striped table-hover table-bordered">
                                                    <thead class="bg-yellow">
                                                        <tr>
                                                            <th class="text-center">Alternatif</th>
                                                            <th class="text-center">Nama Kelompok</th>
                                                            <th class="text-center"><i>(Q<sub>i</sub>)</i></th>
                                                            <th class="text-center">Rangking</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Urutkan nilai Q dari yang terkecil ke terbesar
                                                        asort($Q);
                                                        $ranking = 1;
                                                        foreach ($Q as $key => $value) {
                                                        ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $alternatif[$key]['alternatif']; ?></td>
                                                                <td class="text-center"><?php echo $alternatif[$key]['nama_kelompok']; ?></td>
                                                                <td class="text-center"><?php echo round($value, 4); ?></td>
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

                                        <div class="shadow p-3 mb-5 bg-white">
                                            <p class="m-0">Berdasarkan dari Hasil Perangkingan di atas, maka kami merekomendasikan:</p>
                                            <?php
                                            // Ambil tiga (atau sesuai dengan jumlah yang dimasukkan pengguna) nilai teratas dari $Q
                                            $topResults = array_slice($Q, 0, $topCount, true);
                                            $rank = 1;

                                            // Tampilkan hasil ranking
                                            foreach ($topResults as $key => $value) {
                                                $hasil_alternatif = empty($alternatif[$key]['alternatif']) ? 'Belum ada!' : $alternatif[$key]['nama_kelompok'];
                                                $hasil_optimasi = round($value, 4);
                                                echo "<b>Rank $rank:</b> <font color='red'>" . $hasil_alternatif . "</font> dengan nilai optimasi <b><font color='red'>" . $hasil_optimasi . "</font></b><br>";
                                                $rank++;
                                            }
                                            ?>
                                            <p class="m-0">Sebagai Kelompok tani Penerima bantuan sarana produksi pernian dari Dinas Pertnian Kota Padang.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                } else { ?>
                    <!-- Konten yang ditampilkan ketika kondisi tidak terpenuhi -->
                    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                        <a href="../alternatif/alternatif.php" class="text-center warning rounded-2 shadow-sm p-4 m-0 fs-5 fw-bold">Tidak ada data Alternatif</a>
                    </div>
                <?php
                }
            } else { ?>
                <!-- Konten yang ditampilkan ketika kondisi tidak terpenuhi -->
                <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                    <a href="./penilaianVikor.php" class="text-center warning rounded-2 shadow-sm p-4 m-0 fs-5 fw-bold">Inputkan Jumlah Penerimana Bantuan Sarana Produksi Pertanian</a>
                </div>
            <?php }
            ?>
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