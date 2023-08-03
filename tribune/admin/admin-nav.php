<aside class="panel col-2 border bg-dark text-white p-2">
        <div class="user row py-2">
            <img class="col-4 rounded-circle" src="../images/tribune-logo.webp" alt="">
            <h5 class="col-8 m-0 text-center"><?=$current_user['username']?></h5>
        </div>
        <div class="dropdown">
            <button class="btn btn-primary w-100 my-2" type="button">
                <a class="text-decoration-none text-white " href="./admin.php">Dashboard</a>
            </button>
            <button class="btn btn-primary dropdown-toggle w-100 my-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
            </button>
            <div class="dropdown-menu w-100 text-center" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="./admin-news.php">News</a>
                <a class="dropdown-item" href="./admin-author.php">Authors</a>
                <a class="dropdown-item" href="./admin-category.php">Categories</a>
            </div>
        </div>
    </aside>