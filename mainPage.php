<?php
session_start();
include("config/connection.php");
include("config/functions.php");

$numberUsers = $con->query("SELECT COUNT('user_id') AS `number` FROM users");
$numberUsers = mysqli_fetch_array($numberUsers);

$numberWork = $con->query("SELECT SUM(work_time) AS `time` FROM workrecord");
$numberWork = mysqli_fetch_array($numberWork);

$numberWorkMonth = $con->query("SELECT SUM(work_time) AS `time` FROM workrecord WHERE MONTH(date) = MONTH(CURDATE())"); //wybiera godziny z tego miesiaca
$numberWorkMonth = mysqli_fetch_array($numberWorkMonth);

$numberWorkQuarter = $con->query("SELECT SUM(work_time) AS `time` FROM workrecord WHERE QUARTER(date) = QUARTER(CURDATE())"); //z tego kwartalu
$numberWorkQuarter = mysqli_fetch_array($numberWorkQuarter);

$numberWorkDay = $con->query("SELECT SUM(work_time) AS `time` FROM workrecord WHERE DAY(date) = DAY(CURDATE())"); //z tego dnia
$numberWorkDay = mysqli_fetch_array($numberWorkDay);

$numbers = array("numberUsers","numberWork", "numberWorkMonth", "numberWorkQuarter", "numberWorkDay");

foreach ($numbers as $n)
{
    if(empty(${$n}))
    {
        ${$n}=0;
    }
}
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
                <li><a href="login.php">Sign in</a></li>
                <li><a href="signup.php">Sign up</a></li>
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
        </ul>
        <ul id="numberUl">
          <li id="numberLi">Wynosi: <font size="+10"><?= "{$numberUsers['number']}" ?></font></li>
        </ul>
        <ul id="numberUl">
          <li id="numberLi">Liczba godzin przepracowanych</font></li>
        </ul>
        <ul id="numberUl">
          <li id="numberLi2">Wynosi: <font size="+10"><?php echo $numberWork['time'] ?></font> od startu aplikacji</li>
          <li id="numberLi2">Wynosi: <font size="+10"><?php echo $numberWorkQuarter['time'] ?></font> w obecnym kwartale</li>
          <li id="numberLi2">Wynosi: <font size="+10"><?php echo $numberWorkMonth['time'] ?></font> w obecnym miesiecu</li>
          <li id="numberLi2">Wynosi: <font size="+10"><?php echo $numberWorkDay['time'] ?></font> dzisiaj</li>
        </ul>
      </div>
      <div id="aboutTitle">
        <h3 id="aboutH1">Na co możesz liczyć?</h3>
      </div>
      <div id="aboutUs">
        <p id="aboutP">Nasza aplikacja wesprze Twój zespół w organizacji pracy, która często okazuje się problemem. Clocker pomoże
        firmie, StartUpie, Indie Developerom albo freelancerom w uporządkowaniu czasu pracy jak i śledzenie postępów Twoich pracowników.
        Wystarczy, że założysz konto na naszym serwisie i wszystkie funkcjonalności będą udostępnione Tobie za darmo! Nie licz na siebie,
        licz na NAS!
        </p>
      </div>
  </body>
</html>
