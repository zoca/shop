<?php

include_once __DIR__ . '/../../../models/connection.php';
include_once __DIR__ . '/../../../models/productModel.php';
include_once __DIR__ . '/../../../models/categoryModel.php';
include_once __DIR__ . '/../../../models/stickerModel.php';
include_once __DIR__ . '/../../../models/userModel.php';

//XSS
$status = FALSE;
$systemMessage = "";

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    // go to database and check products
    $categoryID = $_GET['id'];

    $categoryName = getOneCategory($connection, $categoryID);
    if($categoryName){
        $status = TRUE;
    }else{
        header('HTTP/1.1 404 Not Found');
        $systemMessage = "Category was not found!!!";
    }
   

} else {
    $systemMessage = "Not valid ID in request!!!";
}

if($status){
    $productsByCategory = getProductsByCategory($connection, $categoryID);
}


include_once '../../../views/headView.php';
include_once '../../../views/headerView.php';
include_once '../../../views/navigationView.php';
include_once '../../../views/frontend/categoryView.php';
include_once '../../../views/footerView.php';