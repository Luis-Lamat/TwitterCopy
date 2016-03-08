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
  case "update_user":
      // TODO: extra
      update_user();
      exit;
  default:
      exit;
  }
}
##
# GET ACTIONS
if (!empty($_GET)) {
  switch ($_GET["user_id"]) {
  case "get_all_users":
      // TODO: extra
      // get_all_users();
      exit;
  case "get_user":
      if (!empty($_GET["user_id"])) {
          get_user($_GET["user_id"]);
      } else {
          error(400, "User ID not specified");
      }
      exit;
  }
}

function get_user ($user_id){
  $conn = connect_to_db();
  $sql = ' SELECT id, username, email FROM user WHERE id = ' . $user_id . ';';
  $rs = $conn->query($sql);
  if ($rs->num_rows == 0) {
      error(404, 'User not found');
  }
  $row = mysqli_fetch_assoc($rs);
  echo json_encode($row);
}

function update_user (){
  
}


?>