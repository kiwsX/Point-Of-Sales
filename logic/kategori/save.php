<?php

    include('../../functions/query.php');

    $kode_kategori = $_POST['kode_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    if (!$nama_kategori) {
        header("location: ../../index.php?page=kategori/create&alert=nama kategori harus diisi");

        exit();
    }

    $data = [
        'kode_kategori' => $kode_kategori,
        'nama_kategori' => $nama_kategori
    ];

    if(saveCategory($data)) {
        header("location: ../../index.php?page=kategori&alert=berhasil");
    } else {
        header("location: ../../index.php?page=kategori/create&alert=gagal");
    }
?>