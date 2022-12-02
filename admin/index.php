<!-- header -->
<?php include "include/header.php" ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- sidebar navbar -->
    <?php include "include/sidebar.php" ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php

        if (empty($_GET['page'])) {

            require_once "dashboard/dashboard.php";
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