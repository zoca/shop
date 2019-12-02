<main>
    <div class="container">

        <?php
        if (count($allProductsForHomePage) > 0) {
            ?>
            <section class="product-wrapper">
                <h2>Istaknuti proizvodi</h2>
                <div class="row">
                    <?php foreach ($allProductsForHomePage as $value) { ?>

                        <!-- Ovo je sve jedan proizvod -->
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <article class="product">
                                <?php if (isset($value['sticker']) && !empty($value['sticker'])) {
                                            ?>
                                    <span class="sticker">
                                        <img src="<?php echo htmlspecialchars($value['sticker']); ?>" alt="" />
                                    </span>
                                <?php
                                        }
                                        ?>
                                <?php if (isset($value['image']) && !empty($value['image'])) {
                                            ?>
                                    <figure>
                                        <a href="/controllers/frontend/product.php?id=<?php echo htmlspecialchars($value['id']); ?>">
                                        <img src="<?php echo htmlspecialchars($value['image']); ?>" alt="<?php echo htmlspecialchars($value['title']); ?>" title="<?php echo htmlspecialchars($value['title']); ?>" />
                                        </a>
                                    </figure>
                                <?php
                                        }
                                        ?>
                                <p class="product-title"><?php echo htmlspecialchars($value['title']); ?></p>
                                <div class="product-price">
                                    <?php if (empty($value['discount'])) {
                                                ?>
                                        <p class="price ">Cena: <span><?php echo htmlspecialchars($value['price']); ?>e</span></p>
                                    <?php
                                            } else {
                                                ?>
                                        <p class="price ">Cena: <span><?php echo htmlspecialchars($value['price']); ?></span></p>
                                        <p class="discount-price">Sok cena: <span><?php echo htmlspecialchars(priceWithDiscount($value)); ?>e</span></p>

                                    <?php
                                            }
                                            ?>

                                </div>
                                <a href="/controllers/frontend/product.php?id=<?php echo htmlspecialchars($value['id']); ?>" class="more">Detail</a>
                                <a href="#"><span class="fa fa-shopping-cart"></span></a>
                            </article>
                        </div>
                    <?php
                        }
                        ?>
                    <!--Kraj proizvoda-->

                </div>
            </section>
            <!-- <section class="paginacija text-center">

                <ul class="pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>

            </section> -->


        <?php
        } else {
            ?>

            <p>Nema istaknutih proizvoda</p>
        <?php
        }
        ?>
        <section class="last-watched-products">
            <h2>Pregledani proizvodi</h2>
            <div class="row">
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <article class="product">

                        <figure>
                            <img src="/assets/img/products/sushi.thumb.jpeg" alt="" />
                        </figure>
                        <p class="product-title">Sushi</p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <article class="product">
                        <span class="sticker">
                            <img src="/assets/img/products/new.png" alt="" />
                        </span>
                        <figure>
                            <img src="/assets/img/products/sushi.thumb.jpeg" alt="" />
                        </figure>
                        <p class="product-title">Sushi</p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <article class="product">
                        <span class="sticker">
                            <img src="/assets/img/products/sale.png" alt="" />
                        </span>
                        <figure>
                            <img src="/assets/img/products/sushi.thumb.jpeg" alt="" />
                        </figure>
                        <p class="product-title">Sushi</p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <article class="product">
                        <span class="sticker">
                            <img src="/assets/img/products/vegeterian.png" alt="" />
                        </span>
                        <figure>
                            <img src="/assets/img/products/sushi.thumb.jpeg" alt="" />
                        </figure>
                        <p class="product-title">Sushi</p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <article class="product">
                        <span class="sticker">
                            <img src="/assets/img/products/homemade.png" alt="" />
                        </span>
                        <figure>
                            <img src="/assets/img/products/sushi.thumb.jpeg" alt="" />
                        </figure>
                        <p class="product-title">Sushi</p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <article class="product">
                        <figure>
                            <img src="/assets/img/products/sushi.thumb.jpeg" alt="" />
                        </figure>
                        <p class="product-title">Sushi</p>
                        <a href="#" class="more">Detail</a>
                    </article>
                </div>
            </div>
        </section>


    </div>
</main>
<!--main end-->