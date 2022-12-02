<!-- header -->
<?php include "include/header.php" ?>

<!-- function -->
<?php

$datas = show_data("SELECT * FROM tbl_kategori");

if (isset($_POST['create'])) {

    # code...
    if (create_kategori($_POST) > 0) {

        # code...
        return true;
    } else {

        # code...
        return false;
    }
}

if (isset($_POST['update'])) {

    # code...
    if (update_kategori($_POST) > 0) {

        # code...
        return true;
    } else {

        # code...
        return false;
    }
}

?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- sidebar navbar -->
    <?php include "include/sidebar.php" ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php

        if (empty($_GET['page'])) {

            # code...
            require_once "categories/home.php";
            // 
        } elseif ($_GET['page'] === "create") {

            # code...
            require_once "categories/create.php";
            // 
        } elseif ($_GET['page'] === "delete") {

            # code...
            require_once "categories/delete.php";
            // 
        } elseif ($_GET['page'] === "edit") {

            # code...
            require_once "categories/edit.php";
        } else {

            # code...
            echo "4004";
        }

        ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- link footer -->
<?php include "include/footer.php" ?>