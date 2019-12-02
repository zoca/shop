<?php

$stickersPossibleValues = getStickers($connection);        
        
        
/**
 * This is function returns all stickers
 * @return array
 */
function getStickers($connection){
    $stickers = [];
    
    
    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
       
        // Make query string
        $sqlQueryString = "SELECT * FROM stickers ORDER BY title";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

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
                    $stickers[$value['id']] = $value['title'];
                }
            }

        }


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
    
    
    return $stickers;
}



function createSticker($data, $connection){
    $status = FALSE;
    
    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
        // Make query string
        $sqlQueryString = "
            INSERT INTO stickers (title, color, image) 
            VALUES(:title, :color, :image)
            ";
        

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'title' => $data['title'],
            'color' => $data['color'],
            'image' => $data['image']
        ];

        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
        
    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
    
    return $status;
}

function getAllStickers($connection, $filters){
    $rows = [];
    
    try {        
        // Make query string
        $sqlQueryString = "
            SELECT *
            FROM stickers
            ";
        
        if(count($filters) > 0){
            $sqlQueryString .= "ORDER BY " . $filters['order-by'] . " " . $filters['order-direction'];
        }
        

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);


        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if($status){
            $rows = $statement->fetchAll();
        }


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
    
    return $rows;
}


function getOneSticker($connection, $id){
    
    $row = FALSE;
    
    try {
        // Make query string
        $sqlQueryString = "SELECT * FROM stickers WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'id' => $id
        ];


        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
        //$status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if($status){
            $row = $statement->fetch();
        }

    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
    
    return $row;
}


function deleteSticker($connection, $id){
    $status = FALSE;
    
    try {
        // Make query string
        $sqlQueryString = "DELETE FROM stickers WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        $status = $statement->execute($params);

    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
    
    return $status;
    
}


function editSticker($connection, $id, $data){
    try {
        // Make query string
        $sqlQueryString = "UPDATE stickers 
            SET 
            title = :title,
            color = :color, 
            image = :image
            WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'title' => $data['title'],
            'color' => $data['color'],
            'image' => $data['image'],
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        return $status = $statement->execute($params);


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
}