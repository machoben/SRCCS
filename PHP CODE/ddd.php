<?php

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
    if($statement){
    $query1 = "UPDATE customer SET balance=:availablebalance where cardnumber= $cardnumber";
    $q1 = $dbh->prepare($query1);
    $q1->bindParam(':availablebalance',$availablebalance,PDO::PARAM_STR);
    $q1->execute();
    
   }
			
		}else{
			?>
			<script type="text/javascript">
     		alert("low balance please charge!!");
   		</script>
    <?php
		}
		
	}else{

		?>
			<script type="text/javascript">
     		alert("your are not allowed");
   		</script>
    <?php
		}


}else{

		?>
    <script type="text/javascript">
     document.getElementById('myRegistForm').style.display='block';
    </script>
    <?php
}
		//do transaction
 
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{

$cardnumber  =$_POST['cardnumber'];
$FirstName   =$_POST['firstname'];
$LastName    =$_POST['lastname'];
$Department  =$_POST["department"];
$Option      =$_POST['option'];
$Balance     = $_POST['balance'];
$cardstatus  = "1";

$sql="INSERT INTO  customer VALUES(:cardnumber,:firstname,:lastname,:department,:option,:balance,:cardstatus)";
$query = $dbh->prepare($sql);
if ($query->execute([':cardnumber' => $cardnumber,':firstname'=>$FirstName ,':lastname' => $LastName,':department'=>$Department,':option'  => $Option,':balance' => $Balance,'cardstatus'=>$cardstatus])) {

$msg="customer inserted successfully";
  }

}