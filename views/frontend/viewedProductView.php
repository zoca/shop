<section class="last-watched-products">
    <h2>Pregledani proizvodi</h2>
    <div class="row">

        <?php
        if (isset($_COOKIE['viewedProducts'])) {
            $allVievedProducts = getViewedProducts($connection, $_COOKIE['viewedProducts']);

            foreach ($allVievedProducts as $product) { ?>
                <div class="col-xs-6 col-sm-3 col-lg-2 ">
                    <article class="product">
                        <figure>
                            <img src="img/products/sushi.thumb.jpeg" alt="" />
                            <?php if (isset($product['image']) && !empty($product['image'])) {
                                        ?>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" title="<?php echo htmlspecialchars($product['title']); ?>" />

                            <?php
                                    }
                                    ?>
                        </figure>
                        <p class="product-title"><?php echo htmlspecialchars($product['title']); ?></p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
        <?php
            }
        }
        ?>

    </div>
</section>
</div><!-- kraj levog kontejnera-->