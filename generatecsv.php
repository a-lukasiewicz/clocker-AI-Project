<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");
	$user_data = check_login($con);
    $company_data = check_company($con);
    
    $uid = $user_data['user_id'];

    $data = $con->query("SELECT workrecord.`worker_id` AS 'id', SUM( `work_time` ) AS 'total', (
      workrecord.`work_time` * workrecord.`hourly_pay`
      ) AS 'totalmoney', workrecord.`date`, workrecord.`work_time`, workrecord.`project_id`,
    CASE
    WHEN DATE( `date` ) = DATE( CURDATE( ) )
    THEN `work_time`
    ELSE 0
    END AS 'today'
    FROM workrecord
    INNER JOIN companyWorkers ON companyWorkers.worker_id = workrecord.worker_id
    WHERE companyWorkers.employment_id =$uid
    GROUP BY workrecord.worker_id");
      
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="raport.csv";');
  

    // open csv file for writing
    $f = fopen('php://output', 'w');
    if ($f === false) {
        die('Error opening the file ' . $filename);
    }
    $firstLine = "";
    $line = "";
    if(!empty($data))
    {
        $firstLine = array("worker_id","task_id","date","work_time","total_money");
        fputcsv($f, $firstLine, ";");
        foreach($data as $result)
        {
            $line = array($result['id'],$result['project_id'],$result['date'],$result['work_time'],$result['totalmoney']);
            fputcsv($f, $line, ";");
        }
    }
    else echo "There is no data yet.";
?>