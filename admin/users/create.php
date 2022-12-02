<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Pengguna</h1>
</div>

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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Pengguna</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username Pengguna</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password Pengguna</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm">Confirm Password</label>
                                <input type="text" name="confirm" id="confirm" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="profile">Profile Pengguna</label>
                                <input type="file" name="profile" id="profile" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Level Pengguna</label>
                                <select name="role" id="role" class="form-control">
                                    <option value=""></option>
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit" name="create">Simpan</button>
                    <a href="user.php" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>