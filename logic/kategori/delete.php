<?php

    include('../../functions/query.php');

    $id = $_GET['id'];

    if(deleteCategory($id)) {
        header("location: ../../index.php?page=kategori&alert=berhasil hapus");
    } else {
        header("location: ../../index.php?page=kategori&alert=gagal hapus");
    }
?>