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

    function saveKeranjang($data)
    {
        $conn = connection();

        $idTransaksi = $data['id_transaksi'];
        $kodeBarang = $data['kode_barang'];

        $queryBarang = "SELECT * FROM m_barang WHERE kode_barang = '$kodeBarang'";
        $resultBarang = mysqli_query($conn, $queryBarang);

        $barang = mysqli_fetch_array($resultBarang);
        $harga = $barang['harga'];

        $keranjang = "SELECT * FROM keranjang WHERE kode_barang = '$kodeBarang' AND id_transaksi = '$idTransaksi'";
        $resultKeranjang = mysqli_query($conn, $keranjang);
        $dataKeranjang = mysqli_fetch_array($resultKeranjang);


        if ($dataKeranjang) {
            if ($barang['stok'] <= 0) {
                return false;
            } else {
                $query = "UPDATE keranjang SET qty = qty + 1, total = total + $harga WHERE id_transaksi = '$idTransaksi' AND kode_barang = '$kodeBarang'";
                $result = mysqli_query($conn, $query);

                $queryUpdateBarang = "UPDATE m_barang SET stok = stok - 1 WHERE kode_barang = '$kodeBarang'";
                $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);
            }
        } else {
            if ($barang['stok'] <= 0) {
                return false;
            } else {
                $query = "INSERT INTO keranjang (id_transaksi, kode_barang, qty, total) VALUES ('$idTransaksi', '$kodeBarang', '1', '$harga')";
                $result = mysqli_query($conn, $query);

                $queryUpdateBarang = "UPDATE m_barang SET stok = stok - 1 WHERE kode_barang = '$kodeBarang'";
                $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);
            }
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function updateKeranjang($data)
    {
        $conn = connection();

        $id = $data['id'];
        $qty = $data['qty'];

        $keranjang = "SELECT * FROM keranjang WHERE id = '$id'";
        $resultKeranjang = mysqli_query($conn, $keranjang);
        $dataKeranjang = mysqli_fetch_array($resultKeranjang);
        $kodeBarang = $dataKeranjang['kode_barang'];

        $barang = "SELECT * FROM m_barang WHERE kode_barang = '$kodeBarang'";
        $resultBarang = mysqli_query($conn, $barang);
        $dataBarang = mysqli_fetch_array($resultBarang);

        $harga = $dataBarang['harga'];
        $totalQty = $dataKeranjang['qty'] + $qty;

        if ($dataBarang['stok'] < $totalQty) {
            return false;
        } else {
            $query = "UPDATE keranjang SET qty = '$totalQty', total = '$totalQty' * '$harga' WHERE kode_barang = '$kodeBarang' AND id = '$id'";
            $result = mysqli_query($conn, $query);

            $queryUpdateBarang = "UPDATE m_barang SET stok = stok - $qty WHERE kode_barang = '$kodeBarang'";
            $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);
        }



        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function deleteKeranjang($id)
    {
        $conn = connection();

        $queryGetKeranjang = "SELECT * FROM keranjang WHERE id = '$id'";
        $resultGetKeranjang = mysqli_query($conn, $queryGetKeranjang);
        $dataKeranjang = mysqli_fetch_array($resultGetKeranjang);

        $kodeBarang = $dataKeranjang['kode_barang'];
        $qty = $dataKeranjang['qty'];

        $queryUpdateBarang = "UPDATE m_barang SET stok = stok + $qty WHERE kode_barang = '$kodeBarang'";
        $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);

        $query = "DELETE FROM keranjang WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function updateStok($kodeBarang, $qty)
    {
        $conn = connection();

        $query = "UPDATE m_barang SET stok = stok - '$qty' WHERE kode_barang = '$kodeBarang'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function saveTransaksi($data)
    {
        $conn = connection();

        $id_transaksi = $data['id_transaksi'];
        $total = $data['total'];
        $bayar = $data['bayar'];

        $keranjang = "SELECT * FROM keranjang WHERE id_transaksi = '$id_transaksi'";
        $resultKeranjang = mysqli_query($conn, $keranjang);

        $query = "INSERT INTO transaksi (id_transaksi, total, tanggal_transaksi, total_bayar) VALUES ('$id_transaksi', '$total', now(), '$bayar')";
        $result = mysqli_query($conn, $query);

        foreach ($resultKeranjang as $key => $value) {
            $idTransaksi = $value['id_transaksi'];
            $qty = $value['qty'];
            $kodeBarang = $value['kode_barang'];
            $subTotal = $value['total'];

            $queryRiwayat = "INSERT INTO riwayat_transaksi (id_transaksi, kode_barang, qty, total) VALUES ('$idTransaksi', '$kodeBarang', '$qty', '$subTotal')";
            $resultRiwayat = mysqli_query($conn, $queryRiwayat);

            if ($resultRiwayat) {
                deleteKeranjang($value['id']);
                updateStok($kodeBarang, $qty);
            }
        }

        if ($result && $resultRiwayat) {
            return true;
        } else {
            return false;
        }
    }
?>