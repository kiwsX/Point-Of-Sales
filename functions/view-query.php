<?php
    require 'config/database.php';

    function generateCodeCategory()
    {
        $conn = connection();

        $query = "SELECT max(kode_kategori) as kode FROM m_kategori";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);
        $codeCategory = $data['kode'];

        $noUrut = (int) substr($codeCategory, 3, 3);
        $noUrut++;

        $char = "KAT";
        $newID = $char . sprintf("%03s", $noUrut);

        return $newID;
    }

    function getCategory($id = null)
    {
        $conn = connection();

        if ($id) {
            $query = "SELECT * FROM m_kategori WHERE id = '$id'";
        } else {
            $query = "SELECT * FROM m_kategori";
        }

        $result = mysqli_query($conn, $query);

        return $result;
    }

    function generateCodeBarang()
    {
        $conn = connection();

        $query = "SELECT max(kode_barang) as kode FROM m_barang";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);
        $codeBarang = $data['kode'];

        $noUrut = (int) substr($codeBarang, 3, 3);
        $noUrut++;

        $char = "BRG";
        $newID = $char . sprintf("%03s", $noUrut);
        
        return $newID;
    }

    function getBarang($id = null)
    {
        $conn = connection();

        if ($id) {
            $query = "SELECT m_barang.*, m_kategori.kode_kategori, m_kategori.nama_kategori FROM m_barang JOIN m_kategori ON m_barang.kode_kategori = m_kategori.kode_kategori WHERE m_barang.id = '$id'";
        } else {
            $query = "SELECT m_barang.*, m_kategori.kode_kategori, m_kategori.nama_kategori FROM m_barang JOIN m_kategori ON m_barang.kode_kategori = m_kategori.kode_kategori";
        }

        $result = mysqli_query($conn, $query);

        return $result;
    }

    function generateCodeTransaksi()
    {
        $conn = connection();

        $query = "SELECT max(kode_transaksi) as kode FROM t_transaksi";
    }
?>