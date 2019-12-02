<main>
    <div class="container">
        <section class="tipografy">
            <h1>New sticker</h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if(!$insertStatus){
                ?>
                    <section class="form-elements">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" value="<?php echo isset($formData["title"]) ? htmlspecialchars($formData["title"]) : "";?>">
                                <?php 
                                    if (isset($formErrors["title"])) {
                                        foreach($formErrors["title"] as $errorMessage) {
                                            ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo $errorMessage;?>
                                                </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Color</label>
                                <input class="form-control" type="color" name="color" value="<?php echo isset($formData["color"]) ? htmlspecialchars($formData["color"]) : "";?>">
                                <?php 
                                    if (isset($formErrors["color"])) {
                                        foreach($formErrors["color"] as $errorMessage) {
                                            ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo $errorMessage;?>
                                                </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" value="">
                                <?php 
                                    if (isset($formErrors["image"])) {
                                        foreach($formErrors["image"] as $errorMessage) {
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
                            <input type="submit" name="submit" value="Save">

                        </form>
                    </section>
                <?php
            }
        ?>
    </div>
</main><!--main end-->