<?php
  include "../config.php";
  include "../Classes/Database.php";

$id = $_GET['id'];
$db = new Database();
$query = "DELETE FROM tbl_user WHERE id=$id";
 $db->deleteData($query);
