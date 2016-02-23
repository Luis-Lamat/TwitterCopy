<?php 
/**
 * Created by PhpStorm.
 * User: Luis Lamadrid
 * Date: 02/22/16
 * Time: 7:00 PM
 */

include 'errors.php';


function connect_to_db(){
    ini_set('display_errors', 1);
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'TwitterCopy');
    if ($conn->connect_errno > 0) {
        DB_error($conn);
    }
    return $conn;
}


?>