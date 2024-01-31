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

        $query = "SELECT max(id_transaksi) as kode FROM transaksi";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);
        $codeTransaksi = $data['kode'];

        $noUrut = (int) substr($codeTransaksi, 3, 3);
        $noUrut++;

        $char = "TRX";
        $newID = $char . sprintf("%03s", $noUrut);

        return $newID;
    }

    function getKeranjang($idTransaksi, $kodeBarang = null)
    {
        $conn = connection();

        if ($kodeBarang) {
            $query = "SELECT * FROM keranjang JOIN m_barang ON keranjang.kode_barang = m_barang.kode_barang WHERE keranjang.kode_barang = '$kodeBarang' AND keranjang.id_transaksi = '$idTransaksi'";
        } else {
            $query = "SELECT keranjang.*, m_barang.nama_barang, m_barang.harga, m_barang.images FROM keranjang JOIN m_barang ON keranjang.kode_barang = m_barang.kode_barang WHERE keranjang.id_transaksi = '$idTransaksi'";
        }

        $result = mysqli_query($conn, $query);

        return $result;
    }

    function getTransaksi($idTransaksi = null)
    {
        $conn = connection();

        if ($idTransaksi) {
            $query = "SELECT riwayat_transaksi.*, m_barang.nama_barang, m_barang.harga, m_kategori.nama_kategori, transaksi.total as total_transaksi, transaksi.total_bayar FROM riwayat_transaksi JOIN transaksi ON riwayat_transaksi.id_transaksi = transaksi.id_transaksi JOIN m_barang ON riwayat_transaksi.kode_barang = m_barang.kode_barang JOIN m_kategori ON m_barang.kode_kategori = m_kategori.kode_kategori WHERE riwayat_transaksi.id_transaksi = '$idTransaksi' ORDER BY riwayat_transaksi.kode_barang ASC";
        } else {
            $query = "SELECT * FROM transaksi";
        }

        $result = mysqli_query($conn, $query);

        return $result;
    }
?>