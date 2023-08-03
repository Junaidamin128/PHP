<?php


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script>
        const BASE_URL = "<?= BASE_URL?>";
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary row">
        <a class="navbar-brand col-2 m-auto text-center" href="#">Social</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if(isset($uid)):?>
            <ul class="navbar-nav mr-auto col-4 offset-8">
                <li class="nav-item align-self-center">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <li class="nav-item align-self-center">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-uppercase" href="profile.php"><img class="d-inline rounded-circle mx-2 w-25" src="./images/10x-featured-social-media-image-size.png" alt=""><?= $current_user['fullname'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-uppercase btn btn-danger" href="logout.php">Logout</a>
                </li>
                
            </ul>
<?php endif;?>
<?php if(!isset($uid)):?>
            <form class="form-inline my-2 my-lg-0 col-6 offset-6" method="POST">
                <input class="form-control mr-sm-2" name="username" type="text" placeholder="Username" aria-label="Search">
                <input class="form-control mr-sm-2" name="password" type="password" placeholder="Password" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0" name="login" type="submit">Sign In</button>
            </form>
<?php endif;?>
        </div>
    </nav>