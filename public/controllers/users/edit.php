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
        }
    }else {
        $systemMessage = "Not valid ID in request!!!";
    }
    
    if($status){
        // ovde smo pronasli proizvod i mozemo da ga menjamo
        //ovde su default vrednosti za polja u formi
        $defaultFormData = array(
            'name' => $openedRow['name'],
            'email' => $openedRow['email'],
            'active' => $openedRow['active']
        );

        //ovde se smestaju greske koje imaju polja u formi
        $formErrors = array();

        //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
        $formData = $_POST; // $_GET ili $_POST

        //uvek se prosledjuje jedno polje koje je indikator da su podaci poslati sa forme
        //odnosno da je korisnik pokrenuo neku akciju
        //kod nas to polje ce biti SUBMIT dugme
        if (isset($formData["submit"]) && $formData["submit"] == "Edit") {

            /*********** filtriranje i validacija polja NAME ****************/
            if (isset($formData["name"])) {
                //Filtering 1
                $formData["name"] = trim($formData["name"]);
                $formData["name"] = strip_tags($formData["name"]);

                //Validation - if required
                if ($formData["name"] === "") {
                    $formErrors["name"][] = "Field name is required";
                }

            } else {
                //if required
                $formErrors["name"][] = "Field name is required in request";
            }

            /*********** filtriranje i validacija polja EMAIL ****************/
            if (isset($formData["email"])) {
                // Filtering 1
                $formData["email"] = trim($formData["email"]);
                // Filtering 2
                $formData["email"] = strip_tags($formData["email"]);
                // Filtering 3
                // Filtering 4
                // ...
                // Validation - if required
                if ($formData["email"] === "") {
                    $formErrors["email"][] = "Field email is required";
                }

                // Validation 2
                if(!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)){
                    $formErrors["email"][] = "Field email must be valid email address";
                }

                // Validation 3
                // da li vec postoji korisnik sa unetim emailom u bazi
                if(doesEmailExist($connection, $formData['email'], $userId)){
                    $formErrors["email"][] = "Email already exists in database, please choose another";
                }
            } else {
                // if required
                $formErrors["email"][] = "Field email must be in request";
            }

            /*********** filtriranje i validacija polja ACTIVE ****************/
            if (isset($formData["active"])) {
                //Filtering 1
                $formData["active"] = trim($formData["active"]);
                $formData["active"] = strip_tags($formData["active"]);

                //Validation - if required
                if ($formData["active"] === "") {
                    $formErrors["active"][] = "Please choose status";
                }

                if (!array_key_exists($formData["active"], $activeStatusPossibleValues)) {
                    $formErrors["active"][] = "Please choose valid value for active";
                }
            } else {
                //if required
                $formErrors["active"][] = "Homepage is required in request";
            }
            
            //Ukoliko nema gresaka 
            if (empty($formErrors)) {
                //Uradi akciju koju je korisnik trazio                
                $editStatus = editUser($connection, $userId, $formData);
                if($editStatus){
                    header('Location: /controllers/users/all.php');
                } else{
                    $systemMessage = "Something went wrong with edit this user!!!";
                }
            }
        }

        //spojiti default vrednosti i ono sto je korisnik poslao kroz formu ako je poslao
        $formData = array_merge($defaultFormData, $formData);

    }
    
    
    
    include_once '../../../views/headView.php';
    include_once '../../../views/headerView.php';
    include_once '../../../views/navigationView.php';
    include_once '../../../views/users/editView.php';
    include_once '../../../views/footerView.php';
