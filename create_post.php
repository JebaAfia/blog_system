<?php
include('layouts/header.php');

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
            <h2 class="text-center mb-4 ">Create Your Post</h2>
            <hr />
            <form action="posts.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label"> User Image</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="image" value="" type="file">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label"> Title</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="title" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label"> Details </label>
                    <div class="col-sm-8">
                        <input class="form-control" name="details" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary" name="save_post"> Save Post </button>
                    </div>

                    <div class="col-sm-4 d-grid">
                        <a href="/blog_system/index.php" class="btn btn-outline-primary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>