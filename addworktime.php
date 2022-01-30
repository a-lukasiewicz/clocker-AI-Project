<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$work_time = $_POST['work_time'];
		$hourly_pay = $_POST['hourly_pay'];
    	$description = $_POST['description'];
    	$pid = $_POST['project_id'];
        $user_id = $_SESSION['user_id'];


		if(!empty($work_time) && !empty($hourly_pay) && !empty($description))
		{

			$company_id = random_num(20);
            $workrecord_id = random_num(20);
			$query = "insert into workrecord(workrecord_id,worker_id,work_time,hourly_pay,description,date,project_id) values('$workrecord_id','$user_id','$work_time','$hourly_pay','$description', NOW(), '$pid');";
			
			mysqli_query($con, $query);
			header("Location: user_index.php");
			die;
		}
		else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Clocker - Add new work record</title>
    <link rel="stylesheet" href="styles/createCompany.css">
</head>
<body>
    <div id="box">
      <form method="post" id="login">
        <h1 id="title">Add new work record</h1>
        <input id="text" type="text" name="work_time" placeholder="Hours worked e.g. 10.45" />
        <input id="text" type="text" name="hourly_pay" placeholder="Hourly pay e.g. 20.5" />
		<input id="text" type="text" name="project_id" placeholder="Project ID" />
        <input id="text" type="text" name="description" placeholder="Description" />
		<input id="button" type="submit" value="Add">
		<a href="user_index.php"></a> 
      </form>
    </div>
  </body>
</body>
</html>