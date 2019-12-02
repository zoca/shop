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
    
    // Make query string
    $sqlQueryString = "DELETE FROM categories WHERE id > :id";
    
    // Execute query (with params or without)
    $statement = $connection->prepare($sqlQueryString);
   
    $params = [
        'id' => 15
    ];
    
    // Execute return TRUE or FALSE
    $status = $statement->execute($params);
    
    // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
    if($status){        
        echo $statement->rowCount() . " row deleted<br>";
    }
    
    
    
}catch( PDOException $exception ) {
    echo "Something went wrong: " . $exception->getMessage() . "<br>";
}


echo "<br>Great. This is the end of the script";



