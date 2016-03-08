<?php 
/**
 * Created by PhpStorm.
 * User: Luis Lamadrid
 * Date: 02/22/16
 * Time: 6:48 PM
 */

include 'db_connection.php';

##
# POST ACTIONS
if (!empty($_POST)) {
  switch ($_POST["action"]) {
  case "create_post":
      create_post();
      exit;
  default:
      exit;
  }
}
##
# GET ACTIONS
if (!empty($_GET)) {
  switch ($_GET["action"]) {
  case "get_all_posts":
      get_all_posts();
      exit;
  default:
      exit;
  }
}

function get_all_posts (){
  $conn = connect_to_db();
  $sql = ' SELECT u.id, username, content, created_at FROM post AS p, user AS u 
           WHERE p.user_id = u.id ORDER BY p.id DESC;';
  $rs = $conn->query($sql);
  if ($rs->num_rows == 0) {
      error(404, 'No posts found');
  }
  $post_array = array();
  while($row = mysqli_fetch_assoc($rs)) {
     $post_array[] = $row;
  }
  echo json_encode($post_array);
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
    'id' => $_COOKIE["user_id"],
    'author' => $_COOKIE["username"], 
    'created_at' => $created_at
  ));
}


?>