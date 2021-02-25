<?php

function selectCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection,$query);

    //Adding Nav bar something from dynamic data from database
    while($row = mysqli_fetch_assoc($select_all_categories_query)){

        $cat_title = $row["cat_title"];
        $cat_id = $row["cat_id"];
        echo "<li><a href='search.php?category={$cat_id}'>{$cat_title}</a></li>";

    }
}

function searchSystem(){

    global $connection;
    $flag = 1;
    if (isset($_POST["submit"]) || isset($_GET["view"]) || isset($_GET["category"])) {

        if(isset($_POST["submit"])){
            $keyword = $_POST["key"];
            $flag = 0;
        }
        else if(isset($_GET["view"])){
            $keyword = $_GET["view"];
            $flag = 0;
        }
        else if(isset($_GET["category"])){
            $keyword = $_GET["category"];
        }

        //NEW QUERY LIKE
        if($flag == 0){
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$keyword%'";
        }
        else{
            $query = "SELECT * FROM posts WHERE post_category_id = '$keyword'";
        }

        $search_query = mysqli_query($connection, $query);

        //Checking
        if (!$search_query) {
            die("Query Failed" . mysqli_error($connection));
        }

        $counter = mysqli_num_rows($search_query);

        if($counter == 0){
            echo "<h2>NO RESULT";
        }

        while($row = mysqli_fetch_assoc($search_query)){

            $post_id = $row["post_id"];
            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_image = $row["post_image"];
            $post_content = $row["post_content"];

            ?>
            <!-- First Blog Post -->
            <h2><a href='post.php?details=<?php echo $post_id;?>'><?php echo $post_title;?></a></h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author;?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image;//Image reference?>" alt="">
            <hr>
            <p><?php echo $post_content;?></p>
            <a class="btn btn-primary" href='post.php?details=<?php echo $post_id;?>'>Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        <?php }
    }


}

function postDetails(){
    //post.php
    if (isset($_GET["details"])) {

        global  $connection;
        $post_id = $_GET["details"];

        //NEW QUERY LIKE
        $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $search_query = mysqli_query($connection, $query);

        //Checking
        if (!$search_query) {
            die("Query Failed" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($search_query)){

            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_image = $row["post_image"];
            $post_content = $row["post_content"];

            ?>
            <!-- First Blog Post -->
            <h2><?php echo $post_title;?></h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author;?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image;//Image reference?>" width="750">
            <hr>
            <p><?php echo $post_content;?></p>
            <hr>

        <?php }
    }
}

function showAllPosts(){
    global $connection;
    $query = "SELECT * FROM posts ";
    $select_all_posts_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_posts_query)){

        $post_id = $row["post_id"];
        $post_title = $row["post_title"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_image = $row["post_image"];
        $post_content = $row["post_content"];

        ?>
        <!-- First Blog Post -->
        <h2><a href='post.php?details=<?php echo $post_id;?>'><?php echo $post_title;?></a></h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author;?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image;//Image reference?>" width="750">
        <hr>
        <p><?php echo $post_content;?></p>
        <a class="btn btn-primary" href='post.php?details=<?php echo $post_id;?>'>Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

    <?php }
}

function addComment(){
    //Add Comment
    if(isset($_POST["submit"])){
        global $connection;

        $comment_title = $_POST["comment_title"];
        $comment_user = $_POST["comment_user"];
        $comment_content = $_POST["comment_content"];
        $comment_date = date("Y-m-d",time());
        $comment_post_id = $_GET["details"];
        $comment_status = "Pending";

        //This allows to recognize ' things so it keeps out us from database attacks
        $comment_title = mysqli_real_escape_string($connection,$comment_title);
        $comment_content = mysqli_real_escape_string($connection,$comment_content);
        $comment_user = mysqli_real_escape_string($connection,$comment_user);


        $query = "INSERT INTO comments (comment_title,comment_user,comment_content,comment_date,comment_post_id,comment_status) VALUES ('$comment_title','$comment_user','$comment_content','$comment_date','$comment_post_id','$comment_status')";
        $add_comment = mysqli_query($connection,$query);

        if (!$add_comment){
            echo mysqli_error($connection);
        }

    }
}

function showComments(){
    //Get all Comments about this post
    global $connection;
    $comment_post_id = $_GET["details"];

    $query = "SELECT * FROM comments WHERE comment_post_id = '$comment_post_id'";
    $select_comments = mysqli_query($connection,$query);

    $counter_query = "SELECT * FROM comments WHERE comment_status = 'Published' AND comment_post_id = '$comment_post_id'";
    $for_published_counter = mysqli_query($connection,$counter_query);

    echo mysqli_num_rows($for_published_counter) . " Comments For This Post<br><br>";

    while($row = mysqli_fetch_assoc($select_comments)){

        $comment_title = $row["comment_title"];
        $comment_content = $row["comment_content"];
        $comment_user = $row["comment_user"];
        $comment_status = $row["comment_status"];

        if($comment_status == "Published"){

            ?>
        <div class="col-md-12">

            <div class="row">

                <h4><strong style="color: #e01616"><?php echo $comment_title;?></strong></h4>
                <h5><strong><?php echo $comment_user;?></strong></h5>

            </div>
            <div class="row">
                <p><?php echo $comment_content;?></p>
            </div>
            <br>

        </div>
        <?php
        }
    }
}




