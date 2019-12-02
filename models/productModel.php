<?php

$homepagePossibleValues = array("1" => "Yes", "0" => "No");


function createProduct($data, $connection)
{
    $status = FALSE;

    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
        // Make query string
        $sqlQueryString = "
            INSERT INTO products (title, description, image, price, category_id, sticker_id, homepage, quantity, discount, date_created) 
            VALUES(:title, :description, :image, :price, :category_id, :sticker_id, :homepage, :quantity, :discount, :date_created)
            ";


        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'sticker_id' => $data['sticker_id'],
            'homepage' => $data['homepage'],
            'quantity' => $data['quantity'],
            'discount' => $data['discount'],
            'date_created' => date('Y-m-d H:i:s'), // 2018-12-28 13:59:00
        ];

        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $status;
}

function getAllProducts($connection, $filters)
{
    $rows = [];

    try {


        // Make query string
        $sqlQueryString = "
            SELECT products.id, products.title as title, products.price, products.discount, products.quantity, categories.name as category_id, stickers.title as sticker_id  
            FROM products
            LEFT JOIN categories ON categories.id = products.category_id
            LEFT JOIN stickers ON stickers.id = products.sticker_id
            ";

        if (count($filters) > 0) {
            $sqlQueryString .= "ORDER BY " . $filters['order-by'] . " " . $filters['order-direction'];
        }


        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        //    $params = [
        //        'naslov' => "%" . $naslov . "%",
        //        'cena' => $cena
        //    ];


        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $rows = $statement->fetchAll();
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $rows;
}

/**
 * This function return one row from product table
 * 
 * @param PDO $connection
 * @param int $id
 * @return mixed
 */
function getOneProduct($connection, $id)
{

    $row = FALSE;

    try {
        // Make query string
        $sqlQueryString = "SELECT * FROM products WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'id' => $id
        ];


        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
        //$status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $row = $statement->fetch();
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $row;
}

function editProduct($connection, $id, $data)
{
    try {
        // Make query string
        $sqlQueryString = "UPDATE products 
            SET 
            title = :title,
            description = :description, 
            image = :image, 
            price = :price, 
            category_id = :category_id, 
            sticker_id = :sticker_id, 
            homepage = :homepage, 
            quantity = :quantity, 
            discount = :discount
            WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'sticker_id' => $data['sticker_id'],
            'homepage' => $data['homepage'],
            'quantity' => $data['quantity'],
            'discount' => $data['discount'],
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        return $status = $statement->execute($params);
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
}


function deleteProduct($connection, $id)
{
    $status = FALSE;

    try {
        // Make query string
        $sqlQueryString = "DELETE FROM products WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $status;
}

function getAllProductsForHomepage($connection)
{
    $rows = [];

    try {


        // Make query string
        $sqlQueryString = "
            SELECT products.id, products.title as title, products.price, products.discount, products.quantity, products.image as image, stickers.image as sticker  
            FROM products
            LEFT JOIN categories ON categories.id = products.category_id
            LEFT JOIN stickers ON stickers.id = products.sticker_id
            WHERE products.homepage = 1
            ";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        //    $params = [
        //        'naslov' => "%" . $naslov . "%",
        //        'cena' => $cena
        //    ];


        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $rows = $statement->fetchAll();
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $rows;
}

function priceWithdiscount($product)
{
    return $product['price'] * (100 - $product['discount']) / 100;
}

function insertIntoViewedProduct($id)
{
    $viewedProducts = "";

    //provera da li vec imamo pregledane proizvode
    if (isset($_COOKIE) && isset($_COOKIE['viewedProducts'])) {
        $viewedProducts = $_COOKIE['viewedProducts'];

        $viewedProducts = explode(',', $viewedProducts); // pravimo od stringa niz 

        //ubaci u niz ako ga vec nemamo
        //tj. ako ranije nije pregledano
        if (!in_array($id, $viewedProducts)) {
            $viewedProducts[] = $id;
        }

        $viewedProducts = implode(',', $viewedProducts); // pravimo od niza string jer se u funkcije setcookie kao drugi parametar ocekuje string

    } else {
        // prvi put punimo cookie
        $viewedProducts = $id;
    }

    setcookie('viewedProducts', $viewedProducts, time() + 10 * 24 * 60 * 60, '/'); // setujemo da cookie traju 10 dana

}

function getViewedProducts($connection, $id)
{
    $rows = [];

    try {


        // Make query string
        $sqlQueryString = "
            SELECT title, image
            FROM products
            WHERE id IN(" . $id . ")";


        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $rows = $statement->fetchAll();
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $rows;
}

function countProductsByCategory($connection, $categoryId)
{
    $rows = [];

    try {


        // Make query string
        $sqlQueryString = "
            SELECT COUNT(products.id) AS number_of_categories
            FROM `products`
            RIGHT JOIN categories ON categories.id = products.category_id
            WHERE products.id IS NOT NULL AND products.category_id =" . $categoryId;


        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        //    $params = [
        //        'naslov' => "%" . $naslov . "%",
        //        'cena' => $cena
        //    ];


        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $rows = $statement->fetch();
            $row = $rows['number_of_categories'];
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $row;
}

function getProductsByCategory($connection, $categoryId)
{
    $rows = [];

    try {


        // Make query string
        $sqlQueryString = "
        SELECT products.id, products.title as title, products.price, products.discount, products.quantity, products.image as image, stickers.image as sticker  
        FROM products
        RIGHT JOIN categories ON categories.id = products.category_id
        LEFT JOIN stickers ON stickers.id = products.sticker_id
        WHERE products.id IS NOT NULL AND products.category_id = " . $categoryId;


        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $rows = $statement->fetchAll();
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $rows;
}
