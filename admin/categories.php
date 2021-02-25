<?php include 'includes/admin_header.php'; ?>
<?php include "functions.php";?>

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

                    <!-- Add Category Form -->
                    <div class="col-xs-6">
                        <?php addCategory(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" placeholder="Category Name ..">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <!-- /.Add Category Form -->


                    <?php deleteCategory();?>


                    <!-- List Categories -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>

                            <?php find_update_category(); ?>

                        </table>

                    </div>
                    <!-- /.List Categories -->

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>