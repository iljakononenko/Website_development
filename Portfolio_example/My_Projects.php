<?php
session_start();
require_once ("connect.php");
$connection = @new mysqli($host, $db_user, $db_password, $db_name);
$project_id=1;
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
    <main>
      <article>
        <h1>My Projects</h1>
        <p>
          Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Sit
          repudiandae pariatur, eos ratione vel architecto fugit voluptate amet,
          optio similique itaque dolorum nulla in animi reiciendis sed neque
          repellendus. Aliquam.
        </p>
      </article>

      <article>
        <h2>Army database application</h2>
        <p>
          I worked on my own on the project I was ought to make for a Database
          classes final project, which was created to showcase obtained
          knowledge and skills through the semester.
        </p>
        <br />
        <p>
          My main goal was to create a GUI application for ordinary people, who
          will use it for simple tasks such as adding, removing and editing
          information in the database of users. In this case I used Java and its
          javafx library to easily manipulate GUI through a builder. As for a
          database, I decided not to complicate much and chose MySql for
          queries.
        </p>
        <?php
        include('comment_section.php');
        $project_id++;
        ?>
      </article>

      <article>
        <h2>Chinese Checkers ("Sternhalma")</h2>
        <p>
          I worked on my own on the project I was ought to make for a Database
          classes final project, which was created to showcase obtained
          knowledge and skills through the semester.
        </p>
        <br />
        <p>
          My main goal was to create a GUI application for ordinary people, who
          will use it for simple tasks such as adding, removing and editing
          information in the database of users. In this case I used Java and its
          javafx library to easily manipulate GUI through a builder. As for a
          database, I decided not to complicate much and chose MySql for
          queries.
        </p>

        <textarea id="code_sample" rows="10" readonly>
<?php
include('code.java');
?>
			</textarea
        >
        <?php
        include('comment_section.php');
        $project_id++;
        ?>
      </article>

      <article>
        <h2>Poll Website</h2>
        <p>
          I worked on my own on the project I was ought to make for a Database
          classes final project, which was created to showcase obtained
          knowledge and skills through the semester.
        </p>
        <br />
        <p>
          My main goal was to create a GUI application for ordinary people, who
          will use it for simple tasks such as adding, removing and editing
          information in the database of users. In this case I used Java and its
          javafx library to easily manipulate GUI through a builder. As for a
          database, I decided not to complicate much and chose MySql for
          queries.
        </p>
        <?php
        include('comment_section.php');
        $project_id++;
        ?>
      </article>
    </main>
    <?php
    include('footer.html');
  ?>
  </body>
</html>
