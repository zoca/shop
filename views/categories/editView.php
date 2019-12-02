<main>
    <div class="container">
        <section class="tipografy">
            <h1>Edit category</h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if($status && !$editStatus){
                ?>
                    <section class="form-elements">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="<?php echo isset($formData["name"]) ? htmlspecialchars($formData["name"]) : "";?>">
                                <?php 
                                    if (isset($formErrors["name"])) {
                                        foreach($formErrors["name"] as $errorMessage) {
                                            ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo $errorMessage;?>
                                                </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                            
                            <!--ISKOPIRATI ZA INPUT TYPE SUBMIT-->
                            <input type="submit" name="submit" value="Edit">

                        </form>
                    </section>
                <?php
            }
        ?>
    </div>
</main><!--main end-->