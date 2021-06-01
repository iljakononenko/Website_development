<?php
    session_start();

    if ( isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true)
    {
        header('Location: index.php');
    }

    if ( (!isset($_POST['login'])) || !isset($_POST['password']) )
    {
        header('Location: authentification.php');
    }

    // jesli trafilismy do tego pliku jak bylo zaplanowane przez dewelopera
    // podlaczamy sie do bazy i sprawdzamy podane dane

    require_once ("connect.php");

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno;
    }
    else
    {

        // jak polaczenie jest ok i dziala, pobieramy z post login i haslo i probujemy sie 
        // zalogowac

        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = test_input($login);
        $password = test_input($password);

        //echo "It works!";

        //echo "Your login is: $login and password: $password";

        // probujemy pobrac uzytkownika odpowiadajacego login i haslo pobrane przez formularz

        if ($result = @$connection->query(
            sprintf("Select * from users where login='%s'",
                    mysqli_real_escape_string($connection, $login)
                )
            )
        )
        {
            // dostajemy ilosc wierszy 
            $user_num = $result->num_rows; 
            

            // sprawdzamy czy dostalismy rekord z bazy danych (nie musi byc wiecej niz jeden
            // ale dalismy na wszelki wypadek )
            if ( $user_num > 0 )
            {
                // tablica asocyacyjna odpowiadajaca wierszu
                // ktory jest w bazie danych
                // $row['nazwa kolumny z bazy danych']

                $row = $result->fetch_assoc();

                if (password_verify($password, $row['password']))
                {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_surname'] = $row['surname'];
    
                    $result->free_result();
    
                    header('Location: index.php');
                }
                else 
                {
                    $_SESSION['registration_unsuccesful'] = false;
                    $_SESSION['wrong_login_password'] = true;
    
                    header('Location: authentification.php');
                }

            }
            else 
            {
                $_SESSION['registration_unsuccesful'] = false;
                $_SESSION['wrong_login_password'] = true;

                header('Location: authentification.php');
            }

        }

        $connection->close();
    }

?>
