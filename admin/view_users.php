<?php include 'includes/admin_header.php'; ?>
<?php include "functions.php"?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        View Users
                        <small>Author</small>
                    </h1>

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Users ID</th>
                            <th>Users Image</th>
                            <th>Users Username</th>
                            <th>Users Name</th>
                            <th>Users Mail</th>
                            <th>Users Password</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php deleteUsers();?>
                        <?php showUsers();?>

                        </tbody>

                    </table>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>