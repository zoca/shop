<main>
    <div class="container">
        <section class="tipografy">
            <h1>Delete product<?php if($status){ echo ": " . $openedRow['title']; } ?></h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if($status && !$deleteStatus){
                ?>
                    <section class="form-elements">
                        <form method="post" action="" enctype="multipart/form-data">                            
                            <!--ISKOPIRATI ZA INPUT TYPE SUBMIT-->
                            <input style="background: red;" type="submit" name="submit" value="Yes, delete">
                            <input type="submit" name="submit" value="Cancel">

                        </form>
                    </section>
                <?php
            }
        ?>
    </div>
</main><!--main end-->