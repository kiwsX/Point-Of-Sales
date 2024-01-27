<?php

    include('../../functions/query.php');

    $id = $_GET['id'];

    if(deleteBarang($id)) {
        header("location: ../../index.php?page=barang&alert=berhasil_hapus");
    } else {
        header("location: ../../index.php?page=barang/&alert=gagal_hapus");
    }
?>