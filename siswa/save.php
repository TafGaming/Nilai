<?php
if (isset($_POST['simpan'])) {
    include_once('config.php');
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $tempat_lahir = $_POST['tempat_lahir'] == '' ? 0 : $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir']== '' ? 0 : $_POST['tanggal_lahir'];
    $kelas_id = $_POST['kelas_id'];

    $acak = rand();
    $namafile = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $akhiran = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));
    $ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'svg', 'webp');

    if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $sql = "INSERT INTO siswa SET nis='$nis', nama='$nama', jk='$jk', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', kelas_id='$kelas_id'";
    } else {
        if (!in_array($akhiran, $ekstensi)) {
            echo '<script language="JavaScript">';
            echo 'alert("Akhiran file Anda, TIDAK DIIZINKAN.");';
            echo 'window.location.href = "index.php?m=siswa";';
            echo '</script>';
            exit();
        } else {
            if ($ukuran < 10000000) {
                $nmfile = $acak . '_' . $namafile;
                if (move_uploaded_file($_FILES['foto']['tmp_name'], 'siswa/foto/' . $nmfile)) {
                    $sql = "INSERT INTO siswa SET nis='$nis', nama='$nama', jk='$jk', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', kelas_id='$kelas_id', foto='$nmfile'";
                } else {
                    echo '<script language="JavaScript">';
                    echo 'alert("Gagal mengunggah file.");';
                    echo 'window.location.href = "index.php?m=siswa";';
                    echo '</script>';
                    exit();
                }
            } else {
                echo '<script language="JavaScript">';
                echo 'alert("Ukuran file Anda, TERLALU BESAR.");';
                echo 'window.location.href = "index.php?m=siswa";';
                echo '</script>';
                exit();
            }
        }
    }

    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location: index.php?m=siswa&s=view');
        exit();
    } else {
        echo '<script language="JavaScript">';
        echo 'alert("Data Gagal Ditambahkan.");';
        echo 'window.location.href = "index.php?m=siswa";';
        echo '</script>';
    }
}
