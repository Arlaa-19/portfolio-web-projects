<?php
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_kriteria = $_GET['id_kriteria'];
$sql         = "SELECT * FROM tabel_kriteria WHERE id_kriteria = '$id_kriteria'";
$query       = mysqli_query($conn, $sql);
$row         = mysqli_fetch_array($query);
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
        <section class="container-fluid p-0 nexthero">
            <div class="container">
                <div class="row d-flex flex-column flex-lg-row text-center text-md-start">
                    <div class="col-lg-6 mb-3">
                        <img src="../asset/img/PNG/tambahkriteria.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <div class="subContainer mycard">
                            <h3 class="sacramento-regular">Update Kriteria .</h3>
                            <form action="" method="post" class="row formTambah">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputIdKriteria" class="form-label">Id Kriteria</label>
                                            <input type="text" name="id_kriteria" class="form-control" id="inputIdKriteria" placeholder="Id Kriteria" aria-label="First name" value="<?php echo $row["id_kriteria"]; ?>" readonly required>
                                        </div>
                                        <div class="col">
                                            <label for="inputKriteria" class="form-label">Kriteria</label>
                                            <input type="text" name="kriteria" class="form-control" id="inputKriteria" placeholder="Kriteria" aria-label="Last name" value="<?php echo $row["kriteria"]; ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputKeterangan" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="inputKeterangan" placeholder="input keterangan kriteria" value="<?php echo $row["keterangan"]; ?>" required>
                                    <input type="hidden" name="old_keterangan" value="<?php echo $row["keterangan"]; ?>">
                                </div>
                                <div class="col-12">
                                    <label for="inputnumber" class="form-label">Bobot Kriteria</label>
                                    <input type="number" name="bobot" min="0" step="0.1" class="form-control" id="inputnumber" placeholder="input bobot" value="<?php echo $row["bobot"]; ?>" required>
                                </div>
                                <div class="col-12">
                                    <div class="operasi">
                                        <button type="submit" name="simpan" class="btn_s">Simpan</button>
                                        <a href="./kriteria.php" class="btn_b">Batal</a>
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

<!-- Perintah update data -->
<?php
if (isset($_POST['simpan'])) {
    $id_kriteria   = $_POST['id_kriteria'];
    $kriteria      = $_POST['kriteria'];
    $keterangan    = $_POST['keterangan'];
    $bobot         = $_POST['bobot'];
    $old_keterangan = $_POST['old_keterangan'];

    // Periksa apakah keterangan sudah ada di tabel_kriteria
    $sql_kriteria   = "SELECT * FROM tabel_kriteria WHERE keterangan = '$keterangan' AND bobot = '$bobot'";
    $query_kriteria = $conn->query($sql_kriteria);
    $cek_kriteria   = $query_kriteria->num_rows;

    if ($cek_kriteria > 0) {
        echo "<script>alert('Data Sudah Ada!') </script>";
        echo "<script>window.location.href = \"kriteria.php\" </script>";
    } else {
        // Tambah data ke tabel_kriteria
        $query  = "UPDATE tabel_kriteria SET id_kriteria = '$id_kriteria', kriteria = '$kriteria', keterangan = '$keterangan', bobot = '$bobot' WHERE id_kriteria = '$id_kriteria'";
        $update = $conn->query($query);

        if ($update == true) {
            $query = "UPDATE tabel_subkriteria SET ket_kriteria ='$keterangan' WHERE id_kriteria = '$id_kriteria'";
            $UpdateSub = $conn->query($query);

            // Validasi dan modifikasi nama kolom
            $keterangan = preg_replace('/[^a-zA-Z0-9_]/', '_', $keterangan);
            $old_keterangan = preg_replace('/[^a-zA-Z0-9_]/', '_', $old_keterangan);
            // Buat kolom baru pada tabel_alternatif berdasarkan keterangan
            $alter_query = "ALTER TABLE tabel_alternatif CHANGE $old_keterangan $keterangan VARCHAR(255)";
            if ($conn->query($alter_query) === TRUE) {
                echo "<script>alert('Data Berhasil Diupdate') </script>";
            } else {
                echo "<script>alert('Data Berhasil Ditambahkan tetapi Gagal Membuat Kolom Baru') </script>";
            }
            echo "<script>window.location.href = \"kriteria.php\" </script>";
        } else {
            echo "<script>alert('Data Gagal Diupdate') </script>";
            echo "<script>window.location.href = \"kriteria.php\" </script>";
        }
    }
}
?>