<?php

    include_once '../../models/connection.php';
    include_once '../../models/userModel.php';
    $status = loginStatus();
    
    $systemMessage = "";
    // if user is alredy logged in set message and hide form
    if($status){
        $systemMessage = "You are already logged in as " . $_SESSION['loginUser'];
    }
    

    //ovde se smestaju greske koje imaju polja u formi
    $formErrors = array();

    //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
    $formData = $_POST; // $_GET ili $_POST

    //uvek se prosledjuje jedno polje koje je indikator da su podaci poslati sa forme
    //odnosno da je korisnik pokrenuo neku akciju
    //kod nas to polje ce biti SUBMIT dugme
    if (!$status && isset($formData["submit"]) && $formData["submit"] == "Login") {

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
        } else {
            // if required
            $formErrors["email"][] = "Field email must be in request";
        }
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

        //Ukoliko nema gresaka 
        if (empty($formErrors)) {
            //Uradi akciju koju je korisnik trazio
            $status = loginCheck($connection, $formData);
            
            if($status){
                $systemMessage = "You are loggen in as " . $_SESSION['loginUser'];
            } else{
                $systemMessage = "You don't have privilegies with this credentials!!!";
            }
            
        }
    }

    include_once '../../views/headView.php';
    include_once '../../views/headerView.php';
    include_once '../../views/navigationView.php';
    include_once '../../views/loginView.php';
    include_once '../../views/footerView.php';
?>
        
        
        
        