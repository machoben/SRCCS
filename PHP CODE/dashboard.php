<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<style type="text/css">
		 .ts-profile-nav { display: block; padding-right:15px; } } .ts-sidebar::-webkit-scrollbar-track { background-color: transparent; }
	</style>
	
	<title>SRCCS</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
		<div class="content-wrapper" style="background: whitesmoke; height: 600px;">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default bk-primary" style="color:white;">
											<div class="panel-body">
												<div class="stat-panel text-center">
<?php 
$sql ="SELECT cardnumber from Customer ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$regusers=$query->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($regusers);?></div>
													<div class="stat-panel-title text-uppercase">Students_Number</div>
												</div>
											</div>
											<a href="manage-customer.php" class="block-anchor panel-footer">Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default " style="background:deepskyblue ;
										color:white;">
											<div class="panel-body ">
												<div class="stat-panel text-center">
												<?php 
$sql1 ="SELECT cardnumber from transaction ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total=$query1->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($total);?></div>
													<div class="stat-panel-title text-uppercase">Transactons</div>
												</div>
											</div>
											<a href="view-transaction.php" class="block-anchor panel-footer text-center"> Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
										<div class="col-md-3 ">
										<div class="panel panel-default" style="background:darkcyan; color:white;">
											<div class="panel-body ">
												<div class="stat-panel text-center" style="padding: 25px;">
												

													<div class="stat-panel-number h1 "></div>
													<div class="stat-panel-title text-uppercase">Transaction History</div>
												</div>
											</div>
											<a href="history.php" class="block-anchor panel-footer text-center"> Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
							
		</div>
	</div>

	<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>

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
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>