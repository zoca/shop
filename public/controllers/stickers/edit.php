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
        $stickerId = $_GET['id'];
        $openedRow = getOneSticker($connection, $stickerId);
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
            'title' => $openedRow['title'],
            'color' => $openedRow['color'],
            'image' => $openedRow['image']
        );

        //ovde se smestaju greske koje imaju polja u formi
        $formErrors = array();

        //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
        $formData = $_POST; // $_GET ili $_POST

        //uvek se prosledjuje jedno polje koje je indikator da su podaci poslati sa forme
        //odnosno da je korisnik pokrenuo neku akciju
        //kod nas to polje ce biti SUBMIT dugme
        if (isset($formData["submit"]) && $formData["submit"] == "Edit") {

            /*********** filtriranje i validacija polja TITLE ****************/
            if (isset($formData["title"])) {
                //Filtering 1
                $formData["title"] = trim($formData["title"]);
                $formData["title"] = strip_tags($formData["title"]);

                //Validation - if required
                if ($formData["title"] === "") {
                    $formErrors["title"][] = "Field title is required";
                }

            } else {
                //if required
                $formErrors["title"][] = "Field title is required in request";
            }

            /*********** filtriranje i validacija polja DESCRIPTION ****************/
            if (isset($formData["color"])) {
                //Filtering 1
                $formData["color"] = trim($formData["color"]);
                $formData["color"] = strip_tags($formData["color"]);

                //Validation - if required
                if ($formData["color"] === "") {
                    //$formErrors["color"][] = "Field color is required";
                }

            } else {
                //if required
                $formErrors["color"][] = "Field color is required in request";
            }

            /*********** filtriranje i validacija polja IMAGE ****************/
            $isImageUploaded = FALSE;
            if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {

                if (empty($_FILES["image"]["error"])) {
                    //filtering
                    $imageFileTmpPath = $_FILES["image"]["tmp_name"];
                    $imageFileName = basename($_FILES["image"]["name"]);
                    $imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
                    $imageFileSize = $_FILES["image"]["size"];

                    //validation
                    $imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
                    $imageFileMaxSize = 10 * 1024 * 1024;// 1 MB

                    if (!in_array($imageFileMime, $imageFileAllowedMime)) {
                        $formErrors["image"][] = "Fajl image je u neispravnom formatu";
                    }

                    if ($imageFileSize > $imageFileMaxSize) {
                        $formErrors["image"][] = "Fajl image prelazi maksimalnu dozvoljenu velicinu";
                    }
                    
                    $isImageUploaded = TRUE;

                } else {
                    $formErrors["image"][] = "Doslo je do greske prilikom uploada fajla image";
                }
            } else {
                //if required
                //$formErrors["image"][] = "Polje image mora biti prosledjeno";
            }

            //Ukoliko nema gresaka 
            if (empty($formErrors)) {
                //Uradi akciju koju je korisnik trazio

                // radimo move slike samo ako je uploadovana
                $formData['image'] = $openedRow['image'];
                if($isImageUploaded){
                    // dohvatamo sliku iz tmp foldera i smestamo tamo gde nam treba
                    $uploadsDirectory =  __DIR__ . "/../../assets/upload/stickers";
                    $destinationPath = $uploadsDirectory . DIRECTORY_SEPARATOR . $imageFileName;
                    if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
                        $formErrors["image"][] = "Doslo je do greske prilikom snimanja fajla image";
                    } else {
                        //akcija
                        $formData['image'] = '/assets/upload/stickers/' . $imageFileName;
                    }
                }
                
                
                if (empty($formErrors)) {
                    $editStatus = editSticker($connection, $stickerId, $formData);
                    if($editStatus){
                        header('Location: /controllers/stickers/all.php');
                    } else{
                        $systemMessage = "Something went wrong with edit this product!!!";
                    }
                }

            }
        }

        //spojiti default vrednosti i ono sto je korisnik poslao kroz formu ako je poslao
        $formData = array_merge($defaultFormData, $formData);

    }
    
    
    
    include_once '../../../views/headView.php';
    include_once '../../../views/headerView.php';
    include_once '../../../views/navigationView.php';
    include_once '../../../views/stickers/editView.php';
    include_once '../../../views/footerView.php';
