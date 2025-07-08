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
                    <h4>ALL POSTS</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Details</th>
                                <th scope="col">Edit Posts</th>
                                <th scope="col">View Single Post</th>
                                <th scope="col">Delete Posts</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetch_post_query = "SELECT * FROM posts";
                            $fetch_post_query_run = mysqli_query($connection, $fetch_post_query);

                            if (mysqli_num_rows($fetch_post_query_run) > 0) {
                                foreach ($fetch_post_query_run as $row) {
                            ?> <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td>
                                            <img src="<?php echo "uploads/" . $row['image']; ?>" alt="" width="100" height="100">
                                        </td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['details'] ?></td>
                                        <td>
                                            <a href="/blog_system/edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-success">EDIT</a>
                                        </td>

                                        <td>
                                            <a href="/blog_system/display_single_post.php?id=<?php echo $row['id']; ?>" class="btn btn-success">VIEW</a>
                                        </td>

                                        <td>
                                            <form action="posts.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                <input type="hidden" name="image" value="<?php echo $row['image'] ?>">
                                                <button type="submit" name="delete_post" class="btn btn-danger">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr colspan="4">NO RECORD FOUND</tr>
                            <?php
                            }
                            ?>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>