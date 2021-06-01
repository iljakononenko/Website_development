<?php

  function validate_pass($password){
    $conditions = array(
        '/[a-z]+/',     // co najmniej jedna mala litera 
         '/[A-Z]+/',     // co najmniej jedna  duza litera
        '/[0-9]+/',     // co najmniej jedna cyfra
        '/\S/',				//nie ma białych znaków
        '/.{4,20}/'  // zawiera od 4 do 20 znaków
    );
       
    foreach($conditions as $value){
      if( !preg_match( $value, $password ) ){
        return false;
      }
    }
    return true;
  }


    session_start();

    if ( isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true)
    {
        header('Location: index.php');

        exit();
    }

    if ( (!isset($_POST['name'])) || (!isset($_POST['surname'])) || (!isset($_POST['login'])) || !isset($_POST['password']) )
    {
        header('Location: authentification.php');

        exit();
    }

    // jesli trafilismy do tego pliku jak bylo zaplanowane przez dewelopera
    // podlaczamy sie do bazy i insertujemy podane dane

    require_once ("connect.php");

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $name = test_input($name);
    $surname = test_input($surname);
    $login = test_input($login);
    $password = test_input($password);

    if (empty($name) || empty($surname) || empty($login) || empty($password)) {
        $_SESSION['log_error'] = "All fields should not be empty!";
        $_SESSION['registration_unsuccesful'] = true;

        header('Location: authentification.php');

        exit();
    }

    if (!ctype_alnum($name) || !ctype_alnum($surname) || !ctype_alnum($login) || !ctype_alnum($password) )
    {
        $_SESSION['log_error'] = "Fields should have only latters and numbers!";
        $_SESSION['registration_unsuccesful'] = true;

        header('Location: authentification.php');

        exit();
    }


    if (!validate_pass($password))
    {
        $_SESSION['log_error'] = "Password should contain 4-20 symbols, at least 1 capital latter, 1 small latter and 1 number";
        $_SESSION['registration_unsuccesful'] = true;

        header('Location: authentification.php');

        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno;
    }
    else
    {

        $check_if_exists = $connection->query("Select * from users where login='$login'");

        if ($check_if_exists)
        {

            $same_login_accounts = $check_if_exists->num_rows;
            if ($same_login_accounts > 0)
            {
                $_SESSION['log_error'] = "Login reserved";
                $_SESSION['registration_unsuccesful'] = true;
    
                header('Location: authentification.php');
    
                exit();
            }

        }

        // jak polaczenie jest ok i dziala, pobieramy z post login i haslo i probujemy sie 
        // zarejestrowac

        // probujemy pobrac uzytkownika odpowiadajacego login i haslo pobrane przez formularz

        if ($result = @$connection->query(
            sprintf("insert into users (name, surname, login, password) values ('%s', '%s', '%s', '%s')",
                    mysqli_real_escape_string($connection, $name),
                    mysqli_real_escape_string($connection, $surname),
                    mysqli_real_escape_string($connection, $login),
                    mysqli_real_escape_string($connection, $hashed_password),
                )
            )
        )
        {
            

           $_SESSION['logged_in'] = true;
           $_SESSION['user_name'] = $name;
           $_SESSION['user_surname'] = $surname;

           $_SESSION['registration_unsuccesful'] = false;

           header('Location: index.php');

        }

        $connection->close();
    }

?>
