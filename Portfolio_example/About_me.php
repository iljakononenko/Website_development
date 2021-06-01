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
    <main>
      <section class="bio">
        <img class="#me_logo" src="img/avatar_person.jpg" alt="My_Photo" />
        <h1>About me</h1>
        <p>
          My name is Illia Kononenko. I am from Ukraine and I live in Poland
          almost 5 years.
        </p>
        <p>Today I live in Wroclaw, Poland and I really like it.</p>
        <p>
          Right now I am studying Politechnika Wroclawska and I am on the 4th of
          7 semestr.
        </p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil laborum
          sapiente minus voluptates praesentium tenetur, reprehenderit
          repellendus tempora sed assumenda quis ex vitae ratione consequatur,
          aut quisquam nobis? Facere, quae! Nisi accusantium nesciunt minus,
          quibusdam corrupti dolor dolore expedita. Quod quaerat error
          accusantium sit quos pariatur eaque, alias cupiditate nulla ex.
          Officiis corporis autem harum vero iusto beatae unde maiores. Ab
          dolorem corporis perspiciatis recusandae, temporibus repellat ipsam
          eius at voluptates itaque quaerat provident odio ratione dolorum
          impedit? Distinctio corrupti sint ducimus voluptatum excepturi libero
          eaque deserunt quia impedit saepe.
        </p>
      </section>

      <section class="interests_section">
        <h1>My interests</h1>
        <div class="interests">
          <div class="interest">
            <div class="interest_ball">
              <img src="img/games.png" alt="" />
            </div>
            <h3>Games</h3>
          </div>
          <div class="interest">
            <div class="interest_ball">
              <img src="img/comics.png" alt="" />
            </div>
            <h3>Comics</h3>
          </div>
          <div class="interest">
            <div class="interest_ball">
              <img src="img/coding.png" alt="" />
            </div>
            <h3>Coding</h3>
          </div>
          <div class="interest">
            <div class="interest_ball">
              <img src="img/chess.png" alt="" />
            </div>
            <h3>Chess</h3>
          </div>
        </div>
      </section>

      <section class="contacts">
        <h1>Contact me</h1>
        <p>
          e-mail:
          <a href="mailto:iljakononenko3@gmail.com">iljakononenko3@gmail.com</a>
        </p>
        <p>phone: <a href="tel:692891846">692-891-846</a></p>
        <p>
          instagram:
          <a href="https://www.instagram.com/elijah.knk/">@elijah.knk</a>
        </p>
      </section>
    </main>
    <?php
include('footer.html');
?>
  </body>
</html>
