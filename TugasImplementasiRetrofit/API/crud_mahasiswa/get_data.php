<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nim = $_POST["nim"];

    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $eksekusi = mysqli_query($konek,$query);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Berhasil";
        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F['nim'] = $ambil->nim;
            $F['nama'] = $ambil->nama;
            $F['prodi'] = $ambil->prodi;
            $F['fakultas'] = $ambil->fakultas;
    
           array_push($response["data"],$F);
        }
    }else{
        $response["kode"] = 0;
        $response["pesan"] = "Gagal";
    }
}else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);
?>