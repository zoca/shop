<style>
    th a {
        color: white;
    }
</style>
<main>
    <div class="container">
        <section class="tipografy">
            <h1>All stickers</h1>
        </section>

        <section class="include-table">
            <div class="table-responsive">
                <?php
                    if(count($stickers) > 0 ){
                        ?>
                            <table class="table  table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            Title
                                            <a href="/controllers/stickers/all.php?order-by=title&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/stickers/all.php?order-by=title&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>Color</th>
                                        <th>Icon</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        foreach ($stickers as $value) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $value['title'] ?></td>
                                                    <td>
                                                        <div style="margin: 0 auto; width: 30px; height: 30px; background-color: <?php echo $value['color'] ?>;"></div>
                                                    </td>
                                                    <td>
                                                        <img style="width: 100px; height: auto;" src="<?php echo $value['image'] ?>">
                                                    </td>
                                                    <td>
                                                        <a href="/controllers/stickers/edit.php?id=<?php echo $value['id']; ?>">Edit</a>
                                                        <a href="/controllers/stickers/delete.php?id=<?php echo $value['id']; ?>">Delete</a>
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