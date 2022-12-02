<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kategori</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- alert status -->
    <?php if (isset($_SESSION['alert']) === true) : ?>
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>
                    <?= @$_SESSION['pesan_tambah']; ?>
                    <?= @$_SESSION['pesan_hapus']; ?>
                    <?= @$_SESSION['pesan_edit']; ?>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php

    unset($_SESSION['alert']);
    unset($_SESSION['pesan_tambah']);
    unset($_SESSION['pesan_edit']);
    unset($_SESSION['pesan_hapus']);
    ?>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-12 col-md-12 mb-4">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a href="?page=create" class="btn btn-primary">Tambah Data </a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($datas as $no => $data) : ?>
                                <tr>
                                    <td><?= $no + 1 ?></td>
                                    <td><?= $data['kategori'] ?></td>
                                    <td>
                                        <a href="?page=delete&id=<?= $data['id_kategori'] ?>" class="btn btn-sm btn-danger mr-3">
                                            <span><i class="fas fa-trash"></i></span>
                                        </a>
                                        <a href="?page=edit&id=<?= $data['id_kategori'] ?>" class="btn btn-sm btn-warning">
                                            <span><i class="fas fa-user-edit"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>