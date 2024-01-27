<?php
  include('functions/view-query.php');

  $data = getBarang();

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Transaksi</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi</h5>

                        <div class="text-start mb-3">
                            <div class="input-group mb-3 w-50">
                                <label class="input-group-text">Kode Barang</label>
                                <input type="text" class="form-control" readonly>
                                <button class="btn btn-outline-primary" type="button" title="Pilih Barang" data-bs-toggle="modal" data-bs-target="#modalBarang">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="table-barang">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(empty($data)) { ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                    <?php } else {
                                    foreach ($data as $key => $value) { ?>
                                        <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['kode_barang'] ?></td>
                                        <td><?= $value['nama_barang'] ?></td>
                                        <td><?= $value['nama_kategori'] ?></td>
                                        <td><?= $value['stok'] ?></td>
                                        <td><?= $value['harga'] ?></td>
                                        <td>
                                            <img src="public/img/product/<?= $value['images'] ?>" width="50px">
                                        </td>
                                        <td>
                                            <a href="index.php?page=barang/edit&id=<?= $value['id'] ?>">
                                            <button type="button" class="btn btn-primary">
                                                Edit
                                            </button>
                                            </a>
                                            <a href="logic/barang/delete.php?id=<?= $value['id'] ?>" onclick="javascript:return confirm('Hapus Data Barang ?');">
                                            <button type="button" class="btn btn-danger">
                                                Hapus
                                            </button>
                                            </a>
                                        </td>
                                        </tr>
                                    <?php }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Barang -->
    <div class="modal fade" id="modalBarang" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered responsive" id="table-pilih-barang">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($data)) { ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                                <?php } else {
                                foreach ($data as $key => $value) { ?>
                                    <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['kode_barang'] ?></td>
                                    <td><?= $value['nama_barang'] ?></td>
                                    <td><?= $value['nama_kategori'] ?></td>
                                    <td><?= $value['stok'] ?></td>
                                    <td><?= $value['harga'] ?></td>
                                    <td>
                                        <img src="public/img/product/<?= $value['images'] ?>" width="50px">
                                    </td>
                                    <td>
                                        <a href="logic/keranjang/save.php?id=<?= $value['id'] ?>">
                                            <button type="button" class="btn btn-primary">
                                                Pilih
                                            </button>
                                        </a>
                                    </td>
                                    </tr>
                                <?php }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Barang -->

</main><!-- End #main -->

<script>
  $(document).ready(function() {
    $('#table-barang').DataTable();
    $('#table-pilih-barang').DataTable();
  })
</script>