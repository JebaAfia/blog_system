<?php
session_start();
include('tools/db.php');
$connection = getDatabaseConnection();

// print_r($_POST);
// die();
if (isset($_POST['save_name'])) {
    $user_id = $_SESSION['id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    
 if (!empty($comment)) {
    $insert_comment_query = "INSERT INTO comments(user_id, post_id, comment) VALUES ('$user_id','$post_id','$comment')";
    $insert_comment_query_run = mysqli_query($connection, $insert_comment_query);

    if ($insert_comment_query_run) {
        $_SESSION['status'] = "Comment created successfully";
        header('location: /blog_system/display_single_post.php?id='.$post_id);
    } else {
        $_SESSION['status'] = "Comment does not created";
        header('location: /blog_system/display_single_post.php?id='.$post_id);
    }
 } else {
    $_SESSION['status'] = "Comment cannot be empty";
    header('location: /blog_system/display_single_post.php?id='.$post_id);
 }
    
}

if (isset($_POST['update_comment'])) {
    $post_id = $_POST['post_id'];
    $comment_id = $_POST['id'];
    $comment = $_POST['comment'];

    $update_comment_query = "UPDATE comments SET comment='$comment' WHERE id='$comment_id'";
    $update_comment_query_run = mysqli_query($connection, $update_comment_query);

    if ($update_comment_query_run) {
        $_SESSION['status'] = "Comment updated seccessfully";
        header('location: /blog_system/display_single_post.php?id='.$post_id);
    } else {
        $_SESSION['status'] = "Comment does not updated";
        header('location: /blog_system/edit_comment.php');
    }
}

if (isset($_POST['delete_comment'])) {
    $post_id = $_POST['post_id'];
    $comment_id = $_POST['comment_id'];

    $delete_comment_query = "DELETE FROM comments WHERE id='$comment_id'";
    $delete_comment_query_run = mysqli_query($connection, $delete_comment_query);

    if ($delete_comment_query_run) {
        $_SESSION['status'] = "Comment deleted successfully!";
        header('location: /blog_system/display_single_post.php?id='.$post_id);
    }
    else {
       $_SESSION['status'] = "Comment is not deleted yet!";
        header('location: /blog_system/display_single_post.php?id='.$post_id);
    }
}