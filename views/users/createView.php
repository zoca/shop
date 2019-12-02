<main>
    <div class="container">
        <section class="tipografy">
            <h1>New user</h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if(!$insertStatus){
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
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" value="<?php echo isset($formData["email"]) ? htmlspecialchars($formData["email"]) : "";?>">
                                <?php 
                                    if (isset($formErrors["email"])) {
                                        foreach($formErrors["email"] as $errorMessage) {
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
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" value="">
                                <?php 
                                    if (isset($formErrors["password"])) {
                                        foreach($formErrors["password"] as $errorMessage) {
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
                                <label>Active status</label><br/>
                                <?php
                                    foreach ($activeStatusPossibleValues as $key => $value) {
                                        ?>
                                            <label class="radio-inline"><input type="radio" name="active" value="<?php echo $key; ?>"<?php echo isset($formData["active"]) && $formData["active"] == $key ? " checked=\"\"" : "";?>> <?php echo $value; ?> <span></span></label>
                                        <?php
                                    }
                                ?>
                                <?php 
                                    if (isset($formErrors["active"])) {
                                        foreach($formErrors["active"] as $errorMessage) {
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