<?php 
session_start();
	include("config/connection.php");
	include("config/functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						//jesli program jest tu to poprawne dane uzytkownika
						$_SESSION['user_id'] = $user_data['user_id'];
						$user_id = $user_data['user_id'];
						
						//sprawdzenie czy jest sie adminem
						$query = "SELECT * FROM companies WHERE admin_id='$user_id' limit 1"; //jeden admin moze miec jedna firme
						$result = mysqli_query($con, $query);
						if($result && mysqli_num_rows($result) > 0)
						{
							$company_data = mysqli_fetch_assoc($result);
							$_SESSION['company_id'] = $company_data['company_id'];
							header("Location: admin_index.php");
							die;
						}
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div id="box">
      <form method="post" id="login">
        <h1 id="title">Login</h1>
        <input id="text" type="text" name="user_name" placeholder="Username" />
        <input id="text" type="password" name="password" placeholder="Password" />

        <button type="submit">Login</button>

        <div id="signup">
          <p id="text">Dont't have an account?</p>
          <a href="signup.php">Sign Up</a>
        </div>
      </form>
    </div>
  </body>
</html>