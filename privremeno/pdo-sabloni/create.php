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
    $sqlQueryString = "INSERT INTO categories (name) VALUES(:name),(:name2)";
    
    // Execute query (with params or without)
    $statement = $connection->prepare($sqlQueryString);
   
    $params = [
        'name' => 'Kozmetika 4',
        'name2' => 'Kozmetika 5'
    ];
    
    // Execute return TRUE or FALSE
    $status = $statement->execute($params);
    
    // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
    if($status){        
        echo $statement->rowCount() . " row inserted<br>";
        echo "Inserted row id: " . $connection->lastInsertId();
    }
    
    
    
}catch( PDOException $exception ) {
    echo "Something went wrong: " . $exception->getMessage() . "<br>";
}


echo "<br>Great. This is the end of the script";



