<?php
include('layouts/header.php');
include('tools/db.php');
$connection = getDatabaseConnection();

if (!isset($_SESSION["email"])) {
    header("location:/blog_system/index.php");
    exit;
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <?php
            if (isset($_SESSION['status']) && $_SESSION != '') {
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
            ?>
            <h2 class="text-center mb-4 ">Edit Your Comment</h2>
            <hr />

            <?php
            $id = $_GET['id'];
            $fetch_comment_query = "SELECT * FROM comments WHERE id='$id'";
            $fetch_comment_query_run = mysqli_query($connection, $fetch_comment_query);

            if (mysqli_num_rows($fetch_comment_query_run) > 0) {
                foreach ($fetch_comment_query_run as $row) {
            ?>
                    <form action="comment.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <!-- <label class="col-sm-4 col-form-label"> ID</label> -->
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'];?>">
                                <input type="hidden" class="form-control" name="post_id" value="<?php echo $row['post_id'];?>">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"> Comment</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="comment" value="<?php echo $row['comment'];?>">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="offset-sm-4 col-sm-4 d-grid">
                                <button type="submit" class="btn btn-primary" name="update_comment"> Update Comment </button>
                            </div>

                            <div class="col-sm-4 d-grid">
                                <a href="/blog_system/display_single_post.php?id=<?php echo $row['post_id'];?>" class="btn btn-outline-primary"> Cancel </a>
                            </div>
                        </div>
                    </form>
            <?php
                }
            } else {
                echo "NO DATA FOUND";
            }
            ?>


        </div>
    </div>
</div>