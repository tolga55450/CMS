<?php include "includes/db.php"; global $connection; //Including Database Connection ?>
<?php include "includes/header.php"; //Including Header ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; //Including Navigation ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Welcome to Blog
                    <small>Enjoy your meal</small>
                </h1>

                <?php searchSystem(); ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; //Including Sidebar ?>
        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; //Including Footer ?>