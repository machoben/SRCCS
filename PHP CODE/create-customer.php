<?php
session_start();
error_reporting(0);

include('includes/config.php'); 
include('read.php');

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


<script>  
function validateform(){  
var name=document.myform.name.value;  
var password=document.myform.password.value;  
  
if (name==null || name==""){  
  alert("Name can't be blank");  
  return false;  
}else if(password.length<6){  
  alert("Password must be at least 6 characters long.");  
  return false;  
  }  
}  
</script> 

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content" id="myRegistForm">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Student Registration</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="POST" name="chngpwd"  class="form-horizontal" onSubmit="return valid();" style="display:;">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-3 control-label">Card_Number</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="cardnumber" id="cardnumberm" value ="<?php echo $cardnumber;?>"required><br>
												</div><br>
												<div id="wait" style="display:none;">Waiting card to be taped</div>

												<div id="formHidden" style="display:none">
												<label class="col-sm-3 control-label">First_Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="firstname" id="brand" required><br>
												</div>
												
												<label class="col-sm-3 control-label">Last_Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="lastname" id="brand" required><br>
												</div>
											
												<label class="col-sm-3 control-label">Department</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="department" id="brand" required><br>
												</div>
												
												
												<label class="col-sm-3 control-label">Telephone</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="telephone" id="brand" required><br>
												</div>
												<label class="col-sm-3 control-label">Balance</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="balance" id="brand" required>
												</div>

											
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								<br>
													<button class="btn btn-primary" name="submit" type="submit">Register</button>
												</div>
											</div>
</div></div>
										</form>

									</div>
								</div>
							</div>
							
						</div>

						<?php 
// if (strlen($_POST['cardnumber']) >0) {
	$numb2=$_POST['cardnumber'];
	$amount = 500;
	$transaction_type ="Pull";
	$date=date("Y-m-d");
	$time=date("h:i:s");

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM customer where cardnumber = ?";
  $q = $dbh->prepare($sql);
  $q->execute(array($cardnumber));
  $data = $q->fetch(PDO::FETCH_ASSOC);

	$chkbalance = intval($data['balance']);
	if ($data['cardnumber'] == $cardnumber) {

	if ($data['cardstatus'] == 1) {
		if ($data['balance'] >=500) {


			$query ='INSERT INTO transaction(transaction_type,cardnumber,amount,availablebalance,date,time) VALUES(?,?,?,?,?,?)';
    $statement = $dbh->prepare($query);
    $balance = intval($data['balance']);
    $availablebalance = $balance - 500;
    $statement->execute(array($transaction_type,$cardnumber,$amount,$availablebalance,$date,$time));
    $lastInsertId = $dbh->lastInsertId();

    if($lastInsertId > 0){
    $query1 = "UPDATE customer SET balance=:availablebalance where cardnumber= $cardnumber";
    $q1 = $dbh->prepare($query1);
    $q1->bindParam(':availablebalance',$availablebalance,PDO::PARAM_STR);
    $q1->execute();
    $msgs= $q1->execute();
   
    	$msg = "payment successfull";

    
   }
			
		}else{
			$msg = "insufficient found";
			?>

			
    <?php
		}
		
	}else{
		$msg = "your are not allowed";
		}


}
	else
	{
		$msg = "Please register student first";
		?>
		<script type="text/javascript">
			document.getElementById('formHidden').style.display='block';
		</script>
		<?php
	}
						 ?>
				
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
<?php
if(isset($_POST['submit']))
{

$cardnumber  =$_POST['cardnumber'];
$FirstName   =$_POST['firstname'];
$LastName    =$_POST['lastname'];
$Department  =$_POST["department"];

$telephone   =$_POST['telephone'];

$Balance     = $_POST['balance'];
$cardstatus  = "1";

$sql="INSERT INTO  customer VALUES(:cardnumber,:firstname,:lastname,:department,:telephone,:balance,:cardstatus)";
$query = $dbh->prepare($sql);
if ($query->execute([':cardnumber' => $cardnumber,':firstname'=>$FirstName ,':lastname' => $LastName,':department'=>$Department,':telephone' => $telephone,':balance' => $Balance,'cardstatus'=>$cardstatus])) {

$msg="customer inserted successfully";
  }

}
?>