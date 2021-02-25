<?php include 'includes/admin_header.php'; ?>
<?php include "functions.php"; ?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin
                        <small>Author</small>
                    </h1>

                    <!-- View Posts -->
                    <div class="col-xs-12">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><input style="position: relative; bottom: 5px;" type="checkbox"></th>
                                <th>Post ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- Delete Current Post -->
                            <?php deletePosts(); ?>

                            <!-- List all Posts -->
                            <?php viewPosts();?>

                            </tbody>

                        </table>


                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>