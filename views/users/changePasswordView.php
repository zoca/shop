<main>
    <div class="container">
        <section class="tipografy">
            <h1>Change password<?php if ($status) { echo " for user: " . $openedRow['name']; } ?></h1>
            <p class="text-danger"><?php echo $systemMessage; ?></p>
        </section>

        <?php
            if($status && !$editStatus){
                ?>
                    <section class="form-elements">
                        <form method="post" action="" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>New password</label>
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
                                <label>Confirm new password</label>
                                <input class="form-control" type="password" name="password_confirmation" value="">
                                <?php 
                                    if (isset($formErrors["password_confirmation"])) {
                                        foreach($formErrors["password_confirmation"] as $errorMessage) {
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
                            <input type="submit" name="submit" value="Change">

                        </form>
                    </section>
                <?php
            }
        ?>
    </div>
</main><!--main end-->