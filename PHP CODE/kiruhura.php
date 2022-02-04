<?php
include('includes/config.php');
  
$cardnumber = $_GET['cardnumber'];
$filename = 'file.txt';
$file = fopen($filename, 'w');
if($file == false)
{
	echo ('error');
	exit();
}
fwrite($file,$cardnumber);
fclose($file);
// if (strlen($_POST['cardnumber']) >0) {
	//$numb2=$_POST['cardnumber'];
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

    
   }}else{
			echo "insufficient funds, your balance is";
   		}
	}else{
		 echo "card blocked";
		}
}else{
		echo "get registered first";
	}
 ?>