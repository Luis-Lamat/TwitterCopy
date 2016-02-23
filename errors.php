<?php 
/**
 * Created by PhpStorm.
 * User: Luis Lamadrid
 * Date: 02/22/16
 * Time: 7:00 PM
 */

function DB_error ($conn){
    header("HTTP/1.1 500 Error: (".$conn->errno.") ".$conn->error);
    die(json_encode('Unable to connect to database [' . $conn->connect_error . ']'));
}

function error ($code, $msg){
    header('HTTP/1.1 ' . strval($code). " " . $msg);
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERROR ' . $msg, 'code' => $code)));
}

?>