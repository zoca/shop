<?php

$categoriesPossibleValues = getCategories($connection);

$navCategories = getNavCategories($connection);
/**
 * This is function for all categories
 * @return array
 */
function getCategories($connection)
{
    $categories = [];


    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {

        // Make query string
        $sqlQueryString = "SELECT * FROM categories ORDER BY name";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        // Execute return TRUE or FALSE
        //$status = $statement->execute($params);
        $status = $statement->execute();

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $rows = $statement->fetchAll();

            $numberOfRows = count($rows);
            //$numberOfRows = $statement->rowCount();
            if ($numberOfRows > 0) {
                foreach ($rows as $value) {
                    $categories[$value['id']] = $value['name'];
                }
            }
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }


    return $categories;
}

function getAllCategories($connection, $filters)
{
    $rows = [];

    try {
        // Make query string
        $sqlQueryString = "
            SELECT *
            FROM categories
            ";

        if (count($filters) > 0) {
            $sqlQueryString .= "ORDER BY " . $filters['order-by'] . " " . $filters['order-direction'];
        }


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

function createCategory($connection, $data)
{
    $status = FALSE;

    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {
        // Make query string
        $sqlQueryString = "
            INSERT INTO categories (name) 
            VALUES(:name)
            ";


        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'name' => $data['name']
        ];

        // Execute return TRUE or FALSE
        $status = $statement->execute($params);
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }

    return $status;
}

function doesCategoryExist($connection, $name, $id = NULL)
{


    // check connection, prepare query and execute it and stop script if something was wrong
    // when something was wrong catch error (exception) and show it
    try {

        // Make query string
        $sqlQueryString = "
                SELECT *
                FROM categories 
                WHERE name LIKE :name
                ";

        if (!is_null($id)) {
            $sqlQueryString .= " AND id != :id";
        }

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'name' => $name
        ];

        if (!is_null($id)) {
            $params['id'] = $id;
        }


        // Execute return TRUE or FALSE
        $status = $statement->execute($params);

        // get ROWS (ROW SET) (fetchAll - for row set or fetch - for one row)
        if ($status) {
            $row = $statement->fetch();

            if ($row) {
                $status = TRUE;
            } else {
                $status = FALSE;
            }
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getTrace() . "<br>";
    }

    return $status;
}

function getOneCategory($connection, $id)
{

    $row = FALSE;

    try {
        // Make query string
        $sqlQueryString = "SELECT * FROM categories WHERE id = :id";

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

function editCategory($connection, $id, $data)
{
    try {
        // Make query string
        $sqlQueryString = "
                UPDATE categories 
                SET 
                name = :name
                WHERE id = :id
            ";

        // Execute query (with params or without)
        $statement = $connection->prepare($sqlQueryString);

        $params = [
            'name' => $data['name'],
            'id' => $id
        ];

        // Execute return TRUE or FALSE
        return $status = $statement->execute($params);
    } catch (PDOException $exception) {
        echo "Something went wrong: " . $exception->getMessage() . "<br>";
    }
}


function deleteCategory($connection, $id)
{
    $status = FALSE;

    try {
        // Make query string
        $sqlQueryString = "DELETE FROM categories WHERE id = :id";

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

function getNavCategories($connection)
{
    $rows = [];

    try {
        // Make query string
        $sqlQueryString = "
            SELECT name, id
            FROM categories
            ORDER BY name
            ";


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
