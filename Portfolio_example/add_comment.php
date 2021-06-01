<?php
session_start();
if ( (!isset($_POST['new_comment'])) || !isset($_POST['project_id']) )
{
    header('Location: authentification.php');
}
require_once ("connect.php");
$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno!=0) {

    echo "Error: ".$connection->connect_errno;
    
}
else {

    $comment_text = $_POST['new_comment'];
    $project_id = $_POST['project_id'];
    $name = $_SESSION['user_name'];
    $surname = $_SESSION['user_surname'];

    if (!empty($connection))
    {
        $sql_query = "insert into comments (project_id, comment_text, commenter_name, commenter_surname) values ('$project_id', '$comment_text', '$name', '$surname')";

        if ($result = @$connection->query($sql_query) )
        {
            header('Location: My_projects.php');
        }
    }

    $connection->close();
    header('Location: My_projects.php');
}


?>