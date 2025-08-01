<?php
session_start();

$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Orchids</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light boder-bottom shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="/blog_system/index.php">Orchids</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/blog_system/index.php">Home</a>
          </li>
        </ul>
        <?php
        if ($authenticated) { ?>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="btn btn-outline-primary me-2" href="/blog_system/create_post.php"> Create Post</a>
            </li>

            <li class="nav-item">
              <a class="btn btn-outline-primary me-2" href="/blog_system/display_posts.php"> All Posts</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/blog_system/profile.php">Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/blog_system/logout.php">Logout</a></li>
              </ul>
            </li>

          </ul>
        <?php } else { ?>

          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="/blog_system/register.php" class="btn btn-outline-primary me-2">Register</a>
            </li>

            <li class="nav-item">
              <a href="/blog_system/login.php" class="btn btn-primary">Login</a>
            </li>
          </ul>

        <?php } ?>

      </div>
    </div>
  </nav>