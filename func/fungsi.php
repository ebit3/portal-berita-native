<?php

ob_start();

session_start();

// login
function login($data)
{
    # code...
    $koneksi = koneksi();

    $username = trim($data['username']);
    $password = trim($data['password']);

    // ambil username
    $result = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE username_user = '" . $username . "' ");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        # code...
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password_user'])) {

            # code...
            header('location: ../admin/index.php');
            $_SESSION['profile'] = $row;
        } else {

            # code...
            $_SESSION['status'] = true;
            $_SESSION['e_password'] = "Password anda salah";
            header('location: ../auth/login.php');
        }
    } else {

        # code...
        $_SESSION['status'] = true;
        $_SESSION['e_username'] = "Username anda salah";
        header('location: ../auth/login.php');
    }

    return $result;
}

// public function
function koneksi()
{
    $koneksi = mysqli_connect("localhost", "root", "", "prv_portal") or die(mysqli_error($koneksi));

    return $koneksi;
}

function show_data($query)
{
    # code...
    $koneksi = koneksi();

    $query = mysqli_query($koneksi, $query);

    $data = [];

    while ($row = mysqli_fetch_assoc($query)) {

        # code...
        $data[] = $row;
    }

    return $data;
}


function show_id_data($query)
{
    $koneksi = koneksi();

    $query = mysqli_query($koneksi, $query);

    $ambil = mysqli_fetch_assoc($query);

    return $ambil;
}


// users
function upload_user()
{
    $file_name      = $_FILES['profile']['name'];
    $file_type      = $_FILES['profile']['type'];
    $file_size      = $_FILES['profile']['size'];
    $file_error     = $_FILES['profile']['error'];
    $file_tmp       = $_FILES['profile']['tmp_name'];

    // gambar kosong
    if ($file_error == 4) {

        return "default.jpg";
    }

    // cek ekstensi
    $list_ekstensi = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $file_name);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if (!in_array($ekstensi_file, $list_ekstensi)) {

        echo "<script>alert('Ekstensi gambar anda salah');history.go(-1);</script>";

        return false;
    }

    // cek type file
    if ($file_type !== 'image/jpeg' && $file_type !== 'image/png') {

        echo "<script>alert('Gambar anda salah');history.go(-1);</script>";

        return false;
    }

    // cek ukuran file
    if ($file_size >= 4000000) {

        echo "<script>alert('Ukuran terlalu besar');history.go(-1);</script>";

        return false;
    }

    // berhasil
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;

    move_uploaded_file($file_tmp, '../assets/img/users/' . $nama_file_baru);

    return $nama_file_baru;
}

function create_users($data)
{
    $koneksi = koneksi();

    $name       = trim(strtolower(stripslashes($data['nama'])));
    $user       = trim(strtolower(stripslashes($data['username'])));
    $pass       = mysqli_real_escape_string($koneksi, $data['password']);
    $conrm      = mysqli_real_escape_string($koneksi, $data['confirm']);
    $level      = trim(strtolower(stripslashes($data['role'])));

    // cek username
    $user_check = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE username_user = '" . $user . "' ");

    if (mysqli_fetch_assoc($user_check) > 1) {

        # code...
        echo "<script>alert('Username yang sama sudah terdaftar');history.go(-1);</script>";
        return false;
    }

    // cek password 
    if ($conrm !== $pass) {

        # code...
        echo "<script>alert('Password anda tidak sama');history.go(-1);</script>";
        return false;
    }

    // enkripsi password
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    // img function
    $img        = upload_user();

    $sql = "INSERT INTO tbl_users VALUES(NULL, '" . $name . "', '" . $user . "', '" . $pass . "', '" . $img . "', '" . $level . "') ";

    mysqli_query($koneksi, $sql);

    $cek = mysqli_affected_rows($koneksi);

    if ($cek > 0) {

        # code...
        header('location:../admin/user.php');
        $_SESSION['alert'] = true;
        $_SESSION['pesan_tambah'] = "Data Berhasi diTambahkan";
    } else {

        # code...
        echo mysqli_error($koneksi);
    }

    return $cek;
}

function delete_users($id)
{
    # code...
    $koneksi = koneksi();

    $fetch_img = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE id_user = '" . $id . "' ");

    $ambil = mysqli_fetch_assoc($fetch_img);

    $img_fetch = $ambil['foto_user'];

    unlink("../assets/img/users/" . $img_fetch);

    $query = "DELETE FROM tbl_users WHERE id_user = '" . $id . "' ";

    mysqli_query($koneksi, $query);

    $cek = mysqli_affected_rows($koneksi);

    if ($cek > 0) {

        # code...
        header('location:../admin/user.php');
        $_SESSION['alert'] = true;
        $_SESSION['pesan_hapus'] = "Data Berhasi diHapus";
    } else {

        # code...
        echo mysqli_error($koneksi);
    }

    return $cek;
}

function update_user($data)
{
    # code...
    $koneksi = koneksi();

    $user_id    = $data['user_id'];
    $name       = trim(strtolower(stripslashes($data['nama'])));
    $user       = trim(strtolower(stripslashes($data['username'])));
    $pass       = mysqli_real_escape_string($koneksi, $data['password']);
    $level      = trim(strtolower(stripslashes($data['role'])));

    $old_user   = $data['old_username'];
    $old_pass   = $data['old_password'];
    $old_imag   = $data['profile_lama'];

    // img function
    $img        = upload_user();

    if (!$img) {

        # code...
        return false;
    }

    if ($img === "default.jpg") {

        # code...
        $img = $old_imag;
    } else {

        # code...
        $result_img = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE id_user = '" . $user_id . "' ");

        $fetch_img = mysqli_fetch_assoc($result_img);

        if (is_file("../assets/img/users/" . $fetch_img['foto_user']))
            unlink("../assets/img/users/" . $fetch_img['foto_user']);
    }

    if ($user === "") {

        # code...
        $user = $old_user;
    } else {

        # code...
        $result_user = mysqli_query($koneksi, "SELECT * FROM tbl_users WHERE username_user = '" . $user . "' ");

        if (mysqli_fetch_assoc($result_user) > 1) {

            # code...
            echo "<script>alert('Username yang sama sudah terdaftar');history.go(-1);</script>";
            return false;
        }
    }

    if ($pass === "") {

        # code...
        $pass = $old_pass;
    } else {

        # code...
        $pass = password_hash($pass, PASSWORD_DEFAULT);
    }

    $sql = "UPDATE tbl_users SET nama_user = '" . $name . "',
                                username_user = '" . $user . "',
                                password_user = '" . $pass . "',
                                foto_user = '" . $img . "',
                                level_user = '" . $level . "' WHERE id_user = '" . $user_id . "' ";

    mysqli_query($koneksi, $sql);

    $cek = mysqli_affected_rows($koneksi);

    if ($cek > 0) {

        # code...
        header('location:../admin/user.php');
        $_SESSION['alert'] = true;
        $_SESSION['pesan_edit'] = "Data Berhasi diUbah";
    } else {

        # code...
        echo mysqli_error($koneksi);
    }

    return $cek;
}


// kategori
function create_kategori($data)
{
    $koneksi = koneksi();

    $kategori       = trim(strtolower(stripslashes($data['kategori'])));

    $sql = "INSERT INTO tbl_kategori VALUES(NULL, '" . $kategori . "') ";

    mysqli_query($koneksi, $sql);

    $cek = mysqli_affected_rows($koneksi);

    if ($cek > 0) {

        # code...
        header('location:../admin/kategori.php');
        $_SESSION['alert'] = true;
        $_SESSION['pesan_tambah'] = "Data Berhasi diTambahkan";
    } else {

        # code...
        echo mysqli_error($koneksi);
    }

    return $cek;
}

function update_kategori($data)
{
    # code...
    $koneksi = koneksi();

    $kategori_id    = $data['kategori_id'];
    $kategori       = trim(strtolower(stripslashes($data['kategori'])));


    $sql = "UPDATE tbl_kategori SET kategori = '" . $kategori . "' WHERE id_kategori = '" . $kategori_id . "' ";

    mysqli_query($koneksi, $sql);

    $cek = mysqli_affected_rows($koneksi);

    if ($cek > 0) {

        # code...
        header('location:../admin/kategori.php');
        $_SESSION['alert'] = true;
        $_SESSION['pesan_edit'] = "Data Berhasi diUbah";
    } else {

        # code...
        echo mysqli_error($koneksi);
    }

    return $cek;
}

function delete_kategori($id)
{
    # code...
    $koneksi = koneksi();

    $query = "DELETE FROM tbl_kategori WHERE id_kategori = '" . $id . "' ";

    mysqli_query($koneksi, $query);

    $cek = mysqli_affected_rows($koneksi);

    if ($cek > 0) {

        # code...
        header('location:../admin/kategori.php');
        $_SESSION['alert'] = true;
        $_SESSION['pesan_hapus'] = "Data Berhasi diHapus";
    } else {

        # code...
        echo mysqli_error($koneksi);
    }

    return $cek;
}


// artikel