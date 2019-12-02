<?php

include_once __DIR__ . '/../../../models/connection.php';
include_once __DIR__ . '/../../../models/productModel.php';
include_once __DIR__ . '/../../../models/categoryModel.php';
include_once __DIR__ . '/../../../models/stickerModel.php';
include_once __DIR__ . '/../../../models/userModel.php';

//XSS
// validate ID from GET request
$systemMessage = '';
$status = FALSE;
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    // go to database and check product
    $productId = $_GET['id'];
    $openedRow = getOneProduct($connection, $productId);
    if ($openedRow) {
        $status = TRUE;
        //ubaci proizvod u listu pregledanih proizvoda
        //resiti pomocu kolacica
        insertIntoViewedProduct($productId);
    }else{
        header('HTTP/1.1 404 Not Found');
        $systemMessage = "Product was not found!!!";
    }
} else {
    $systemMessage = "Not valid ID in request!!!";
}

include_once '../../../views/headView.php';
include_once '../../../views/headerView.php';
include_once '../../../views/navigationView.php';
include_once '../../../views/frontend/productView.php';
include_once '../../../views/footerView.php';
