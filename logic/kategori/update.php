<?php

    include('../../functions/query.php');

    $id = $_POST['id'];
    $kodeKategori = $_POST['kode_kategori'];
    $namaKategori = $_POST['nama_kategori'];

    if (!$namaKategori) {
        header("location: ../../index.php?page=kategori/edit&id=$id&alert=nama kategori harus diisi");

        exit();
    }

    $data = [
        'id' => $id,
        'kode_kategori' => $kodeKategori,
        'nama_kategori' => $namaKategori
    ];

    if(updateCategory($data)) {
        header("location: ../../index.php?page=kategori&alert=berhasil update");
    } else {
        header("location: ../../index.php?page=kategori/edit&id=$id&alert=gagal");
    }
?>