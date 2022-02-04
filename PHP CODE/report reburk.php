<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$CardNumber=$_GET['del'];
$sql = "delete from transation  WHERE cardnumber=:cardnumber";
$query = $dbh->prepare($sql);
$query -> bindParam(':cardnumber',$CardNumber, PDO::PARAM_STR);
$query -> execute();
$msg="Page data updated  successfully";

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
	<meta name="theme-color" content="#3e454c">
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="../../ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../../cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="../../maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
	
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
		<div class="content-wrapper">
			<div class="container-fluid">

<div class="container">
  <h2>Report / export to excel</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal
  </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Report / export to excel</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="Export_Excel.php" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="container-fluid">

                <div class="row">
                  <div class="col-lg-6 col-sm-6">
                    <div class="panel panel-primary">
                      <div class="panel-heading">Filter By Date:</div>
                      <div class="panel-body">
                      <label for="Start-Date"><b>Select from this Date:</b></label>
                      <input type="date" name="date_sel_start" id="date_sel_start">
                      <label for="End -Date"><b>To End of this Date:</b></label>
                      <input type="date" name="date_sel_end" id="date_sel_end">
                      </div>
                    </div>

                  </div>
                  <div class="col-lg-6 col-sm-6">
                 <div class="panel panel-primary">
                      <div class="panel-heading">Filter By Name</div>
                      <div class="panel-body">
                      <label for="Start-Date"><b>Names</b></label>
                      <select>
													<?php
													$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
												  $sql = "SELECT * FROM transaction where cardnumber = ?";
												  $q = $dbh->prepare($sql);
												  $q->execute(array($cardnumber));
												  
												  $data = $q->fetch(PDO::FETCH_ASSOC);
													$transaction_type = $data['transaction_type'];

													  ?>
													 <option value=""><?php echo $transaction_type;?></option>
													  
											 </select>
                      </div>
                    </div>
                  </div>
                   <div class="col-lg-6 col-sm-6">
                 <div class="panel panel-primary">
                      <div class="panel-heading">Filter By transaction_type:</div>
                      <div class="panel-body">
                      <select>
                      	<option>---------</option>
                      	<option>push</option>
                      	<option>pull</option>

                      </select>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
          </div>
      </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        	<button type="button" class="btn btn-success" data-dismiss="modal">Export</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Submit</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>





			
						

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
<?php } ?>
