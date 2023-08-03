

<ul class="d-flex list-unstyled m-2">
        <?php if ($uid) : ?>
            <li class="mx-2"> <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a class="text-decoration-none text-white" href="logout.php">Logout</a></button></li>
        <?php else : ?>
            <li class="mx-2"> <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a class="text-decoration-none text-white" href="login.php">Login</a></button></li>
            <li class="mx-2"> <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a class="text-decoration-none text-white" href="signup.php">Signup</a></button></li>
        <?php endif; ?>
    </ul>