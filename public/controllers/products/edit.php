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
        $productId = $_GET['id'];
        $openedRow = getOneProduct($connection, $productId);
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
            'description' => $openedRow['description'],
            'image' => $openedRow['image'],
            'price' => $openedRow['price'],
            'discount' => $openedRow['discount'],
            'category_id' => $openedRow['category_id'],
            'sticker_id' => $openedRow['sticker_id'],
            'homepage' => $openedRow['homepage'],
            'quantity' => $openedRow['quantity'],
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
            if (isset($formData["description"])) {
                //Filtering 1
                $formData["description"] = trim($formData["description"]);
                $formData["description"] = strip_tags($formData["description"], '<br><a><p><strong><em><div>');

                //Validation - if required
                if ($formData["description"] === "") {
                    //$formErrors["description"][] = "Field description is required";
                }

            } else {
                //if required
                $formErrors["description"][] = "Field description is required in request";
            }

            /*********** filtriranje i validacija polja IMAGE ****************/

            /*********** filtriranje i validacija polja PRICE ****************/
            if (isset($formData["price"])) {
                //Filtering 1
                $formData["price"] = trim($formData["price"]);
                $formData["price"] = strip_tags($formData["price"]);

                //Validation - if required
                if ($formData["price"] === "") {
                    $formErrors["price"][] = "Field price is required";
                } else {
                    $formData['price'] = floatval($formData['price']);

                    if(!is_numeric($formData['price'])){
                        $formErrors["price"][] = "Field price must be numeric";
                    }
                    $formData['price'] = number_format($formData['price'], 2, '.', '');
                }

            } else {
                //if required
                $formErrors["price"][] = "Field price is required in request";
            }

            /*********** filtriranje i validacija polja DISCOUNT ****************/
            if (isset($formData["discount"])) {
                //Filtering 1
                $formData["discount"] = trim($formData["discount"]);
                $formData["discount"] = strip_tags($formData["discount"]);

                //Validation - if required
                if ($formData["discount"] === "") {
                    $formErrors["discount"][] = "Field discount is required";
                } else {                
                    if(!is_numeric($formData['discount'])){
                        $formErrors["discount"][] = "Field discount must be numeric";
                    } else{
                        if($formData['discount'] < 0 || $formData['discount'] > 100){
                            $formErrors["discount"][] = "Field discount must be between 0 and 100";
                        }
                    }
                }

            } else {
                //if required
                $formErrors["discount"][] = "Field discount is required in request";
            }

            /*********** filtriranje i validacija polja QUANTITY ****************/
            if (isset($formData["quantity"])) {
                //Filtering 1
                $formData["quantity"] = trim($formData["quantity"]);
                $formData["quantity"] = strip_tags($formData["quantity"]);

                //Validation - if required
                if ($formData["quantity"] === "") {
                    $formErrors["quantity"][] = "Field quantity is required";
                } else {                
                    if(!is_numeric($formData['quantity'])){
                        $formErrors["quantity"][] = "Field quantity must be numeric";
                    } else{
                        if($formData['quantity'] < 0 ){
                            $formErrors["quantity"][] = "Field quantity must be greather or equal than 0";
                        }
                    }
                }

            } else {
                //if required
                $formErrors["quantity"][] = "Field quantity is required in request";
            }

            /*********** filtriranje i validacija polja CATEGORY_ID ****************/
            if (isset($formData["category_id"])) {
                //Filtering 1
                $formData["category_id"] = trim($formData["category_id"]);
                $formData["category_id"] = strip_tags($formData["category_id"]);


                //Validation - if required
                if ($formData["category_id"] === "") {
                    $formErrors["category_id"][] = "Category is required";
                }

                if (!array_key_exists($formData["category_id"], $categoriesPossibleValues)) {
                    $formErrors["category_id"][] = "Please choose valid category value from list";
                }

                //Validation 2
                //Validation 3
                //...
            } else {
                //if required
                $formErrors["category_id"][] = "Category is required in request";
            }

            /*********** filtriranje i validacija polja STICKER_ID ****************/
            if (isset($formData["sticker_id"])) {
                //Filtering 1
                $formData["sticker_id"] = trim($formData["sticker_id"]);
                $formData["sticker_id"] = strip_tags($formData["sticker_id"]);


                //Validation - if required
                if ($formData["sticker_id"] === "") {
                    //$formErrors["sticker_id"][] = "Sticker is required";
                } else {
                    if (!array_key_exists($formData["sticker_id"], $stickersPossibleValues)) {
                        $formErrors["sticker_id"][] = "Please choose valid sticker value from list";
                    }
                }


            } else {
                //if required
                $formErrors["sticker_id"][] = "Sticker is required in request";
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

            /*********** filtriranje i validacija polja HOMEPAGE ****************/
            if (isset($formData["homepage"])) {
                //Filtering 1
                $formData["homepage"] = trim($formData["homepage"]);
                $formData["homepage"] = strip_tags($formData["homepage"]);

                //Validation - if required
                if ($formData["homepage"] === "") {
                    $formErrors["homepage"][] = "Please choose homepage";
                }

                if (!array_key_exists($formData["homepage"], $homepagePossibleValues)) {
                    $formErrors["homepage"][] = "Please choose valid value for homepage";
                }
            } else {
                //if required
                $formErrors["homepage"][] = "Homepage is required in request";
            }



            //Ukoliko nema gresaka 
            if (empty($formErrors)) {
                //Uradi akciju koju je korisnik trazio

                $formData['image'] = $openedRow['image'];
                // radimo move slike samo ako je uploadovana
                if($isImageUploaded){
                    // dohvatamo sliku iz tmp foldera i smestamo tamo gde nam treba
                    $uploadsDirectory =  __DIR__ . "/../../assets/upload/products";
                    $destinationPath = $uploadsDirectory . DIRECTORY_SEPARATOR . $imageFileName;
                    if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
                        $formErrors["image"][] = "Doslo je do greske prilikom snimanja fajla image";
                    } else {
                        //akcija
                        $formData['image'] = '/assets/upload/products/' . $imageFileName;
                    }
                }
                
                
                if (empty($formErrors)) {
                    $editStatus = editProduct($connection, $productId, $formData);
                    if($editStatus){
                        header('Location: /controllers/products/all.php');
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
    include_once '../../../views/products/editView.php';
    include_once '../../../views/footerView.php';
