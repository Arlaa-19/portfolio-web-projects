<?php
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_alternatif = $_GET['id_alternatif'];
$sql = "SELECT * FROM tabel_alternatif WHERE id_alternatif= '$id_alternatif'";
$query = mysqli_query($conn, $sql);
$rowAlternatif = mysqli_fetch_array($query);

$queryKriteria = "SELECT * FROM tabel_kriteria";
$resultKriteria = mysqli_query($conn, $queryKriteria);

// Fetch nilai subkriteria untuk alternatif
$nilaiAlternatifQuery = "SELECT * FROM tabel_nilai WHERE id_alternatif = '$id_alternatif'";
$nilaiAlternatifResult = mysqli_query($conn, $nilaiAlternatifQuery);
$nilaiAlternatif = [];
while ($rowNilai = mysqli_fetch_assoc($nilaiAlternatifResult)) {
    $nilaiAlternatif[$rowNilai['id_kriteria']] = $rowNilai['keterangan'];
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
                                <a class="nav-link text-dark-emphasis active" href="../alternatif/alternatif.php">Alternatif</a>
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
        <section class="container-fluid p-0 nexthero">
            <div class="container">
                <div class="row d-flex flex-column flex-lg-row text-center text-md-start">
                    <div class="col-lg-5 mb-3">
                        <img src="../asset/img/PNG/tambahAlternatif.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-7">
                        <div class="subContainer mycard">
                            <h3 class="sacramento-regular"><span>Update</span> Alternatif .</h3>
                            <form action="" method="post" class="row formTambah">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputIdAlternatif" class="form-label">Id Alternatif</label>
                                            <input type="text" name="id_alternatif" class="form-control" id="inputIdAlternatif" placeholder="Id Alternatif" aria-label="First name" value="<?php echo $rowAlternatif['id_alternatif']; ?>" readonly required>
                                        </div>
                                        <div class="col">
                                            <label for="inputAlternatif" class="form-label">Alternatif</label>
                                            <input type="text" name="alternatif" class="form-control" id="inputAlternatif" placeholder="Alternatif" aria-label="Last name" value="<?php echo $rowAlternatif['alternatif']; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="input tanggal" value="<?php echo $rowAlternatif['tanggal']; ?>" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputnamaKelompok" class="form-label">Nama Kelompok</label>
                                    <input type="text" name="namaKelompok" class="form-control" id="inputnamaKelompok" placeholder="input nama kelompok" value="<?php echo $rowAlternatif['nama_kelompok']; ?>" required>
                                </div>
                                <?php
                                // Loop melalui hasil query kriteria dan tampilkan setiap kriteria
                                while ($rowKriteria = mysqli_fetch_assoc($resultKriteria)) {
                                    $idKriteria = $rowKriteria['id_kriteria'];
                                    $namaKriteria = $rowKriteria['kriteria'];
                                    $ketKriteria = $rowKriteria['keterangan'];

                                    echo "<div class='col-12'>";
                                    echo "<label for='$ketKriteria' class='form-label'>$ketKriteria</label>";

                                    // Query untuk mengambil subkriteria berdasarkan id_kriteria
                                    $querySubkriteria = "SELECT * FROM tabel_subkriteria WHERE id_kriteria = '$idKriteria'";
                                    $resultSubkriteria = mysqli_query($conn, $querySubkriteria);

                                    if (!$resultSubkriteria) {
                                        die("Query gagal: " . mysqli_error($conn));
                                    }

                                    echo "<select class='form-select' id='$ketKriteria' name='$ketKriteria'>";
                                    echo "<option>--Pilih--</option>";

                                    // Loop melalui hasil query subkriteria dan tampilkan setiap subkriteria sebagai opsi
                                    while ($rowSubkriteria = mysqli_fetch_assoc($resultSubkriteria)) {
                                        $idSubkriteria = $rowSubkriteria['id_kriteria'];
                                        $ketSubkriteria = $rowSubkriteria['ket_subkriteria'];
                                        $nilaiSubkriteria = $rowSubkriteria['nilai_subkriteria'];

                                        // Menambahkan atribut selected jika nilai subkriteria sama dengan nilai yang diambil dari tabel_nilai
                                        $selected = '';
                                        if (isset($nilaiAlternatif[$idKriteria]) && $nilaiAlternatif[$idKriteria] == $ketSubkriteria) {
                                            $selected = 'selected';
                                        }

                                        echo "<option value='$nilaiSubkriteria|$ketSubkriteria' $selected>$ketSubkriteria</option>";
                                    }

                                    echo "</select>";
                                    echo "</div>";
                                }
                                ?>
                                <div class="col-12">
                                    <div class="operasi">
                                        <button type="submit" name="simpan" class="btn_s">Simpan</button>
                                        <a href="./alternatif.php" class="btn_b">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f4f9f9" fill-opacity="1" d="M0,160L26.7,154.7C53.3,149,107,139,160,149.3C213.3,160,267,192,320,224C373.3,256,427,288,480,261.3C533.3,235,587,149,640,101.3C693.3,53,747,43,800,64C853.3,85,907,139,960,170.7C1013.3,203,1067,213,1120,197.3C1173.3,181,1227,139,1280,112C1333.3,85,1387,75,1413,69.3L1440,64L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
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

<!-- Update Data -->
<?php
if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_alternatif = $_POST['id_alternatif'];
    $alternatif = $_POST['alternatif'];
    $namaKelompok = $_POST['namaKelompok'];
    $tanggal = $_POST['tanggal'];

    // Array untuk menyimpan keterangan dan nilai subkriteria
    $keterangan_subkriteria = [];
    $nilai_subkriteria = [];
    $id_kriteria_subkriteria = []; // Array tambahan untuk menyimpan id_kriteria

    // Loop melalui hasil query kriteria dan ambil nilai dan keterangan subkriteria
    $resultKriteria = $conn->query("SELECT * FROM tabel_kriteria");
    while ($rowKriteria = mysqli_fetch_assoc($resultKriteria)) {
        $idKriteria = $rowKriteria['id_kriteria'];
        $ketKriteria = $rowKriteria['keterangan'];
        // Validasi dan modifikasi nama kolom
        $ketKriteria = preg_replace('/[^a-zA-Z0-9_]/', '_', $ketKriteria);

        if (isset($_POST[$ketKriteria])) {
            // Jika kriteria dipilih, ambil nilai dan keterangan subkriteria
            $nilai_option = explode('|', $_POST[$ketKriteria]);
            $nilaiSubkriteria = $nilai_option[0];
            $ketSubkriteria = $nilai_option[1];

            // Simpan keterangan subkriteria ke dalam array
            $keterangan_subkriteria[$ketKriteria] = $ketSubkriteria;

            // Simpan nilai subkriteria ke dalam array
            $nilai_subkriteria[$ketKriteria] = $nilaiSubkriteria;

            // Simpan id_kriteria ke dalam array
            $id_kriteria_subkriteria[$ketKriteria] = $idKriteria;
        }
    }

    // Buat query UPDATE untuk tabel_alternatif
    $set_alternatif = "`tanggal` = '$tanggal', `alternatif` = '$alternatif', `nama_kelompok` = '$namaKelompok'";

    foreach ($keterangan_subkriteria as $keterangan => $nilai) {
        // Tambahkan keterangan subkriteria ke dalam query untuk tabel_alternatif
        $set_alternatif .= ", `$keterangan` = '$nilai'";
    }

    // Buat query UPDATE untuk tabel_alternatif
    $query_alternatif = "UPDATE tabel_alternatif SET $set_alternatif WHERE `id_alternatif` = '$id_alternatif'";

    // Jalankan query untuk tabel_alternatif
    if ($conn->query($query_alternatif) === TRUE) {
        // Loop untuk membangun query UPDATE untuk tabel_nilai
        foreach ($keterangan_subkriteria as $keterangan => $nilai) {
            // Ambil id_kriteria dari array
            $id_kriteria = $id_kriteria_subkriteria[$keterangan];

            // Periksa apakah ada data untuk id_alternatif dan id_kriteria ini di tabel_nilai
            $check_query = "SELECT * FROM tabel_nilai WHERE `id_alternatif` = '$id_alternatif' AND `id_kriteria` = '$id_kriteria'";
            $check_result = $conn->query($check_query);

            if ($check_result->num_rows > 0) {
                // Jika data ada, lakukan UPDATE
                $query_nilai = "UPDATE tabel_nilai SET `keterangan` = '$nilai', `nilai_subkriteria` = '" . $nilai_subkriteria[$keterangan] . "' WHERE `id_alternatif` = '$id_alternatif' AND `id_kriteria` = '$id_kriteria'";
            } else {
                // Jika data tidak ada, lakukan INSERT
                $query_nilai = "INSERT INTO tabel_nilai (`id_alternatif`, `id_kriteria`, `keterangan`, `nilai_subkriteria`) VALUES ('$id_alternatif', '$id_kriteria', '$nilai', '" . $nilai_subkriteria[$keterangan] . "')";
            }

            // Jalankan query untuk tabel_nilai
            if ($conn->query($query_nilai) !== TRUE) {
                echo "Error: " . $query_nilai . "<br>" . $conn->error;
            }
        }

        echo "<script>alert('Data Berhasil Diperbarui'); window.location.href = 'alternatif.php';</script>";
    } else {
        echo "Error: " . $query_alternatif . "<br>" . $conn->error;
    }
}
?>