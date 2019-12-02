<style>
    th a {
        color: white;
    }
</style>
<main>
    <div class="container">
        <section class="tipografy">
            <h1>All users</h1>
        </section>

        <section class="include-table">
            <div class="table-responsive">
                <?php
                    if(count($users) > 0 ){
                        ?>
                            <table class="table  table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>
                                            Name
                                            <a href="/controllers/users/all.php?order-by=name&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/users/all.php?order-by=name&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>
                                            Email
                                            <a href="/controllers/users/all.php?order-by=email&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/users/all.php?order-by=email&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>
                                            Active
                                            <a href="/controllers/users/all.php?order-by=active&order-direction=asc"><span class="fa fa-arrow-up"></span></a>
                                            <a href="/controllers/users/all.php?order-by=active&order-direction=desc"><span class="fa fa-arrow-down"></span></a>
                                        </th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        foreach ($users as $value) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $value['name'] ?></td>
                                                    <td><?php echo $value['email'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if($value['active'] == 1){
                                                                echo "Active";
                                                            }
                                                            if($value['active'] == 0){
                                                                echo "Inactive";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="/controllers/users/edit.php?id=<?php echo $value['id']; ?>">Edit</a>
                                                        <a href="/controllers/users/change-password.php?id=<?php echo $value['id']; ?>">Reset password</a>
                                                        <a href="/controllers/users/delete.php?id=<?php echo $value['id']; ?>">Delete</a>
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