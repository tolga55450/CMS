<?php

function addCategory(){

    //ADD CATEGORY
    global $connection;
    if (isset($_POST["submit"])) {

        $new_cat_title = $_POST["cat_title"];

        if ($new_cat_title == "" || empty($new_cat_title)) {
            echo "This field cant be empty";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('$new_cat_title') ";
            $add_new_title = mysqli_query($connection, $query);

            if (!$add_new_title) {
                die(mysqli_error($connection));
            }
        }

    }
}

function deleteCategory(){

    //DELETE CATEGORIES WITH GET
    global $connection;
    if (isset($_GET['delete'])) {

        $delete_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = '$delete_cat_id'";
        $delete_cat_with_id = mysqli_query($connection, $query);
        if (!$delete_cat_with_id) {
            mysqli_error($connection);
        }
        //Header send page to categories.php
        header("Location: categories.php");

    }

}

function find_update_category(){

    //FIND ALL CATEGORIES
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_cat = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_cat)) {

        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        ?>

        <tbody>
        <tr>
            <td><?php echo $cat_id; ?></td>


            <?php //UPDATE CATEGORY NAME

            if(isset($_GET["update"])){
                $update_cat_id = $_GET["update"];
                if($cat_id == $update_cat_id){ ?>
                    <?php
                    if (isset($_POST["up_submit"])) {

                        $up_cat_name = $_POST["up_cat_name"];
                        $up_query = "UPDATE categories SET cat_title = '$up_cat_name' WHERE cat_id = '$update_cat_id'";
                        $update_table = mysqli_query($connection, $up_query);
                        if (!$up_query) {
                            mysqli_error($connection);
                        }
                        header("Location: categories.php");

                    }

                    ?>
                    <td>
                        <form action="" method="post">
                            <input class = 'form-control' type = 'text' name="up_cat_name" placeholder='<?php echo $cat_title;?>'>
                            <input class = 'btn btn-primary' type='submit' name='up_submit' value='update'>
                        </form>

                    </td>
                    <?php
                }
                else{
                    echo "<td>{$cat_title}</td>";
                }
            }
            else{
                echo "<td>{$cat_title}</td>";
            }

            ?>


            <!-- Delete Categories with GET method -->
            <td><a href='categories.php?delete=<?php echo $cat_id; ?>'>Delete</a></td>
            <td><a href='categories.php?update=<?php echo $cat_id; ?>'>Edit</a></td>
        </tr>

        </tbody>

    <?php } ?>

<?php
}

function addPosts(){
    global $connection;
    if(isset($_POST["submit"])){

        $post_title = $_POST["post_title"];
        $post_author = $_POST["post_author"];
        $post_content = $_POST["post_content"];
        $post_category = $_POST["post_category"];
        $post_category = explode(" ",$post_category);
        $post_image = $_POST["post_image"];
        $post_tags = $_POST["post_tags"];
        $post_date = date('Y-m-d', time());

        $query = "INSERT INTO posts (post_category, post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags) VALUES ('$post_category[1]','$post_category[0]','$post_title','$post_author','$post_date','$post_image','$post_content','$post_tags')";
        $add_to_posts = mysqli_query($connection,$query);
        if(!$add_to_posts){
            mysqli_error($connection);
        }
    }
}

function categorySelectDropdown(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_categories)){

        $cat_id_title = [$row["cat_id"],$row["cat_title"]];
        ?>
        <option value='<?php echo $cat_id_title[0] ." ".$cat_id_title[1];?>'><?php echo $cat_id_title[1];?></option>


    <?php }
}

function viewPosts(){

    global $connection;

    $query = "SELECT * FROM posts";
    $select_all_post = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_post)){

        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_title = $row["post_title"];
        $post_category = $row["post_category"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_comment_count = $row["post_comment_count"];
        $post_date = $row["post_date"];
        ?>

        <tr>
            <td><input style="position: relative; bottom: 5px;" type="checkbox"></td>
            <td><?php echo $post_id;?></td>
            <td><?php echo $post_author;?></td>
            <td><?php echo $post_title;?></td>
            <td><?php echo $post_category;?></td>
            <td><?php echo $post_status;?></td>
            <td><img src='../images/<?php echo $post_image;?>' width="200" height="40"></td>
            <td><?php echo $post_tags;?></td>
            <td><?php echo $post_comment_count;?></td>
            <td><?php echo $post_date;?></td>
            <td><a href='../search.php?view=<?php echo $post_tags; ?>'>View</a></td>
            <td><a href='edit_post.php?edit=<?php echo $post_id; ?>'>Edit</a></td>
            <td><a href='view_posts.php?delete=<?php echo $post_id; ?>'>Delete</a></td>

        </tr>



    <?php }
}

function deletePosts(){

    global $connection;
    if(isset($_GET["delete"])){

        $delete_post_id = $_GET["delete"];

        $query = "DELETE FROM posts WHERE post_id = '$delete_post_id'";
        $delete_item = mysqli_query($connection,$query);

        if(!$delete_item){
            echo mysqli_error($connection);
        }

    }

}

function updatePosts()
{
    //Select Posts For Placeholders
    global $connection;
    if(isset($_GET["edit"])){

        $edit_post_id = $_GET["edit"];
        $query = "SELECT * FROM posts WHERE post_id = '$edit_post_id'";
        $select_specific = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($select_specific);

        $post_title = $row["post_title"];
        $post_author = $row["post_author"];
        $post_content = $row["post_content"];
        $post_category = $row['post_category'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];


    }
    ?>

    <?php
    //Update Post
    if(isset($_POST["submit"])) {

        $up_post_title = $_POST["up_post_title"];
        $up_post_author = $_POST["up_post_author"];
        $up_post_content = $_POST["up_post_content"];
        $up_post_category = $_POST["up_post_category"];
        $up_post_image = $_POST["up_post_image"];
        $up_post_tags = $_POST["up_post_tags"];

        if (empty($up_post_image)) {
            $up_post_image = $post_image;
        }
        if (empty($up_post_author)) {
            $up_post_author = $post_author;
        }
        if (empty($up_post_title)) {
            $up_post_title = $post_title;
        }
        if (empty($up_post_tags)) {
            $up_post_tags = $post_tags;
        }

        $up_query = "UPDATE posts SET post_title = '$up_post_title', post_author = '$up_post_author', post_content = '$up_post_content', post_category = '$up_post_category', post_image = '$up_post_image', post_tags = '$up_post_tags' WHERE post_id = '$edit_post_id'";
        $update_post = mysqli_query($connection, $up_query);

    }

    ?>

    <form action="" method="post">

        <div class="form-group">
            <label for="post_title">Post Title</label>
            <input type="text" name="up_post_title" class="form-control" placeholder='<?php echo $post_title;?>'>
        </div>

        <div class="form-group">
            <label for="post_author">Post Author</label>
            <input type="text" name="up_post_author" class="form-control"  placeholder='<?php echo $post_author;?>'>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="up_post_content" cols="100" rows="15" style="font-size: 16px;"><?php echo $post_content; ?></textarea>

        </div>

        <div class="form-group">
            <label for="post_category">Categories</label>
            <select name="up_post_category" class="form-control">

                <?php
                echo "<option value='{$post_category}'>{$post_category}</option>";
                $query = "SELECT * FROM categories";
                $select_all_categories = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($select_all_categories)){

                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];

                    if($cat_title != $post_category){
                        echo "<option value='{$cat_title}'>{$cat_title}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <br>
            <label id="label_1" for="image" style="font-size: 16px; color: #286090 ">Change Image <?php echo $post_image ;?></label>
            <input name="up_post_image" type="file" id="image" class="form-control-file hidden">
        </div>

        <div class="form-group">
            <label for="">Post Tags</label>
            <input name="up_post_tags" type="text" class="form-control" placeholder='<?php echo $post_tags;?>'>

        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit">Update</button>
        </div>

    </form>
<?php
}

function updateStatus(){

    global $connection;

    if(isset($_GET["verify"]) || isset($_GET["remove"])){
        if(isset($_GET["verify"])){
            $comment_id = $_GET["verify"];
            $query = "UPDATE comments SET comment_status = 'Published' WHERE comment_id = '$comment_id'";
        }
        if(isset($_GET["remove"])){
            $comment_id = $_GET["remove"];
            $query = "UPDATE comments SET comment_status = 'Pending' WHERE comment_id = '$comment_id'";
        }

        $update_status = mysqli_query($connection,$query);

        if(!$update_status){
            echo mysqli_error($connection);
        }

    }

}

function showComments(){
    global $connection;

    $query = "SELECT * FROM comments";

    //Show Comments

    $select_all_comments = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_all_comments)){

        $comment_id = $row["comment_id"];
        $comment_user = $row["comment_user"];
        $comment_user_id = $row["comment_user_id"];
        $comment_title = $row["comment_title"];
        $comment_content = $row["comment_content"];
        $comment_post_id = $row["comment_post_id"];
        $comment_date = $row["comment_date"];
        $comment_status = $row["comment_status"];

        ?>

        <tr>
            <td><?php echo $comment_id;?></td>
            <td><?php echo $comment_user;?></td>
            <td><?php echo $comment_user_id;?></td>
            <td><?php echo $comment_title;?></td>
            <td><?php echo $comment_content;?></td>
            <td><?php echo $comment_post_id;?></td>
            <td><?php echo $comment_date;?></td>
            <?php
            if($comment_status == "Pending"){
                echo "<td>{$comment_status} <a href='admin_comment.php?verify={$comment_id}' style='color: #4cae4c;'>Verify</a></td>";
            }
            else{
                echo "<td>{$comment_status} <a href='admin_comment.php?remove={$comment_id}' style='color: #dd0f22;'>Remove</a></td>";
            }
            ?>
            <td><a href="admin_comment.php?delete=<?php echo $comment_id;?>">Delete</a></td>

        </tr>

    <?php }
}

function showPendingComments(){
    global $connection;
    //Show Pending Comments
    $query = "SELECT * FROM comments WHERE comment_status = 'Pending'";
    $select_all_comments = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_all_comments)){

        $comment_id = $row["comment_id"];
        $comment_user = $row["comment_user"];
        $comment_user_id = $row["comment_user_id"];
        $comment_title = $row["comment_title"];
        $comment_content = $row["comment_content"];
        $comment_post_id = $row["comment_post_id"];
        $comment_date = $row["comment_date"];
        $comment_status = $row["comment_status"];

        ?>

        <tr>
            <td><?php echo $comment_id;?></td>
            <td><?php echo $comment_user;?></td>
            <td><?php echo $comment_user_id;?></td>
            <td><?php echo $comment_title;?></td>
            <td><?php echo $comment_content;?></td>
            <td><?php echo $comment_post_id;?></td>
            <td><?php echo $comment_date;?></td>
            <?php
            if($comment_status == "Pending"){
                echo "<td>{$comment_status} <a href='pending_comment.php?verify={$comment_id}' style='color: #4cae4c;'>Verify</a></td>";
            }
            else{
                echo "<td>{$comment_status} <a href='pending_comment.php?remove={$comment_id}' style='color: #dd0f22;'>Remove</a></td>";
            }
            ?>
            <td><a href="pending_comment.php?delete=<?php echo $comment_id;?>">Delete</a></td>

        </tr>

    <?php }
}

function showPublishedComments(){
    global $connection;

    $query = "SELECT * FROM comments WHERE comment_status = 'Published'";

    //Show Comments

    $select_all_comments = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_all_comments)){

        $comment_id = $row["comment_id"];
        $comment_user = $row["comment_user"];
        $comment_user_id = $row["comment_user_id"];
        $comment_title = $row["comment_title"];
        $comment_content = $row["comment_content"];
        $comment_post_id = $row["comment_post_id"];
        $comment_date = $row["comment_date"];
        $comment_status = $row["comment_status"];

        ?>

        <tr>
            <td><?php echo $comment_id;?></td>
            <td><?php echo $comment_user;?></td>
            <td><?php echo $comment_user_id;?></td>
            <td><?php echo $comment_title;?></td>
            <td><?php echo $comment_content;?></td>
            <td><?php echo $comment_post_id;?></td>
            <td><?php echo $comment_date;?></td>
            <?php
            if($comment_status == "Pending"){
                echo "<td>{$comment_status} <a href='published_comment.php?verify={$comment_id}' style='color: #4cae4c;'>Verify</a></td>";
            }
            else{
                echo "<td>{$comment_status} <a href='published_comment.php?remove={$comment_id}' style='color: #dd0f22;'>Remove</a></td>";
            }
            ?>
            <td><a href="published_comment.php?delete=<?php echo $comment_id;?>">Delete</a></td>

        </tr>

    <?php }
}

function deleteComments(){
    global $connection;
    if(isset($_GET["delete"])){
        $comment_id = $_GET["delete"];
        $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
        $delete_item = mysqli_query($connection,$query);
        if(!$delete_item){
            echo mysqli_error($connection);
        }
    }

}