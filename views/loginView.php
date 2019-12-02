<main>
    <div class="container">
        <section class="tipografy">
            <h1>Login</h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if(!$status){
                ?>
                    <section class="form-elements">
                        <form method="post" action="">

                            <!--ISKOPIRATI ZA INPUT EMAIL-->
                            <div class="form-group">
                                <label>EMAIL</label>
                                <input type="text" name="email" class="form-control" value="<?php echo isset($formData["email"]) ? htmlspecialchars($formData["email"]) : "";?>">
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



                            <!--ISKOPIRATI ZA INPUT PASSWORD-->
                            <div class="form-group">
                                <label>PASSWORD</label>
                                <input type="password" name="password" value="" class="form-control">
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

                            <!--ISKOPIRATI ZA INPUT TYPE SUBMIT-->
                            <input type="submit" name="submit" value="Login">

                        </form>
                    </section>
                <?php
            }
        ?>
    </div>
</main><!--main end-->