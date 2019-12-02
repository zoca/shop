<nav class="navbar navbar-default text-uppercase" style="background-color: #e1e1e1;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php">
                <img src="/assets/img/logo.png" alt="WEB SCHOOL" class="img-responsive">
            </a>
        </div>

        <?php if ($navCategories > 0) { ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-menu">
                <ul class="nav navbar-nav navbar-right text-center">
                    <?php foreach ($navCategories as $category) { ?>
                        <?php $numberOfProducts = countProductsByCategory($connection, $category['id']); ?>
                        <li><a href="/controllers/frontend/category.php?id=<?php echo htmlspecialchars($category['id']); ?>" class=""><?php echo htmlspecialchars($category['name']); ?>(<?php echo htmlspecialchars($numberOfProducts); ?>)</a></li>
                    <?php
                        } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        <?php } ?>
    </div><!-- /.container-fluid -->
</nav>