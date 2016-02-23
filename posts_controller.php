<?php 
/**
 * Created by PhpStorm.
 * User: Luis Lamadrid
 * Date: 02/22/16
 * Time: 6:48 PM
 */

include 'db_connection.php';

switch ($_POST["action"]) {
case "create_post":
    create_post();
    break;
default:
    break;
}

function create_post (){
  $conn = connect_to_db();

  date_default_timezone_set('America/Mexico_City');
  $author = $_COOKIE["user_id"];
  $content = $conn->real_escape_string($_POST["content"]);
  $created_at = date('Y-m-d h:i:s', time());

  if ($author == '' || $content == '') {
    error(400, 'Invalid request: Empty required fields');
  }
  $sql = "INSERT INTO post (content, user_id, created_at) values ('".$content."','".$author."','".$created_at."')";
  if (!$conn->query($sql)) {
    DB_error($conn);
  }
  echo json_encode(array(
    'code' => '200', 
    'author' => $_COOKIE["username"], 
    'created_at' => $created_at
  ));
}


?>