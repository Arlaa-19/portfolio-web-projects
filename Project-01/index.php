<?php
session_start();
include('./connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if (empty($_SESSION['username'])) {
    echo "<script>window.location=(href='landingPage.php')</script>";
} else {
    $myadmin = $_SESSION['username'] ?? null;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinas Pertanian SPK</title>
    <!-- bootstrap css -->
    <link href="./bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- remix icon cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- my style css -->
    <link rel="stylesheet" href="./asset/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <header class="container-fluid shadow-sm fixed-top">
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container-fluid">
                <div class="d-flex me-3">
                    <img src="./asset/img/logo.png" class="logo-img pe-1" alt="">
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
                                <a class="nav-link text-dark-emphasis active" aria-current="page" href="#">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="./kriteria/kriteria.php">Kriteria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="./alternatif/alternatif.php">Alternatif</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="./vikor/penilaianVikor.php">Penilaian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark-emphasis" href="./vikor/hasilPerhitungan.php">Hasil Akhir</a>
                            </li>
                        </ul>
                        <div class="setting">
                            <a href="./admin/admin.php" class="myakun d-flex align-items-center gap-1 px-2 rounded-5">
                                <label class="fw-bold">Akun</label>
                                <i class="ri-user-star-fill fs-5"></i>
                            </a>
                            <a href="./logout.php" class="mylogout d-flex align-items-center justify-content-center"><i class="ri-logout-circle-r-line fs-4"></i></a>
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
                <div class="row mt-3 d-flex flex-column-reverse flex-md-row text-center text-md-start">
                    <div class="col align-content-center">
                        <h3 class="ps-1 mt-3">Selamat Datang <span class="myadmin fw-semibold text-uppercase"> <?= $myadmin ?></span>.</h3>
                        <h1 class="display-5 fw-semibold">Buatlah Keputusan Dengan Lebih <br>Mudah dan Efektif.</h1>
                        <p class="fs-5">
                            <span>Sistem Pendukung Keputusan</span> ini telah menerapkan Metode
                            VIKOR dalam melakukan perhitungannya.
                        </p>
                        <div class="b-start justify-content-center justify-content-md-start">
                            <a href="#dinas" class="b-read">Read more<i class="bi bi-caret-down-fill"></i></a>
                            <a href="./kriteria/kriteria.php" class="b-get">Get Start<i class="bi bi-caret-right-fill"></i></a>
                        </div>
                    </div>
                    <div class="col">
                        <img src="./asset/img/PNG/bg1.png" alt="bg1" class="bg-img img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="container-fluid p-0 text-light" id="dinas">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#a0deff" fill-opacity="1" d="M0,96L34.3,85.3C68.6,75,137,53,206,42.7C274.3,32,343,32,411,42.7C480,53,549,75,617,101.3C685.7,128,754,160,823,149.3C891.4,139,960,85,1029,53.3C1097.1,21,1166,11,1234,21.3C1302.9,32,1371,64,1406,80L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
            </svg>
            <div class="container">
                <div class="row d-flex px-2 px-md-0">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img src="./asset/img/bg-padi.jpg" alt="padi" class="img-fluid img-thumbnail rounded-2">
                    </div>
                    <div class="col-md-6 border-dashed p-2">
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
                <path fill="#ffe779" fill-opacity="1" d="M0,64L30,53.3C60,43,120,21,180,42.7C240,64,300,128,360,128C420,128,480,64,540,58.7C600,53,660,107,720,144C780,181,840,203,900,213.3C960,224,1020,224,1080,208C1140,192,1200,160,1260,144C1320,128,1380,128,1410,128L1440,128L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
            </svg>
        </section>

        <section class="container-fluid p-0 text-dark kuning">
            <div class="container">
                <div class="row d-flex px-2 px-md-0">
                    <div class="col-md-6 border-dashed-2 p-2 mb-3 mb-md-0">
                        <h2 class="rules text-center">RULES</h2>
                        <p class="text-center text-md-start">
                            Untuk memaksimalkan penggunaan Sistem Pendukung Keputusan yang
                            ada, maka kami akan memberikan beberapa rules yang dapat di ikuti
                            agar dapat mencapai hasil yang di inginkan.
                        </p>
                        <p class="m-0 deskripsi">Berikut adalah beberapa rules yang kami sediakan:</p>
                        <ul class="m-0 deskripsi">
                            <li>
                                Silahkan isi terlebih dahulu kriteria yang di butuhkan dengan
                                total nilai 100%
                            </li>
                            <li>
                                lalu silahkan isi bagian alternatif dengan mengklik "tambah
                                data" dan sesuikan data yang ada pada form yang di sediakan
                            </li>
                            <li>
                                setelah mengisi dua buah input tersebut maka sistem akan
                                menghitung secara otomatis dan anda dapat melihat nilai nya pada
                                menu "Penilaian"
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img src="./asset/img/PNG/bg3.png" alt="padi" class="img-fluid">
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
    <!-- bootstrap js -->
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>

</html>