<?php

include_once __DIR__ . '/../models/connection.php';
include_once __DIR__ . '/../models/productModel.php';
include_once __DIR__ . '/../models/categoryModel.php';
include_once __DIR__ . '/../models/stickerModel.php';
include_once __DIR__ . '/../models/userModel.php';


$allProductsForHomePage = getAllProductsForHomepage($connection);


include_once '../views/headView.php';
include_once '../views/headerView.php';
include_once '../views/navigationView.php';
include_once '../views/indexView.php';
include_once '../views/footerView.php';