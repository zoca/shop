<?php

$activeStatusPossibleValues = [
    0 => 'Inactive',
    1 => 'Active'
];

/**
 * This function return user login status
 * @return boolean
 */
function loginStatus(){
    $status = FALSE;
    
    // session start
    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']){
        $status = TRUE;
    }
    
    return $status;
}

/**
 * This function check user in database
 * 
 * @param array $data This is data from form
 * @return boolean
 */
function loginCheck($connection, $data){
   

    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
        
        // Make query string
        $sqlQueryString = "
                SELECT *
                FROM users 
                WHERE email LIKE :email AND password LIKE :password AND active = :active
                ";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

            $params = [
                'email' => $data['email'],
                'password' => md5("programer-" . $data['password']),
                'active' => 1
            ];


        // Execute return TRUE or FALSE
        $status = $statement->execute($params);

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if($status){
            $user = $statement->fetch();

            //$numberOfRows = $statement->rowCount();
            if($user){
                $status = TRUE;
                $_SESSION['loginStatus'] = TRUE;
                $_SESSION['loginUser'] = $user['name'];
            } else{
                $status = FALSE;
            }

        }


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getTrace() . "<br>";
    }
    
    return $status;
}

function doesEmailExist($connection, $email, $id = NULL){
   

    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
        
        // Make query string
        $sqlQueryString = "
                SELECT *
                FROM users 
                WHERE email LIKE :email
                ";
        
        if(!is_null($id)){
            $sqlQueryString .= " AND id != :id";
        }

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

            $params = [
                'email' => $email
            ];
            
            if(!is_null($id)){
                $params['id'] = $id;
            }


        // Execute return TRUE or FALSE
        $status = $statement->execute($params);

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if($status){
            $user = $statement->fetch();

            if($user){
                $status = TRUE;
            } else{
                $status = FALSE;
            }

        }


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getTrace() . "<br>";
    }
    
    return $status;
}

function createUser($connection, $data){
    $status = FALSE;
    
    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
        // Make query string
        $sqlQueryString = "
            INSERT INTO users (name, email, password, active) 
            VALUES(:name, :email, :password, :active)
            ";
        

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => md5("programer-" . $data['password']),
            'active' => $data['active']
        ];

        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
        
    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
    
    return $status;
}

function getAllUsers($connection, $filters){
    $rows = [];
    
    try {        
        // Make query string
        $sqlQueryString = "
            SELECT *
            FROM users
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

/**
 * This function return one row from users table
 * 
 * @param PDO $connection
 * @param int $id
 * @return mixed
 */
function getOneUser($connection, $id){
    
    $row = FALSE;
    
    try {
        // Make query string
        $sqlQueryString = "SELECT * FROM users WHERE id = :id";

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

function editUser($connection, $id, $data){
    try {
        // Make query string
        $sqlQueryString = "UPDATE users 
            SET 
            name = :name,
            email = :email, 
            active = :active
            WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'active' => $data['active'],
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        return $status = $statement->execute($params);


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
}

function changePassword($connection, $id, $data){
    try {
        // Make query string
        $sqlQueryString = "UPDATE users 
            SET 
            password = :password
            WHERE id = :id";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'password' => md5("programer-" . $data['password']),
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        return $status = $statement->execute($params);


    }catch( PDOException $exception ) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
}

function deleteUser($connection, $id){
    $status = FALSE;
    
    try {
        // Make query string
        $sqlQueryString = "DELETE FROM users WHERE id = :id";

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