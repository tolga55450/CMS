<?php include 'includes/admin_header.php'; ?>
<?php global $connection; ?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php";?>
    <?php include "functions.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add Post
                        <small>Author</small>
                    </h1>

                    <?php addPosts(); ?>

                    <form action="" method="post">

                        <div class="form-group col-xs-12">
                            <label for="post_title">Post Title</label>
                            <input type="text" class="form-control" name="post_title">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="post_author">Post Author</label>
                            <input type="text" class="form-control" name="post_author">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="post_content">Content</label>
                            <br>
                            <textarea name="post_content" id="" cols="100" rows="15" class="form-control"></textarea>

                        </div>

                        <div class="form-group col-xs-12">
                            <label for="categories">Select Category</label>
                            <select name="post_category" id="categories" class="form-control">
                                <option value="default">Please Select Category</option>
                            <?php categorySelectDropdown(); ?>
                            </select>
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="post_image">
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="post_title">Post Tags</label>
                            <input type="text" class="form-control" name="post_tags">
                        </div>

                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>

                    </form>


                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>