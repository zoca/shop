<header>
    <div class="header-top text-center">
        <div class="container">
            <ul class="sign-in list-inline">
                <?php
                    if(loginStatus()){
                        ?>
                            <li><a href="/controllers/stickers/create.php">New sticker</a></li>
                            <li><a href="/controllers/stickers/all.php">All stickers</a></li>
                            <li><a href="/controllers/categories/create.php">New category</a></li>
                            <li><a href="/controllers/categories/all.php">All categories</a></li>
                            <li><a href="/controllers/users/create.php">New user</a></li>
                            <li><a href="/controllers/users/all.php">All users</a></li>
                            <li><a href="/controllers/products/create.php">New product</a></li>
                            <li><a href="/controllers/products/all.php">All products</a></li>
                            <li><?php echo $_SESSION['loginUser']; ?>, <a href="/controllers/logout.php">Logout</a></li>
                        <?php
                    } else {
                        ?>
                            <li><a href="/controllers/login.php">Login</a></li>
                        <?php
                    }
                ?>
                
            </ul>
            <div class="social">
                <a href="#"><span class="fa fa-facebook"></span></a>
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-linkedin"></span></a>
            </div>
        </div>
    </div>
</header>