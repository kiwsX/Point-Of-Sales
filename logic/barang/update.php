<?php

    include('../../functions/query.php');

    $id = $_POST['id'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kode_kategori = $_POST['kode_kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg');
    $filename = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$ekstensi) ) {
        header("location: ../../index.php?page=barang/edit&id=$id&alert=gagal_ekstensi");
    } else {
        if($ukuran < 1044070) {
            $xx = $rand.'_'.$filename;
            $data = [
                'kode_barang' => $kode_barang,
                'nama_barang' => $nama_barang,
                'kode_kategori' => $kode_kategori,
                'harga' => $harga,
                'stok' => $stok,
                'image' => $xx
            ];
            move_uploaded_file($_FILES['image']['tmp_name'], '../../public/img/product/'.$xx);

            if(updateBarang($data, $id)) {
                header("location: ../../index.php?page=barang&alert=berhasil_update");
            } else {
                header("location: ../../index.php?page=barang/edit&id=$id&alert=gagal");
            }

        } else {
            header("location: ../../index.php?page=barang/edit&id=$id&alert=gagal_ukuran");
        }
    }
?>