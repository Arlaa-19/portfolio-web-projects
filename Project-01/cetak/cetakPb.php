<?php
session_start();
include("../connection/connect.php");
$conn = connectDB("localhost", "root", "", "spk_vikor");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kepalaDinas = $_POST['kepalaDinas'];
    $nipkepalaDinas = $_POST['nipkepalaDinas'];
    $kepalaBidang = $_POST['kepalaBidang'];
    $nipkepalaBidang = $_POST['nipkepalaBidang'];

    $currentDateOnly = date('d-m-Y');
}

if (isset($_GET['topCount'])) {
    $_SESSION['topCount'] = $_GET['topCount'];
}

$topCount = $_SESSION['topCount'] ?? null;
$start_date = $_SESSION['start_date'] ?? null;
$end_date = $_SESSION['end_date'] ?? null;


// Query ke database untuk mendapatkan hasil dari tabel_hasil
$query = "SELECT * FROM tabel_hasil";
$result = $conn->query($query);

// Inisialisasi variabel untuk menyimpan hasil dari database
$alternatif = [];
$Q = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alternatif[] = [
            'nama_kelompok' => $row['nama_kelompok'],
            'alternatif' => $row['alternatif']
        ];
        $Q[] = $row['nilai_Q'];
    }
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

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" />

    <!-- my style css -->
    <link rel="stylesheet" href="../asset/css/style-cetak.css.css">
</head>

<body>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
    <!-- content -->
    <main>
        <section class="min-vh-100 d-flex flex-column justify-content-between page">
            <?php if (!empty($Q)) {
                include("../vikor/perhitunganVikor.php");
                $_SESSION['Q'] = $Q;
                $_SESSION['alternatif'] = $alternatif; ?>
                <!-- Jika ada data yang tersimpan di tabel hasil, tampilkan konten -->
                <div class="contentTop">
                    <div class="row myborderB mb-4">
                        <div class="col-12 p-0">
                            <div class="d-flex">
                                <div class="col-2 d-flex justify-content-center align-items-center"><img src="../asset/img/logo.png" alt="logo" class="myimg"></div>
                                <div class="col-8 d-flex justify-content-center p-0">
                                    <div class="teks-judul">
                                        <p class="m-0 fs-6">PEMERINTAH KOTA PADANG</p>
                                        <p class="m-0 fs-1 fw-bold">DINAS PERTANIAN</p>
                                        <p class="m-0 fs-6">Jalan Sungai Lareh Lubuk Minturun Telp & Fax (0751) 495892 </p>
                                        <p class="m-0 fs-6">Email : <a href=""> dipertakotapadang@gmail.com</a></p>
                                        <p class="m-0 fs-6 fw-bold">Padang - Sumatera Barat</p>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <h6 class="fw-bold text-center">Hasil Sistem Pendukung Keputusan Penilaian Alternatif Terbaik Penerima Bantuan Sarana Produksi Pertanian
                        </h6>
                    </div>


                    <div class="row">
                        <div class="col">
                            <h6 class="fw-bold text-center">Perhitungan Alternatif dan Kriteria dengan menggunakan Metode VIKOR:</h6>
                            <!-- Nilai Q -->
                            <!-- Pembobotan Alternatif -->
                            <div class="bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-table"></i> Pembobotan Alternatif</h6>
                                </div>
                                <div class="bottom">
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
                            <div class="bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-pie-chart-fill"></i> Bobot Kriteria (/100)</h6>
                                </div>
                                <div class="bottom">
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
                            <div class="bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-graph-down"></i> Matriks Keputusan (X)</h6>
                                </div>
                                <div class="bottom">
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
                            <div class="bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-grid-3x3-gap-fill"></i> Matriks Normalisasi (R)</h6>
                                </div>
                                <div class="bottom">
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
                            <div class="bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-grid-3x3-gap-fill"></i> Matriks Normalisasi Terbobot (F)</h6>
                                </div>
                                <div class="bottom">
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
                            <div class="rounded bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-grid-3x3-gap-fill"></i> Nilai S<sub>i</sub> dan R<sub>i</sub></h6>
                                </div>
                                <div class="bottom">
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
                            <div class="bg-white">
                                <div class="top py-1 mb-2">
                                    <h6 class="m-0 fw-bold"><i class="bi bi-bar-chart-line-fill"></i> Nilai Q<sub>i</sub></h6>
                                </div>
                                <div class="bottom">
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
                    </div>

                    <div class="row teks-cetak mt-3">
                        <p>Berdasarkan dari Hasil Perangkingan di atas, maka kami merekomendasikan alternatif yang memiliki nilai akhir terkecil
                            mendekati 0 (dari indeks 0 sampai indeks 1) sebagai alternatif terbaik penerima bantuan sarana produksi pertanian dari Dinas Pertanian Kota Padang.</p>
                        <div>
                            <p class="m-0">Adapun alternatif terpilih sebagai Kelompok tani Penerima bantuan sarana produksi pernian dari Dinas Pertnian Kota Padang, yaitu:</p>
                            <?php
                            // Ambil tiga (atau sesuai dengan jumlah yang dimasukkan pengguna) nilai teratas dari $Q
                            $topResults = array_slice($Q, 0, $topCount, true);
                            $rank = 1;
                            foreach ($topResults as $key => $value) {
                                $hasil_alternatif = empty($alternatif[$key]['alternatif']) ? 'Belum ada!' : $alternatif[$key]['nama_kelompok'];
                                $hasil_Q = round($value, 4);
                                echo "<b>Rank $rank:</b> <font color='red'>" . $hasil_alternatif . "</font> dengan nilai akhir <i>(Q<sub>i</sub>)</i> <b><font color='red'>" . $hasil_Q . "</font></b>.<br>";
                                $rank++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="contentBot mt-5 pt-5">
                    <div class="row">
                        <div class="col-6 text-center mt-5">
                            <p class="m-0">Diketahui oleh :</p>
                            <p>Kepala Dinas Pertanian Kota Padang</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p class="m-0"><?= $kepalaDinas  ?></p>
                            <p>NIP. <?= $nipkepalaDinas  ?></p>
                        </div>
                        <div class="col-6 text-center mt-5">
                            <p class="m-0">Padang, <?= $currentDateOnly ?></p>
                            <p>Kabid Tanaman Pangan dan Hortikultura</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p class="m-0"><?= $kepalaBidang  ?></p>
                            <p>NIP. <?= $nipkepalaBidang  ?></p>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <!-- Konten yang ditampilkan ketika tidak ada data yang disimpan di tabel hasil -->
                <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                    <a href="./penilaianVikor.php" class="text-center warning rounded-2 shadow-sm p-4 m-0 fs-5 fw-bold">Belum ada hasil perhitungan yang disimpan.</a>
                </div>
            <?php } ?>
        </section>
    </main>
    <!-- end content -->


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