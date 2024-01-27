<?php
    include('functions/view-query.php');

    $codeCategory = generateCodeCategory();

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Kategori</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php">Kategori</a></li>
            <li class="breadcrumb-item active">Tambah Kategori</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if(isset($_GET['alert']) && $_GET['alert'] == 'gagal') { ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    <h4 class="alert-heading">Gagal!</h4>
                                    <p>Data gagal ditambahkan.</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php }

                            if(isset($_GET['alert']) && $_GET['alert'] == 'nama kategori harus diisi') { ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    <h4 class="alert-heading">Gagal!</h4>
                                    <p>Nama Kategori harus diisi.</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php }
                        ?>
                        <h5 class="card-title">Tambah Kategori</h5>

                        <form action="logic/kategori/save.php" method="POST">
                            <div class="form-group mb-3">
                                <label>Kode Kategori</label>
                                <input type="text" name="kode_kategori" placeholder="Input Kode" class="form-control" value="<?= $codeCategory; ?>" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama Kategori</label>
                                <input type="text" name="nama_kategori" placeholder="Input Nama Kategori" class="form-control">
                            </div>

                            <hr>
                            
                            <div class="text-end">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->