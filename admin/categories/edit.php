<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Data Kategori</h1>
</div>

<!-- page -->
<?php

$id = $_GET['id'];

$data = show_id_data("SELECT * FROM tbl_kategori WHERE id_kategori = '" . $id . "' ");

?>

<!-- Content Row -->
<div class="row">

    <!-- Pending Requests Card Example -->
    <div class="col-xl-12 col-md-12 mb-4">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="kategori_id" id="kategori_id" class="form-control" value="<?= $data['id_kategori']; ?>">
                            <div class="form-group">
                                <label for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" id="kategori" class="form-control" value="<?= $data['kategori']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit" name="update">Simpan</button>
                    <a href="kategori.php" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>