<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
{
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Log in / Sign up</title>
    <link
      href="stylesheets/styles.css"
      media="screen, projection"
      rel="stylesheet"
      type="text/css"
    />
  </head>
  <body>
    <?php
include('header.html');
?>
    <main id="authentification_main">
      <div class="authentification_decision">
        <button onclick="set_signup()">Sign up</button>
        <button onclick="set_login()">Log in</button>
      </div>
      <div class="signup invisible">
        <form action="register.php" method="post" enctype="multipart/form-data">
          <ul>
            <li>
              <p><span class="error">* required fields</span></p>
            </li>
            <li>
              <p>Name: <span class="error">*</span></p>
              <input type="text" name="name" maxlength="20" size="10" />
            </li>
            <li>
              <p>Surname: <span class="error">*</span></p>
              <input type="text" name="surname" maxlength="20" size="10" />
            </li>
            <li>
              <p>Login: <span class="error">*</span></p>
              <input type="text" name="login" maxlength="20" size="10" />
            </li>
            <li>
              <p> Password: <span class="error">*</span></p>
              <input type="password" name="password" maxlength="20" size="10" />
              
            </li>
            <?php
            if(isset($_SESSION['log_error']) && $_SESSION['log_error'] != "" )
            {
              echo '<li><p class="error">'.$_SESSION['log_error'].'</p></li>';
              $_SESSION['log_error'] = "";
            }
            ?>
            <li>
              <input type="reset" value="Clear" />
              <input type="submit" value="Sign up" />
            </li>
          </ul>
        </form>
      </div>
      <div class="login">
        <form action="log_in.php" method="post" enctype="multipart/form-data">
          <ul>
            <li>
              <p>Login:</p>
              <input type="text" name="login" maxlength="20" size="10" />
            </li>
            <li>
              <p>Password:</p>
              <input type="password" name="password" maxlength="20" size="10" />
            </li>
            <?php
            if(isset($_SESSION['wrong_login_password']) && $_SESSION['wrong_login_password'] == true )
            {
              echo '<li><p class="error">Wrong login or password!</p></li>';
              $_SESSION['wrong_login_password'] = false;
            }
            ?>
            <li>
              <input type="reset" value="Clear" />
              <input type="submit" value="Log in" />
            </li>
          </ul>
        </form>
      </div>
    </main>
    <script src="js/script.js"></script>
    <?php
include('footer.html');

if(isset($_SESSION['registration_unsuccesful']) && $_SESSION['registration_unsuccesful'] == true)
{
  echo '<script type="text/javascript">set_signup();</script>';
}

?>
  </body>
</html>
