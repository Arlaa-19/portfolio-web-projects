<?php
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");
$query  = "SELECT * FROM tabel_kriteria";
$result = $conn->query($query);
// ambil data sub kriteria
$querySubkriteria = "SELECT * FROM tabel_subkriteria";
$resultSubkriteria = mysqli_query($conn, $querySubkriteria);

$sql    = "SELECT MAX(id_subkriteria) AS maxid FROM tabel_subkriteria";
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
                                <a class="nav-link text-dark-emphasis active" href="./kriteria.php">Kriteria</a>
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
                    <div class="col-md-5 d-flex flex-column">
                        <img src="../asset/img/PNG/kriteria.png" alt="kriteria" class="img-fluid mb-4">
                        <div class="tambah d-flex justify-content-between">
                            <!-- Button trigger modal -->
                            <button type="button" class="tambahdata border border-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Tambah Sub kriteria
                            </button>
                            <a href="./tambahKriteria.php" class="tambahdata">Tambah Kriteria</a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h3 class="ps-1 mt-3">List Kriteria Bantuan<br><span class="myadmin fw-semibold">Sarana Produksi Pertanian</span>.</h3>
                        <!-- table -->
                        <div class="container overflow-auto">
                            <table id="TabelKriteria" class="table table-responsive table-striped table-hover table-bordered">
                                <thead class="bgtosca">
                                    <tr>
                                        <th class="text-center text-light">Id Kriteria</th>
                                        <th class="text-center text-light">Kriteria</th>
                                        <th class="text-center text-light">Keterangan</th>
                                        <th class="text-center text-light">Bobot</th>
                                        <th class="text-center text-light">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <?php
                                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row['id_kriteria']; ?></td>
                                            <td><?php echo $row['kriteria']; ?></td>
                                            <td><?php echo $row['keterangan']; ?></td>
                                            <td><?php echo $row['bobot']; ?>%</td>
                                            <td class="iconAksi">
                                                <a href="deleteKriteria.php?id_kriteria=<?php echo $row['id_kriteria'] ?>" class="sampah">
                                                    <i class="bi bi-trash3"></i></a>
                                                <a href="updateKriteria.php?id_kriteria=<?php echo $row['id_kriteria'] ?>" class="edit">
                                                    <i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table -->
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Sub Kriteria</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk menampilkan elemen select -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <form action="./tambahSubkriteria.php" method="POST">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_subkriteria" value="<?php echo $kodeoto; ?>">
                                                    <label for="selectKriteria" class="form-label">Pilih Kriteria</label>
                                                    <select id="selectKriteria" name="kriteria" class="form-select mb-3">
                                                        <option value="">--Pilih--</option>
                                                        <?php
                                                        // Ambil data kriteria dari tabel_kriteria
                                                        $query = "SELECT * FROM tabel_kriteria";
                                                        $result = $conn->query($query);
                                                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                            echo '<option value="' . $row['id_kriteria'] . '|' . $row['keterangan'] . '">' . $row['keterangan'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="col-12 mb-3">
                                                        <label for="keteranganSubK" class="form-label">Keterangan Sub Kriteria</label>
                                                        <input type="text" name="keteranganSubK" class="form-control" id="keteranganSubK" placeholder="input Keterangan Sub Kriteria" required>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="nilaiSubkriteria" class="form-label">Nilai Sub Kriteria</label>
                                                        <input type="number" min="1" max="5" name="nilaiSubkriteria" class="form-control" id="nilaiSubkriteria" placeholder="input nilai subkriteria 1 - 5" required>
                                                    </div>
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

                <div class="row mt-3">
                    <div class="col">
                        <h3 class="ps-1 mt-3 text-center">SubKriteria Bantuan<br><span class="myadmin fw-semibold">Sarana Produksi Pertanian</span>.</h3>
                        <!-- table -->
                        <div class="container overflow-auto">
                            <table id="TabelSubKriteria" class="table table-responsive table-striped table-hover table-bordered">
                                <thead class="bgtosca">
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center text-light">Id Kriteria</th>
                                        <th class="text-center text-light">Keterangan Kriteria</th>
                                        <th class="text-center text-light">Keterangan SubKriteria</th>
                                        <th class="text-center text-light">Nilai SubKriteria</th>
                                        <th class="text-center text-light">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <?php
                                    $no = 1;
                                    // Loop melalui hasil query subKriteria dan tampilkan setiap baris
                                    while ($row = mysqli_fetch_assoc($resultSubkriteria)) { ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['id_kriteria']; ?></td>
                                            <td><?php echo $row['ket_kriteria']; ?></td>
                                            <td><?php echo $row['ket_subkriteria']; ?></td>
                                            <td><?php echo $row['nilai_subkriteria']; ?></td>
                                            <td class="iconAksi">
                                                <a href="deleteSubKriteria.php?id_subkriteria=<?php echo $row['id_subkriteria'] ?>" class="sampah">
                                                    <i class="bi bi-trash3"></i></a>
                                                <a href="" class="edit" data-bs-toggle="modal" data-bs-target="#modalUpdate<?php echo $no; ?>">
                                                    <i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalUpdate<?php echo $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><span class="myadmin">Update</span> Sub Kriteria</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form untuk menampilkan elemen select -->
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <form action="./updateSubkriteria.php" method="POST">
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="id_subkriteria" value="<?php echo $row['id_subkriteria']; ?>">
                                                                        <label for="selectKriteria" class="form-label">Pilih Kriteria</label>
                                                                        <select id="selectKriteria" name="kriteria" class="form-select mb-3">
                                                                            <option value="<?php echo $row['id_kriteria']; ?>|<?php echo $row['ket_kriteria']; ?>"><?php echo $row['ket_kriteria']; ?></option>
                                                                        </select>
                                                                        <div class="col-12 mb-3">
                                                                            <label for="keteranganSubK" class="form-label">Keterangan Sub Kriteria</label>
                                                                            <input type="text" name="keteranganSubK" class="form-control" id="keteranganSubK" value="<?php echo $row['ket_subkriteria']; ?>" placeholder="input Keterangan Sub Kriteria" required>
                                                                        </div>
                                                                        <div class="col-12 mb-3">
                                                                            <label for="nilaiSubkriteria" class="form-label">Nilai Sub Kriteria</label>
                                                                            <input type="number" min="1" max="5" name="nilaiSubkriteria" class="form-control" id="nilaiSubkriteria" value="<?php echo $row['nilai_subkriteria']; ?>" placeholder="input nilai subkriteria 1 - 5" required>
                                                                        </div>
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
                                    <?php $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table -->
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
            $("#TabelKriteria").DataTable({
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
            $("#TabelSubKriteria").DataTable({
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