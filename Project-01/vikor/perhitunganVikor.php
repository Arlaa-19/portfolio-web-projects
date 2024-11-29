<?php
// include("../connection/connect.php");
// $conn = connectDB("localhost", "root", "", "spk_vikor");

// Ambil data kriteria
$sql = 'SELECT * FROM tabel_kriteria';
$result = $conn->query($sql);
$kriteria = array();
$bobot = array();
$ketKriteria = array();

foreach ($result as $row) {
    $kriteria[$row['id_kriteria']] = array(
        'id_kriteria' => $row['id_kriteria'],
        'kriteria' => $row['kriteria'],
        'keterangan' => $row['keterangan'],
        'bobot' => $row['bobot']
    );
    $bobot[$row['id_kriteria']] = $row['bobot'];
    $kriteria_nama = $row['keterangan'];
    $kriteria_nama  = preg_replace('/[^a-zA-Z0-9_]/', '_', $kriteria_nama);
    $ketKriteria[$row['id_kriteria']] = $kriteria_nama;
}

// Ambil data alternatif
$sql = "SELECT * FROM tabel_alternatif WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
$result = $conn->query($sql);
$alternatif = array();
while ($row = $result->fetch_assoc()) {
    $id_alternatif = $row['id_alternatif'];
    $alternatif[$id_alternatif] = array(
        'id_alternatif' => $row['id_alternatif'],
        'tanggal' => $row['tanggal'],
        'alternatif' => $row['alternatif'],
        'nama_kelompok' => $row['nama_kelompok']
    );

    foreach ($ketKriteria as $id_kriteria => $nama_kriteria) {
        if (isset($row[$nama_kriteria])) {
            $alternatif[$id_alternatif][$nama_kriteria] = $row[$nama_kriteria];
        } else {
            $alternatif[$id_alternatif][$nama_kriteria] = null;
        }
    }
}

// Ambil data nilai
$sql = "SELECT * FROM tabel_nilai WHERE id_alternatif IN (SELECT id_alternatif FROM tabel_alternatif WHERE tanggal BETWEEN '$start_date' AND '$end_date') ORDER BY id_alternatif, id_kriteria";
$result = $conn->query($sql);
$nilaiAlternatif = array();
foreach ($result as $row) {
    $nilaiAlternatif[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai_subkriteria'];
}

// Normalisasi matriks
$max = $min = array();
$nilai_kriteria = array(); // Buat array nilai_kriteria di luar loop
foreach ($kriteria as $id_kriteria => $data_kriteria) {
    $nilai_kriteria[$id_kriteria] = array_column($nilaiAlternatif, $id_kriteria);
    $max[$id_kriteria] = max($nilai_kriteria[$id_kriteria]);
    $min[$id_kriteria] = min($nilai_kriteria[$id_kriteria]);
}

// Normalisasi nilai
$normalisasi = array();
foreach ($nilaiAlternatif as $id_alternatif => $nilai) {
    foreach ($nilai as $id_kriteria => $nilai_subkriteria) {
        // Menambahkan penanganan untuk pembagian oleh nol di dalam loop yang sesuai
        if ($max[$id_kriteria] - $min[$id_kriteria] != 0) {
            $normalisasi[$id_alternatif][$id_kriteria] = ($max[$id_kriteria] - $nilai_subkriteria) / ($max[$id_kriteria] - $min[$id_kriteria]);
        } else {
            // Penanganan jika pembagian oleh nol terjadi
            $normalisasi[$id_alternatif][$id_kriteria] = 0; // atau nilai default lainnya
        }
    }
}


// Normalisasi nilai
// $normalisasi = array();
// foreach ($nilaiAlternatif as $id_alternatif => $nilai) {
//     foreach ($nilai as $id_kriteria => $nilai_subkriteria) {
//         $normalisasi[$id_alternatif][$id_kriteria] = ($max[$id_kriteria] - $nilai_subkriteria) / ($max[$id_kriteria] - $min[$id_kriteria]);
//     }
// }

// Menghitung matriks normalisasi dengan bobot
$F = array();
$bobotKriteria = array();

// Inisialisasi bobot kriteria dilakukan di luar loop
foreach ($bobot as $id_kriteria => $bobot_value) {
    $bobotKriteria[$id_kriteria] = $bobot_value / 100; // Menghitung nilai bobot kriteria
}

foreach ($normalisasi as $id_alternatif => $nilai) {
    foreach ($nilai as $id_kriteria => $nilai_normalisasi) {
        // Hitung nilai F berdasarkan normalisasi dan bobot kriteria
        $F[$id_alternatif][$id_kriteria] = $nilai_normalisasi * $bobotKriteria[$id_kriteria];
    }
}


// $F = array();
// foreach ($normalisasi as $id_alternatif => $nilai) {
//     foreach ($nilai as $id_kriteria => $nilai_normalisasi) {
//         $bobotKriteria = $bobot[$id_kriteria] / 100;
//         $F[$id_alternatif][$id_kriteria] = $nilai_normalisasi * $bobotKriteria;
//     }
// }

// Menghitung nilai S dan R
$S = $R = array();
foreach ($F as $id_alternatif => $nilai) {
    $S[$id_alternatif] = array_sum($nilai);
    $R[$id_alternatif] = max($nilai);
}

// Menghitung nilai Q
$Q = array();
$v = 0.5; // nilai v bisa disesuaikan
$S_max = max($S);
$S_min = min($S);
$R_max = max($R);
$R_min = min($R);

foreach ($F as $id_alternatif => $nilai) {
    $Q[$id_alternatif] = $v * (($S[$id_alternatif] - $S_min) / ($S_max - $S_min)) + (1 - $v) * (($R[$id_alternatif] - $R_min) / ($R_max - $R_min));
}

// Ranking
asort($Q);
