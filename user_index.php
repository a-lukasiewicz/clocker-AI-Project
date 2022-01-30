<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");
	$user_data = check_login($con);

  $uid = $user_data['user_id'];
  $sumah = 0;
  $sumam = 0;
  $moneyToday = 0;
  $data = $con->query("SELECT `worker_id`, `workrecord_id`, `work_time`, `hourly_pay` , (
    `work_time` * `hourly_pay`
    ) AS 'total', `description` , `date`, `project_id`
    FROM `workrecord`
    WHERE `worker_id` =$uid
    GROUP BY `workrecord_id`");

  if(!empty($data))
  {
    foreach($data as $result)
    {
      $sumah+=$result['work_time'];
      $sumam+=$result['total'];
      $td = date('yyyy-mm-dd');
      if(strtotime($result['date']) == $td)
      {
        $moneyToday=$moneyToday+$result['total'];
      }
    }
    
  }
  else echo "There is no data yet.";

?>

<html>
  <head>
    <title>Clocker</title>
    <link rel="stylesheet" href="styles/index.css" />
  </head>
  <body>
    <div id="mainContainer">
      <div id="navigation">
        <ul>
          <li><a href="addworktime.php">Add work time</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <h1 id="title">DASHBOARD</h1>
      <h3 id="username">
        NAZWA FIRMY: Hello,
        <?php echo $user_data['user_name']; ?>
      </h3>
      <div id="content">
        <div id="employees" class="cards">
          <div id="employee_card" class="card">
            <div class="photo">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
              </svg>
            </div>
            <div>
              <h4>HOURS TODAY</h4>
              <div class="option">
                <?=
                "<p>{$result['work_time']} hours.</p>"
                ?>
              </div>
            </div>
          </div>
        </div>
        <div id="today" class="cards">
          <div id="today_card" class="card">
            <div class="photo">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
                <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
                <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
              </svg>
            </div>
            <div class="margin">
              <h4>MONEY TODAY</h4>
              <div class="option">
                <?=
                "<p>Today: {$moneyToday} </p>"
                ?>
              </div>
            </div>
          </div>
        </div>
        <div id="total" class="cards">
          <div id="total_card" class="card">
            <div class="photo">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div class="margin">
              <h4>TOTAL MONEY</h4>
              <div class="option">
                <?= "<p>Total money: {$sumam}</p>" ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="details">
        <div>Task
          <?php
            foreach($data as $result)
            {
              echo "<br>";
              echo $result['project_id'];
            }
          ?>
        </div>
        <div>Date
        <?php
            foreach($data as $result)
            {
              echo "<br>";
              echo date("d.m.Y",strtotime($result['date']));
            }
          ?>
        </div>
        <div>Money
        <?php
            foreach($data as $result)
            {
              echo "<br>";
              echo $result['total'];
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
