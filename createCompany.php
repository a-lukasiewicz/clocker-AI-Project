<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$company_name = $_POST['company_name'];
		$first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];


		if(!empty($company_name) && !empty($first_name) && !empty($last_name) && !is_numeric($company_name) && !is_numeric($first_name) && !is_numeric($last_name))
		{

			$company_id = random_num(20);
      $user_data = check_login($con);
      $admin_id = $user_data['user_id'];
			$query = "insert into companies (company_id,admin_id,company_name,first_name,last_name) values ('$company_id','$admin_id','$company_name','$first_name','$last_name')";
			
			mysqli_query($con, $query);
      $_SESSION['company_id'] = $company_id;
			header("Location: admin_index.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
    <link rel="stylesheet" href="styles/createCompany.css">
</head>
<body>
    <div id="box">
      <form method="post" id="login">
        <h1 id="title">Create company</h1>
        <input id="text" type="text" name="company_name" placeholder="Company name" />
        <input id="text" type="text" name="first_name" placeholder="First name" />
        <input id="text" type="text" name="last_name" placeholder="Last name" />
		<input id="button" type="submit" value="Create">
		<a href="admin.php"></a> 
      </form>
    </div>
  </body>
</body>
</html>