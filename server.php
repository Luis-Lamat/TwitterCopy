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

function DB_error ($conn){
    header("HTTP/1.1 500 Error: (".$conn->errno.") ".$conn->error);
    die(json_encode('Unable to connect to database [' . $conn->connect_error . ']'));
}

function error ($code, $msg){
    header('HTTP/1.1 ' . strval($code). " " . $msg);
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERROR ' . $msg, 'code' => $code)));
}

function connect_to_db(){
    ini_set('display_errors', 1);
    session_start();
    $conn = new mysqli('localhost', 'root', 'root', 'TwitterCopy');
    if ($conn->connect_errno > 0) {
        DB_error($conn);
    }
    return $conn;
}

function register() {
    $conn = connect_to_db();
    $email = $conn->real_escape_string($_POST["email"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];

    $sql = 'SELECT password_hash FROM `user` WHERE email = \''.$email.'\' OR username = \''.$username.'\'';
    $rs = $conn->query($sql);
    if ($rs->num_rows != 0) {
        error(404, 'Email already exists');
    }

    $cost = 10;
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    $salt = sprintf("$2a$%02d$", $cost) . $salt;
    $hash = crypt($password, $salt);

    $sql = "INSERT INTO user (username, email, password_hash) values ('".$username."','".$email."','".$hash."')";
    if (!$conn->query($sql)) {
        echo "Error: (".$conn->errno.") ".$conn->error;
        die(json_encode(array('message' => 'DB ERROR', 'code' => 500)));
    }
    echo json_encode("200");
}

function login() {
    $conn = connect_to_db();
    $email = $conn->real_escape_string($_POST["email"]);
    $passwordEntered = $_POST["password"];
    $sql = 'SELECT password_hash, username FROM `user` WHERE email = \''.$email.'\' LIMIT 1';
    $rs = $conn->query($sql);
    if ($rs->num_rows == 0) {
        error(404, 'Invalid email');
    }
    if ($row = mysqli_fetch_array($rs)) {
        $DBHash = $row["password_hash"];
        // Hashing the password with its hash as the salt returns the same hash, verifying the password was correct
        if ( hash_equals(crypt($passwordEntered, $DBHash), $DBHash) ) {
            // verified, set cookies for logged in
            setcookie("loggedIn", true, time()+3600);
            setcookie("email", $email, time()+3600);
            setcookie("username", $row["username"], time()+3600);
            header('Content-Type: application/json');
            echo json_encode(200);
        } else {
            error(404, 'Invalid password');
        }
        exit;
    }
}

function logout() {
    // delete cookies to log out, redirect to login page
    setcookie("loggedIn", false, time()-1);
    setcookie("email", false, time()-1);
    setcookie("username", false, time()-1);
    header("location: html/login.php");
    exit;
}


?>