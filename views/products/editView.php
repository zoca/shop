<main>
    <div class="container">
        <section class="tipografy">
            <h1>Edit product</h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if(!$editStatus){
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
                                <label>Description</label>
                                <textarea class="form-control" name="description"><?php echo isset($formData["description"]) ? htmlspecialchars($formData["description"]) : "";?></textarea>
                                <?php 
                                    if (isset($formErrors["description"])) {
                                        foreach($formErrors["description"] as $errorMessage) {
                                            ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo $errorMessage;?>
                                                </div>
                                            <?php
                                        }
                                    }
                                ?>
                                <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

                                <script>
                                    CKEDITOR.replace( 'description' );
                                </script>
                            </div>
                            
                            <div class="form-group">
                                <label>Current image</label>
                                <?php
                                    if(isset($openedRow['image']) && !empty($openedRow['image'])){
                                        ?>
                                            <img src="<?php echo $openedRow['image']; ?>">
                                        <?php
                                    } else {
                                        echo "<p>There is no image</p>";
                                    }
                                ?>
                                
                            </div>
                            
                            
                            <div class="form-group">
                                <label>New image</label>
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
                            
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" type="text" name="price" value="<?php echo isset($formData["price"]) ? htmlspecialchars($formData["price"]) : "";?>">
                                <?php 
                                    if (isset($formErrors["price"])) {
                                        foreach($formErrors["price"] as $errorMessage) {
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
                                <label style="display: block;">Discount</label>
                                <input style="display: inline-block; width: 20%;" class="form-control" type="text" name="discount" value="<?php echo isset($formData["discount"]) ? htmlspecialchars($formData["discount"]) : "";?>">%
                                <?php 
                                    if (isset($formErrors["discount"])) {
                                        foreach($formErrors["discount"] as $errorMessage) {
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
                                <label style="display: block;">Quantity</label>
                                <input style="display: inline-block; width: 20%;" class="form-control" type="text" name="quantity" value="<?php echo isset($formData["quantity"]) ? htmlspecialchars($formData["quantity"]) : "";?>">pieces
                                <?php 
                                    if (isset($formErrors["quantity"])) {
                                        foreach($formErrors["quantity"] as $errorMessage) {
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
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">--- Choose category ---</option>
                                    <?php
                                        if(count($categoriesPossibleValues) > 0){
                                            foreach ($categoriesPossibleValues as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $key; ?>" <?php echo isset($formData["category_id"]) && $formData["category_id"] == $key ? " selected=\"\"" : "";?>><?php echo $value; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <?php 
                                    if (isset($formErrors["category_id"])) {
                                        foreach($formErrors["category_id"] as $errorMessage) {
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
                                <label>Sticker</label>
                                <select name="sticker_id" class="form-control">
                                    <option value="">--- Without sticker ---</option>
                                    <?php
                                        if(count($stickersPossibleValues) > 0){
                                            foreach ($stickersPossibleValues as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $key; ?>" <?php echo isset($formData["sticker_id"]) && $formData["sticker_id"] == $key ? " selected=\"\"" : "";?>><?php echo $value; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <?php 
                                    if (isset($formErrors["sticker_id"])) {
                                        foreach($formErrors["sticker_id"] as $errorMessage) {
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
                                <label>Show on homepage</label><br/>
                                <?php
                                    foreach ($homepagePossibleValues as $key => $value) {
                                        ?>
                                            <label class="radio-inline"><input type="radio" name="homepage" value="<?php echo $key; ?>"<?php echo isset($formData["homepage"]) && $formData["homepage"] == $key ? " checked=\"\"" : "";?>> <?php echo $value; ?> <span></span></label>
                                        <?php
                                    }
                                ?>
                                <?php 
                                    if (isset($formErrors["homepage"])) {
                                        foreach($formErrors["homepage"] as $errorMessage) {
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