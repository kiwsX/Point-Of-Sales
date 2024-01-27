<?php

    require_once('../../config/database.php');

    function saveCategory($data)
    {
        $conn = connection();
        $kodeKategori = $data['kode_kategori'];
        $namaKategori = $data['nama_kategori'];

        $query = "INSERT INTO m_kategori (kode_kategori, nama_kategori) VALUES ('$kodeKategori', '$namaKategori')";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function updateCategory($data)
    {
        $conn = connection();
        $id = $data['id'];
        $kodeKategori = $data['kode_kategori'];
        $namaKategori = $data['nama_kategori'];

        $query = "UPDATE m_kategori SET kode_kategori = '$kodeKategori', nama_kategori = '$namaKategori' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function deleteCategory($id)
    {
        $conn = connection();

        $query = "DELETE FROM m_kategori WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function saveBarang($data)
    {
        $conn = connection();

        $kodeKategori = $data['kode_kategori'];
        $kodeBarang = $data['kode_barang'];
        $namaBarang = $data['nama_barang'];
        $harga = $data['harga'];
        $stok = $data['stok'];
        $image = $data['image'];

        $query = "INSERT INTO m_barang (kode_kategori, kode_barang, nama_barang, harga, stok, images) VALUES ('$kodeKategori', '$kodeBarang', '$namaBarang', '$harga', '$stok', '$image')";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function updateBarang($data, $id)
    {
        $conn = connection();

        $kodeKategori = $data['kode_kategori'];
        $kodeBarang = $data['kode_barang'];
        $namaBarang = $data['nama_barang'];
        $harga = $data['harga'];
        $stok = $data['stok'];
        $image = $data['image'];

        $query = "UPDATE m_barang SET kode_kategori = '$kodeKategori', kode_barang = '$kodeBarang', nama_barang = '$namaBarang', harga = '$harga', stok = '$stok', images = '$image' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function deleteBarang($id)
    {
        $conn = connection();

        $query = "DELETE FROM m_barang WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
?>