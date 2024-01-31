<?php

    include('../../functions/query.php');

    $idTransaksi = $_GET['id_transaksi'];
    $codeBarang = $_GET['kode_barang'];
    
    $data = [
        'id_transaksi' => $idTransaksi,
        'kode_barang' => $codeBarang
    ];

    if(saveKeranjang($data)) {
        header("location: ../../index.php?page=transaksi&alert=berhasil&kode_barang=$codeBarang");
    } else {
        header("location: ../../index.php?page=transaksi&alert=gagal");
    }
?>