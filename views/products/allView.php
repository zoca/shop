<style>
    th a {
        color: white;
    }
</style>
<main>
    <div class="container">
        <section class="tipografy">
            <h1>All products</h1>
        </section>

        <section class="include-table">
            <div class="table-responsive">
                <?php
                    if(count($products) > 0 ){
                        ?>
                            <table class="table  table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            Title
                                            <a href="/controllers/products/all.php?order-by=title&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/products/all.php?order-by=title&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>Category</th>
                                        <th>Sticker</th>
                                        <th>
                                            Price
                                            <a href="/controllers/products/all.php?order-by=price&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/products/all.php?order-by=price&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>
                                            Discount
                                            <a href="/controllers/products/all.php?order-by=discount&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/products/all.php?order-by=discount&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>Quantity</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        foreach ($products as $value) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $value['title'] ?></td>
                                                    <td><?php echo $value['category_id'] ?></td>
                                                    <td><?php echo $value['sticker_id'] ?></td>
                                                    <td><?php echo $value['price'] ?></td>
                                                    <td><?php echo $value['discount'] ?></td>
                                                    <td><?php echo $value['quantity'] ?></td>
                                                    <td>
                                                        <a href="#">Preview</a>
                                                        <a href="/controllers/products/edit.php?id=<?php echo $value['id']; ?>">Edit</a>
                                                        <a href="/controllers/products/delete.php?id=<?php echo $value['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                    
                                </tbody>
                            </table> 
                        <?php
                    } else{
                        ?>
                            <p>There are no products!!!</p>
                        <?php
                    }
                ?>
                
                
            </div>
        </section>
    </div>
</main><!--main end-->