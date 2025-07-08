<?php
include('layouts/header.php');

if (isset($_SESSION["email"])) {
    header("location:/blog_system/index.php");
    exit;
}

$email = "";
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Email and Password are required";
    } else {
        include "tools/db.php";
        $dbConnection = getDatabaseConnection();

        $statement = $dbConnection->prepare(
            "SELECT id, first_name, last_name, phone, address, password, created_at FROM users WHERE email = ?"
        );
        $statement->bind_param('s', $email);
        $statement->execute();

        $statement->bind_result($id, $first_name, $last_name, $phone, $address, $stored_password, $created_at);

        if ($statement->fetch()) {
            if (password_verify($password, $stored_password)) {
                $_SESSION["id"] = $id;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
                $_SESSION["address"] = $address;
                $_SESSION["created_at"] = $created_at;

                header("location:/blog_system/index.php");
                exit;
            }
        }

        $statement->close();
        $error = "Email or Password invalid";
    }
}
?>


<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <hr />

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong> <?= $error ?> </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" area-label="Close"></button>

            </div>
        <?php } ?>



        <form method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" value="<?= $email ?>" />
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" />
            </div>

            <div class="row mb-3">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-primary"> Log In </button>
                </div>

                <div class="col d-grid">
                    <a href="/blog_system/index.php" class="btn btn-outline-primary"> Cancel </a>
                </div>
            </div>
        </form>
    </div>

</div>