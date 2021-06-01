<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Illia Kononenko | Lab_3</title>
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
    <main id="home">
      <h1>Welcome to my webpage!</h1>
      <a href="My_Projects.html" class="button">My Projects</a>
      <a href="About_me.html" class="button">About Me</a>
    </main>
    <?php
include('footer.html');
?>
  </body>
</html>
