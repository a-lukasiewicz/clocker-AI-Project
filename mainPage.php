<?php
session_start();
include("config/connection.php");
include("config/functions.php");
$user_data = check_login($con);
  check_employment($con);
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Clocker - track your work time</title>
    <link rel="stylesheet" href="styles/mainPage.css">
  </head>
  <body>
    <div id="mainContainer">
        <div id="navigation">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="#numbersTitle">Numbers</a></li>
                <li><a href="#aboutTitle">About Us</a></li>
            </ul>
        </div>
      </div>
      <div id="Logo">
      <img src="clockLogov3.png" alt="Logo">
      <h1 id="aboutH1">platforma śledzenia czasu pracy</h1>
      </div>
      <div id="numbersTitle">
        <h3 id="aboutH1">Nasza aplikacja w liczbach!</h3>
      </div>
      <div id="numbers">
        <ul id="numberUl">
          <li id="numberLi">Liczba użytkowników</li>
          <li id="numberLi">Liczba godzin przepracowanych</li>
        </ul>
        <ul id="numberUl">
          <li id="numberLi">Wynosi: <font size="+30">0</font></li>
          <li id="numberLi">Wynosi: <font size="+10">0</font></li>
        </ul>
      </div>
      <div id="aboutTitle">
        <h3 id="aboutH1">Na co możesz liczyć?</h3>
      </div>
      <div id="aboutUs">
        <p id="aboutP">Nasza aplikacja wesprze Twój zespół w organizacji pracy, która częstwo okazuje się problemem. Clocker pomoże Twojej
        firmie, StartUpie, Indie Developerom albo freelancerom w uporządkowaniu czasu pracy jak i śledzenie postępów Twoich pracowników.
        </p>
      </div>
  </body>
</html>
