<header>
    <a href="<?php echo BASE_URL . "/index.php"; ?>" class="logo">
        <h1 class="logo-text"><span>Dios</span>Engineering</h1>
    </a>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <?php if (isset($_SESSION['username'])) : ?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa-solid fa-chevron-down"></i>
                </a>
                <!-- <i class="fa fa-user"></i> -->
                <ul>
                    <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>


        <!-- <li><a href="#">Sign-Up</a></li>
                    <li><a href="#">Login</a></li> -->

    </ul>
</header>