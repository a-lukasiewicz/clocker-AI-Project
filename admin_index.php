<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");
	$user_data = check_login($con);
  $company_data = check_company($con);

  $uid = $user_data['user_id'];
	
  $sumemp =0;
  $summoney=0;
  $sumh=0;
  $times = $con->query("SELECT workrecord.`worker_id` AS 'id', SUM( `work_time` ) AS 'total', (
    workrecord.`work_time` * workrecord.`hourly_pay`
    ) AS 'totalmoney', workrecord.`date`, workrecord.`work_time`, 
  CASE
  WHEN DATE( `date` ) = DATE( CURDATE( ) )
  THEN `work_time`
  ELSE 0
  END AS 'today'
  FROM workrecord
  INNER JOIN companyWorkers ON companyWorkers.worker_id = workrecord.worker_id
  WHERE companyWorkers.employment_id =$uid
  GROUP BY workrecord.worker_id");
  
  if(!empty($times))
  {
    foreach ($times as $result)
    {
      $sumemp +=1;

      $summoney+=$result['totalmoney'];
      $td = date('yyyy-mm-dd');
      if(strtotime($result['date']) == $td)
      {
        $sumh+=$result['total'];
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
          <li><a href="addUser.php">Add user to company</a></li>
          <li>Generate CSV</li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <h1 id="title">DASHBOARD</h1>
      <h3 id="username">
        Hello ADMIN,
        <?php echo $user_data['user_name'] . " of company " . $company_data['company_name'];  ?>
      </h3>
      <!--<div class="select">
        <label for="select">Select project name</label>
        <select name="selectProject" id="projectName">
          <option value="project1">Project 1</option>
          <option value="project2">Project 2</option>
          <option value="project3">Project 3</option>
        </select>
      </div>-->
      <div id="content">
        <div id="employees" class="cards">
          <div id="employee_card" class="card">
            <div class="photo">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
              </svg>
            </div>
            <div>
              <h4>EMPLOYEES</h4>
              <div class="option">
                <?= "<p>{$sumemp}" ?>
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
              <h4>TODAY WORKTIME</h4>
              <div class="option">
                <?= "<p>{$sumh}</p>" ?>
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
              <h4>TOTAL SALARY</h4>
              <div class="option">
                <?= "{$summoney}" ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="details">
      <div>Worker ID
          <?php
            foreach($times as $result)
            {
              echo "<br>";
              echo $result['id'];
            }
          ?>
        </div>
        <div>Date, Hour Worked
        <?php
            foreach($times as $result)
            {
              echo "<br>";
              echo date("d.m.Y",strtotime($result['date'])). "  ".$result['work_time'];
            }
          ?>
        </div>
        <div>To Pay
        <?php
            foreach($times as $result)
            {
              echo "<br>";
              echo $result['totalmoney'];
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
