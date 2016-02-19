<?php
/**
 * Created by PhpStorm.
 * User: Luis Lamadrid
 * Date: 02/16/16
 * Time: 8:25 AM
 */

switch ($_POST["action"]) {
case "Register":
    register();
    break;
case "Login":
    login();
    break;
case "Log Out":
    logout();
    break;
default:
    // ajax function
    if ($_GET["username"]) {
        checkUsername();
        break;
    }
    break;
}

function display_error($conn){
    header("HTTP/1.1 500 Error: (".$conn->errno.") ".$conn->error);
    die(json_encode('Unable to connect to database [' . $conn->connect_error . ']'));
}

function connect_to_db(){
    ini_set('display_errors', 1);
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'TwitterCopy');
    if ($conn->connect_errno > 0) {
        display_error($conn);
    }
    return $conn;
}

function register() {
    $conn = connect_to_db();
    $email = $conn->real_escape_string($_POST["email"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];
    $sql = 'SELECT password_hash FROM `user` WHERE email = \''.$email.'\'';
    $rs = $conn->query($sql);
    if ($rs->num_rows != 0) {
        header("HTTP/1.1 404 - Not Found");
        exit;
    }
    // A higher "cost" is more secure but consumes more processing power
    $cost = 10;
    // Create a random salt
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    // Prefix information about the hash so PHP knows how to verify it later.
    // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
    $salt = sprintf("$2a$%02d$", $cost) . $salt;
    // Hash the password with the salt and save to database
    $hash = crypt($password, $salt);
    $sql = "INSERT INTO user (username, email, password_hash) values ('".$username."','".$email."','".$hash."')";
    echo $hash;
    echo "\n";
    if (!$conn->query($sql)) {
        echo "Error: (".$conn->errno.") ".$conn->error;
    }

    echo json_encode("200");
}

?>