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

}catch( PDOException $exception ) {
    echo "Something went wrong: " . $exception->getTrace() . "<br>";
}
