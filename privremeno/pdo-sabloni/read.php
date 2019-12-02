<?php

/*** mysql hostname ***/
$hostname = "localhost";
/*** mysql username ***/
$username = "root";
/*** mysql password ***/
$password = "";
/*** mysql database name ***/
$database = "webkurs_shop";

// check connection, prepare query and execute it and stop script if something was wrong
// when something was wrong catch error (exception) and show it
try {
    $connection = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    // echo a message saying we have connected
    

    // Make query string
    $sqlQueryString = "SELECT * FROM categories";
    
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
    if($status){
        $rows = $statement->fetchAll();
        
        $numberOfRows = count($rows);
        //$numberOfRows = $statement->rowCount();
        if($numberOfRows > 0){
            foreach ($rows as $value) {
                echo "Category name: " . $value['name'] . "<br>";
                echo "<hr>";
            }
        }
        
    }
    
    // Get number (count) of rows in result
    
    
    // if count > 0  go in foreach loop
    // show one by one ROW
    
    
    // close connection with NULL
    
}catch( PDOException $exception ) {
    echo "Something went wrong: " . $exception->getMessage() . "<br>";
}


echo "<br>Great. This is the end of the script";



