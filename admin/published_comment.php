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
                        Comment Section
                        <small>Author</small>
                    </h1>
                    <table class="table-hover table table-bordered">
                        <thead>
                        <tr>
                            <th>Comment ID</th>
                            <th>User</th>
                            <th>User ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Post_ID</th>
                            <th>Date</th>

                            <script src="js/functions.js"></script>
                            <th>
                                <select name="status" class="form-select" onchange="onSelectChange(this)">
                                    <option selected>Status</option>
                                    <option value="admin_comment">All</option>
                                    <option value="pending_comment">Pending</option>
                                    <option value="published_comment">Published</option>
                                </select>
                            </th>
                        </tr>

                        </thead>
                        <?php updateStatus(); ?>
                        <tbody>
                        <?php deleteComments();?>
                        <?php showPublishedComments();?>
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