
<?php
session_start();
error_reporting(0);
include('includes/config.php');
// if(strlen($_SESSION['alogin'])==0)
// 	{	
// header('location:index.php');
// }
// else{
// if(isset($_POST['submit']))
{
$cardnumber  =$_POST['CardNumber'];
$FirstNumber =$_POST['FirstName'];
$LastName    =$_POST['LastName'];
$Gender      =$_POST['Gender'];
$Department  =$_POST["Department"];
$Option      =$_POST['option'];
// $year        =$_POST['year'];
$CardStatus  =$_POST['CardStatus'];


$sql="INSERT INTO  customer VALUES(:CardNumber,:FirstName,:LastName,:Gender,:Department,:option,:year,:CardStatus)";
$query = $dbh->prepare($sql);
$query->bindParam(':CardNumber',$brand,PDO::PARAM_STR);
$query->bindParam(':FirstName',$FirstName,PDO::PARAM_STR);
$query->bindParam(':LastName',$LastName,PDO::PARAM_STR);
$query->bindParam(':Gender',$Gender,PDO::PARAM_STR);
$query->bindParam(':Department',$Department,PDO::PARAM_STR);
$query->bindParam(':option',$Option,PDO::PARAM_STR);
// $query->bindParam(':year',$year,PDO::PARAM_STR);
$query->bindParam(':CardStatus',$CardStatus,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Events Created successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register form</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<form method="post" action="">
	<div>
		<label for="CardNumber">CardNumber</label>
		<input type="text" name="CardNumber" placeholder="CardNumber">
		<span></span>
		<label for="FirstName">FirstName</label>
		<input type="text" name="FirstName" placeholder="FirstName">
		<span></span>
		<label for="LastName">LastName</label>
		<input type="text" name="FirstName" placeholder="FirstName">
		<span></span>
	</div>
	<div>
		<label for="Gender">Gender</label>
		<input type="radio" name="Gender" value="female">Female
		<input type="radio" name="Gender" value="male">Male
		<input type="radio" name="Gender" value="other">Other 
		<span></span>
		<label for="Department">Department</label>
		<input type="text" name="Department" placeholder="Department">
		<span></span>
		<label for="option">Option</label>
		<input type="text" name="option" placeholder="option">
		<span></span>
		
	</div> 
	<div>
		<!-- <label for="year">Academic Year</label>
		<input type="text" name="Year" placeholder="">
		<span></span> -->
		<label for="CardStatus">CardStatus</label>
		<input type="CardStatus" name="CardStatus" placeholder="">
		<span></span>
	</div>
	<button name="prev">Previous</button>
	<button name="next">save</button>
	<section>
		<p></p>
		<p></p>
		<p></p>
	</section>
	<script type="text/javascript" src="js/js.js"></script>
</form>

</body>
</html>