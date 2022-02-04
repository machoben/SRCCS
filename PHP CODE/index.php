<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>


<body >
	
	<div class="login-page bk-img" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('img/11.jpg'); ">
		<div class="form-content" >
			<div class="container">
				<div class="row">
					<a href="dashboard.php"  style=" font-family: sans-serif; font-size: 2.5em; color: black;padding: 60px;">STUDENT RESTAURANT CARD CONTROL SYSTEM (SRCCS)</a>
					<div class="col-md-4 col-md-offset-4">
						<h1 class="text-center text-bold mt-4x" style="color: black; font-family: vernada;">LOGIN</h1>
						<div class="well row pt-2x pb-3x text-white-50 bk-blue" style="background:#ffffff;">
							<div class="col-md-9 col-md-offset-2">
								<form method="post" >
									<label for="" class="text-uppercase text-sm">Username </label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">
									<button class="btn btn-dark btn-block" name="login" type="submit">LOGIN</button>
									<div class="text-center text-light">
							<a href="forgotPassword.php" class="text-dark">Forgot password?</a>
						</div>

								</form>
							</div>

						</div>

						
					</div>


				</div>
				<div style="margin-top: 50px;">
	<?php include('includes/footer.php');?>
</div>

			</div>
		</div>


	</div>


	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>