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
            <h2 class="text-center mb-4 ">Edit Your Post</h2>
            <hr />

            <?php
            $id = $_GET['id'];
            $fetch_post_query = "SELECT * FROM posts WHERE id='$id'";
            $fetch_post_query_run = mysqli_query($connection, $fetch_post_query);

            if (mysqli_num_rows($fetch_post_query_run) > 0) {
                foreach ($fetch_post_query_run as $row) {
            ?>
                    <form action="posts.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <!-- <label class="col-sm-4 col-form-label"> ID</label> -->
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'];?>">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"> User Image</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="image" value="" type="file">
                                <input type="hidden" name="image_old" value="<?php echo $row['image'];?>">
                                <img src="<?php echo "uploads/" . $row['image'];?>" width="80" height="80" alt="">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"> Title</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="title" value="<?php echo $row['title'];?>">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"> Details </label>
                            <div class="col-sm-8">
                                <input class="form-control" name="details" value="<?php echo $row['details'];?>">
                                <span class="text-danger"></span>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="offset-sm-4 col-sm-4 d-grid">
                                <button type="submit" class="btn btn-primary" name="update_post"> Update Post </button>
                            </div>

                            <div class="col-sm-4 d-grid">
                                <a href="/blog_system/index.php" class="btn btn-outline-primary"> Cancel </a>
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