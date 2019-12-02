<?php

    $editStatus = FALSE;

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
        $userId = $_GET['id'];
        $openedRow = getOneUser($connection, $userId);
        if($openedRow){
            $status = TRUE;
        } else {
            $systemMessage = "User was not found!!!";
        }
    }else {
        $systemMessage = "Not valid ID in request!!!";
    }
    
    if($status){
        //ovde se smestaju greske koje imaju polja u formi
        $formErrors = array();

        //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
        $formData = $_POST; // $_GET ili $_POST

        //uvek se prosledjuje jedno polje koje je indikator da su podaci poslati sa forme
        //odnosno da je korisnik pokrenuo neku akciju
        //kod nas to polje ce biti SUBMIT dugme
        if (isset($formData["submit"]) && $formData["submit"] == "Change") {

            /*********** filtriranje i validacija polja PASSWORD ****************/
            if (isset($formData["password"])) {
                // Filtering 1
                $formData["password"] = trim($formData["password"]);
                // Filtering 2
                $formData["password"] = strip_tags($formData["password"]);

                // Validation - if required
                if ($formData["password"] === "") {
                    $formErrors["password"][] = "Field password is required";
                }
            } else {
                // if required
                $formErrors["password"][] = "Field password must be in request";
            }
            
            /*********** filtriranje i validacija polja CONFIRM PASSWORD ****************/
            if (isset($formData["password_confirmation"])) {
                // Filtering 1
                $formData["password_confirmation"] = trim($formData["password_confirmation"]);
                // Filtering 2
                $formData["password_confirmation"] = strip_tags($formData["password_confirmation"]);

                // Validation - if required
                if ($formData["password_confirmation"] === "") {
                    $formErrors["password_confirmation"][] = "Field password_confirmation is required";
                }
                
                if($formData["password_confirmation"] != $formData["password"]){
                    $formErrors["password_confirmation"][] = "Password does not match!!!";
                }
            } else {
                // if required
                $formErrors["password_confirmation"][] = "Field password_confirmation must be in request";
            }
            
            //Ukoliko nema gresaka 
            if (empty($formErrors)) {
                //Uradi akciju koju je korisnik trazio                
                $editStatus = changePassword($connection, $userId, $formData);
                if($editStatus){
                    $systemMessage = "Password changed successfully!!!";
                } else{
                    $systemMessage = "Something went wrong with edit this user!!!";
                }
            }
        }
    }
    
    
    
    include_once '../../../views/headView.php';
    include_once '../../../views/headerView.php';
    include_once '../../../views/navigationView.php';
    include_once '../../../views/users/changePasswordView.php';
    include_once '../../../views/footerView.php';
