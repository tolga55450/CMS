<?php include "includes/db.php"; global $connection; //Including Database Connection ?>
<?php include "includes/header.php"; //Including Header ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; //Including Navigation ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <div class="col-md-8">
            <?php postDetails(); ?>
            <?php addComment(); ?>

            <!-- Comment Form -->
            <form action="" method="post">
                <div class="form-group">
                    <h2>Comment Section</h2>
                    <label for="">Comment Title</label>
                    <input type="text" class="form-control" name="comment_title">
                </div>

                <div class="form-group">
                    <label for="">Author</label>
                    <input type="text" class="form-control" name="comment_user">
                </div>
                
                <div class="form-group">
                    <label for="">Content</label>
                    <br>
                    <textarea name="comment_content" class="form-control" id="" cols="104" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Send Comment</button>
                </div>
            </form>

            <!-- Show Comments -->
            <h2>Comments</h2>
            <?php showComments();?>

        </div>




        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; //Including Sidebar ?>
    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; //Including Footer ?>