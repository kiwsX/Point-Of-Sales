<?php

    include('../../functions/query.php');

    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $data = [
        'id' => $id,
        'qty' => $qty
    ];

    if(updateKeranjang($data)) {
        header("location: ../../index.php?page=transaksi");
    } else {
        header("location: ../../index.php?page=transaksi&alert=gagal");
    }
?>