<?php

require_once "../func/fungsi.php";

$id = $_GET['id'];

if (delete_kategori($id) > 0) {

    # code...
    return true;
} else {

    # code...
    return true;
}
