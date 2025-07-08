<?php
include('layouts/header.php');
include('tools/db.php');
$connection = getDatabaseConnection();
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['status']) && $_SESSION != '') {
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>HERE IS YOUR POSTS</h4>
                </div>
                <div class="card-body">
                    <?php
                    $fetch_post_query = "SELECT * FROM posts WHERE id= $_GET[id]";
                    $fetch_post_query_run = mysqli_query($connection, $fetch_post_query);

                    if (mysqli_num_rows($fetch_post_query_run) > 0) {
                        foreach ($fetch_post_query_run as $row) {
                    ?>
                            <div>
                                <img src="<?php echo "uploads/" . $row['image']; ?>" alt="" width="500" height="500">
                            </div>
                            <h3>
                                <div><?php echo $row['title'] ?></div>
                            </h3>
                            <h5>
                                <div><?php echo $row['details'] ?></div>
                            </h5>
                            <table>
                                <tr>
                                    <td>
                                        <a href="/blog_system/edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-success">EDIT</a>
                                    </td>
                                    <td>
                                        <form action="posts.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                            <input type="hidden" name="image" value="<?php echo $row['image'] ?>">
                                            <button type="submit" name="delete_post" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        <?php
                        }
                    } else {
                        ?>
                        <tr colspan="4">NO RECORD FOUND</tr>
                    <?php
                    }
                    ?>

                    <div>
                        <?php
                        $fetch_comment_query = "SELECT * FROM comments INNER JOIN users WHERE post_id= $_GET[id]";
                        // print_r($fetch_comment_query);
                        $fetch_comment_query_run = mysqli_query($connection, $fetch_comment_query);

                        ?>
                        <label for="exampleInputEmail1" class="form-label">Comments</label>
                        <?php
                        if (mysqli_num_rows($fetch_comment_query_run) > 0) {
                            foreach ($fetch_comment_query_run as $row) {
                        ?>      
                            <form action="comment.php" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']?>">
                                    <input type="hidden" name="post_id" value="<?php echo $_GET['id']?>">
                                    <input type="hidden" name="comment_id" value="<?php echo $row['id']?>">
                                    <div class="form-control col-md-8">   
                                    <?php echo $row['comment'] ?>
                                    <b>commented by</b>
                                    <?php echo $row['first_name']. " " .$row['last_name']?>
                                    </div>
                                    <a class="btn btn-success" type="submit" href="/blog_system/edit_comment.php?id=<?php echo $row['id']; ?>">EDIT</a>
                                    <button type="submit" name="delete_comment" class="btn btn-danger">DELETE</button>
                                </div>
                            </form>

                            <?php
                            }
                        } else {
                            ?>
                            <tr colspan="4">NO RECORD FOUND</tr>
                        <?php
                        }
                        ?>
                        <form action="comment.php" method="post">
                            <div>
                                <div class="mb-3">
                                    <input type="hidden" name="post_id" value="<?php echo $_GET['id']?>">
                                    <input type="text" class="form-control" name="comment" value="">
                                </div>
                                <button type="submit" class="btn btn-success" name="save_name">Add Your Comment</button>
                            </div>

                        </form>
                    </div>


                    <!-- <div>
                        <form action="">
                            <div class="mb-3">
                                <label for="disabledSelect" class="form-label">User Name</label>
                                <select id="disabledSelect" class="form-select">
                                    <option>Select From Here</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Comment</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>