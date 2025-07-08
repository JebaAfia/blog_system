<?php
session_start();

function uuidv4()
{
    $data = random_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

include('tools/db.php');
$connection = getDatabaseConnection();
print_r($_POST);
die();
if (isset($_POST['save_post'])) {
    $title = $_POST['title'];
    $details = $_POST['details'];
    $image_name = uuidv4() . $_FILES['image']['name'];

    $insert_post_query = "INSERT INTO posts(title, details, image) VALUES ('$title','$details','$image_name')";
    $insert_post_query_run = mysqli_query($connection, $insert_post_query);

    if ($insert_post_query_run) {
        print_r("uploads/" . $FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image_name);
        $_SESSION['status'] = "Post created successfully";
        header('location: /blog_system/display_posts.php');
    } else {
        $_SESSION['status'] = "Post does not created";
        header('location: /blog_system/create_post.php');
    }
}

if (isset($_POST['update_post'])) {
    $id = $_POST['id'];
    $image_new = $_FILES['image']['name'];
    $image_old = $_POST['image_old'];
    $title = $_POST['title'];
    $details = $_POST['details'];

    if ($image_new != '') {
        $update_filename = uuidv4() . $image_new;
    } else {
        $update_filename = $image_old;
    }

    $update_post_query = "UPDATE posts SET image='$update_filename', title='$title', details='$details' WHERE id='$id'";
    $update_post_query_run = mysqli_query($connection, $update_post_query);

    // print_r($update_post_query);

    if ($update_post_query_run) {
        if ($image_new != '') {
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $update_filename);
            unlink("uploads/" . $image_old);
        }
        $_SESSION['status'] = "Post updated seccessfully";
        header('location: /blog_system/display_posts.php');
    } else {
        $_SESSION['status'] = "Post does not updated";
        header('location: /blog_system/edit_post.php');
    }
}

if (isset($_POST['delete_post'])) {
    $id = $_POST['id'];
    $image = $_POST['image'];

    $delete_post_query = "DELETE FROM posts WHERE id='$id'";
    $delete_post_query_run = mysqli_query($connection, $delete_post_query);

    if ($delete_post_query_run) {
        unlink("uploads/".$image);
        $_SESSION['status'] = "Post deleted successfully!";
        header('location: /blog_system/display_posts.php');
    }
    else {
       $_SESSION['status'] = "Post not deleted yet!";
        header('location: /blog_system/display_posts.php');
    }
}
