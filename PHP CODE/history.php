<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Admin View Transaction   </title>

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
		<div class="content-wrapper" style="background:antiquewhite;">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Transaction History</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">TRANSACTION</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								
    
    	<form  action="history.php" method="POST">
	<label for=""> start date:</label>
		<input type="date" name="formdate">
		<label for=""> start date:</label>
		<input type="date" name="todate">

		<button class="btn btn-primary btn-sm" type="submit" name="search"> <span class="fa fa-file-o"></span> Generate report</button>
		<!-- <input type="submit" name="search" value="Generate report" class= > -->
			</form>
<!-- <button class="btn btn-primary btn-sm" type="submit" name="export"> <span class="fa fa-file-excel-o"></span> Export</button> -->

                      <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Transaction_Type</th>
											<th>CardNumber</th>
											<th>Amount</th>
											<th>AvailableBalance</th>
											<th>Date</th>
											<th>Time</th>
											
										</tr>
									</thead>
									<tfoot>
										<tr>
										
											<th>#</th>
											<th>Transaction_Type</th>
											<th>CardNumber</th>
											<th>Amount</th>
											<th>AvailableBalance</th>
											<th>Date</th>
											<th>Time</th>
											
										</tr>
										</tr>
									</tfoot>
									<tbody>
<?php

if(isset($_POST['search']))
{
$from_date = $_POST['fromdate'];
$to_date = $_POST['todate'];
$transaction_type = $_POST['select'];

$sql = $dbh->query("SELECT * FROM `transaction` WHERE date BETWEEN '".$_POST['fromdate']."' AND '".$_POST['todate']."'");
$sum = $dbh->query("SELECT SUM(amount) AS total FROM transaction WHERE date BETWEEN '".$_POST['fromdate']."' AND '".$_POST['todate']."' ");
$total = $sum->fetch();
?>

	<!-- <p style="background: black; color: white;padding: 7px;font-size: 20px; text-align: center;" ><?php echo "Total amount".$total['total']." "."rwf";?></p> -->

<?php
 
 

while ($row = $sql->fetch()) {
   // echo $row['amount']."<br />\n";
    ?>
   											<tr> <td><?php echo $row[$cnt];?></td>
											<td><?php echo $row['transaction_type']."<br />\n";?></td>
											<td><?php echo $row['cardnumber']."<br />\n";?></td>
											<td><?php echo $row['amount']."<br />\n";;?></td>
											<td><?php echo $row['availablebalance']."<br />\n";?></td>
											<td><?php echo  $row['date']."<br />\n";?></td>>
											<td><?php echo $row['time']."<br />\n";?></td></tr>
<?php
}
 $cnt=$cnt+1; }

?>

										
									</tbody>
								</table>

						

							</div>
						</div>

					

					</div>
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
</body>
</html>

<?php 
if (isset($_POST['export'])){

	//require_once 'report.php';
 
include_once 'include/Config.php'; 


 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "members-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('transaction_type', 'cardnumber', 'amount', 'availablebalance', 'date', 'time'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
//Fetch records from database 
//$query = $db->query"SELECT * FROM `transaction` WHERE date BETWEEN '".$_POST['fromdate']."' AND '".$_POST['todate']."' "); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['transaction_type'], $row['cardnumber'], $row['amount'], $row['availablebalance'], $row['date'], $row['time']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;} ?>