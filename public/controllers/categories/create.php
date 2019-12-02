<?php

    $insertStatus = FALSE;

    include_once '../../../models/connection.php';
    include_once '../../../models/userModel.php';
    include_once '../../../models/categoryModel.php';
    include_once '../../../models/stickerModel.php';
    include_once '../../../models/productModel.php';
    
    
    $status = loginStatus();
    
    $systemMessage = "";
    // if user is alredy logged in set message and hide form
    if(!$status){
        header('Location: /controllers/login.php');
        die();
    }
    
    //ovde se smestaju greske koje imaju polja u formi
    $formErrors = array();

    //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
    $formData = $_POST; // $_GET ili $_POST

    //uvek se prosledjuje jedno polje koje je indikator da su podaci poslati sa forme
    //odnosno da je korisnik pokrenuo neku akciju
    //kod nas to polje ce biti SUBMIT dugme
    if (isset($formData["submit"]) && $formData["submit"] == "Save") {
        
        /*********** filtriranje i validacija polja NAME ****************/
        if (isset($formData["name"])) {
            //Filtering 1
            $formData["name"] = trim($formData["name"]);
            $formData["name"] = strip_tags($formData["name"]);
            
            //Validation - if required
            if ($formData["name"] === "") {
                $formErrors["name"][] = "Field name is required";
            }
            
            
            // Validation 2
            // da li vec postoji korisnik sa unetim emailom u bazi
            if(doesCategoryExist($connection, $formData['name'])){
                $formErrors["name"][] = "Category already exists in database, please choose another";
            }

	} else {
            //if required
            $formErrors["name"][] = "Field name is required in request";
	}
        
        
        //Ukoliko nema gresaka 
        if (empty($formErrors)) {
            //Uradi akciju koju je korisnik trazio
            $insertStatus = createCategory($connection, $formData);
            
            if($insertStatus){
                $systemMessage = "Category created sucessfully";
            } else {
                $systemMessage = "Something went wrong!!!";
            }
        }
        
    }
    
    include_once '../../../views/headView.php';
    include_once '../../../views/headerView.php';
    include_once '../../../views/navigationView.php';
    include_once '../../../views/categories/createView.php';
    include_once '../../../views/footerView.php';