<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = htmlentities($data);  
    return $data;
  }

    $host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "users";

?>
