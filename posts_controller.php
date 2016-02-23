<?php 
/**
 * Created by PhpStorm.
 * User: Luis Lamadrid
 * Date: 02/22/16
 * Time: 6:48 PM
 */

include 'db_connection.php';

switch ($_POST["action"]) {
case "create":
    create_post();
    break;
default:
    break;
}

function create_post (){
  date_default_timezone_set('America/Mexico_City');
  $author = $_POST["author"];
  $content = $_POST["content"];
  $created_at = date('Y-m-d h:i:s', time());

  $conn = connect_to_db();

}


?>