<?php

    include_once '../../../models/connection.php';
    include_once '../../../models/userModel.php';
    //include_once '../../../models/categoryModel.php';
    //include_once '../../../models/stickerModel.php';
    include_once '../../../models/productModel.php';
    
    
    $status = loginStatus();
    
    $systemMessage = "";
    // if user is alredy logged in set message and hide form
    if(!$status){
        header('Location: /controllers/login.php');
        die();
    }
    
    $filters = [];
    
    // XSS
    if(isset($_GET['order-by']) && isset($_GET['order-direction'])){
        $orderPossibleValues = ['title', 'price', 'discount'];
        if(in_array($_GET['order-by'], $orderPossibleValues)){
            $filters['order-by'] = $_GET['order-by'];
            
            if($_GET['order-direction'] == 'asc' || $_GET['order-direction'] == 'desc'){
                $filters['order-direction'] = $_GET['order-direction'];
            } else{
                $filters['order-direction'] = 'asc';
            }
        }
    }
    
    
    
    $products = getAllProducts($connection, $filters);
    
    include_once '../../../views/headView.php';
    include_once '../../../views/headerView.php';
    include_once '../../../views/navigationView.php';
    include_once '../../../views/products/allView.php';
    include_once '../../../views/footerView.php';