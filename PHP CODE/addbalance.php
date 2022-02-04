<?php
session_start();
error_reporting(0);

include('includes/config.php'); 
include('read.php');

$transaction_type ="Push";
$date=date("Y-m-d");
$time=date("h:i:s");


  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT cardnumber , balance FROM customer where cardnumber = ?";
  $q = $dbh->prepare($sql);
  $q->execute(array($cardnumber));
  $data = $q->fetch(PDO::FETCH_ASSOC);

 $balance= intval($data['balance']);
  

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$cardnumber  = $data['cardnumber'];
$balance2    = $_POST['balance2'];
$amount    = intval($balance2);
$availablebalance = $balance + $amount;

$sql1="INSERT INTO  transaction(transaction_type,cardnumber,amount,availablebalance,date,time) VALUES(?,?,?,?,?,?)";
     $statement = $dbh->prepare($sql1);
     $statement->execute(array($transaction_type,$cardnumber,$amount,$availablebalance,$date,$time));
     if($statement){

     						$availablebalance = $balance + $amount;

     						echo $availablebalance;

						   	$query1 = "UPDATE customer SET balance=:availablebalance where cardnumber=:card";
						    $q1 = $dbh->prepare($query1);
						    $q1->bindParam(':availablebalance',$availablebalance,PDO::PARAM_STR);
						     $q1->bindParam(':card',$cardnumber,PDO::PARAM_STR);
						    $q1->execute();
						    if ($q1->rowCount()) {

						     $msg = "transaction done";

						    //   }
     					}
	     				}} 
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
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
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Add Balance</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" id="myRegistForm" class="form-horizontal" onSubmit="return valid();" style="display:;">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
			          	else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-3 control-label">Card_Number</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="cardnumber" id="brand" value ="<?php echo $cardnumber;?>"required><br>
												</div>
												
												<label class="col-sm-3 control-label">Balance</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="balance2" id="brand" required>
												</div>

											</div>
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Add Balance</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
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
<?php  }?>