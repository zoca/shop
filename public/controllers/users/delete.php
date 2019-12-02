<?php

    $deleteStatus = FALSE;

    include_once '../../../models/connection.php';
    include_once '../../../models/userModel.php';
    include_once '../../../models/categoryModel.php';
    include_once '../../../models/stickerModel.php';
    include_once '../../../models/productModel.php';
    
    
    $systemMessage = "";
    // if user is alredy logged in set message and hide form
    if(!loginStatus()){
        header('Location: /controllers/login.php');
        die();
    }

    // validate ID from GET request
    $status = FALSE;
    if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
        // go to database and check product
        $productId = $_GET['id'];
        $openedRow = getOneUser($connection, $productId);
        if($openedRow){
            $status = TRUE;
        }else{
            $systemMessage = "User was not found!!!";
        }
    }else {
        $systemMessage = "Not valid ID in request!!!";
    }
    
    if($status){

        //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
        $formData = $_POST; // $_GET ili $_POST

        //uvek se prosledjuje jedno polje koje je indikator da su podaci poslati sa forme
        //odnosno da je korisnik pokrenuo neku akciju
        //kod nas to polje ce biti SUBMIT dugme
        if (isset($formData["submit"]) && $formData["submit"] == "Yes, delete") {
            //Uradi akciju koju je korisnik trazio
            $deleteStatus = deleteUser($connection, $productId);
            if($deleteStatus){
                $systemMessage = "User successfully deleted!!!";
            } else{
                $systemMessage = "Something went wrong with delete!!!";
            }

        }
        
        if (isset($formData["submit"]) && $formData["submit"] == "Cancel") {
            header('Location: /controllers/users/all.php');
        }
    }
    
    
    
    include_once '../../../views/headView.php';
    include_once '../../../views/headerView.php';
    include_once '../../../views/navigationView.php';
    include_once '../../../views/users/deleteView.php';
    include_once '../../../views/footerView.php';
