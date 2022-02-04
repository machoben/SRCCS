<?php

include('includes/config.php');

	if (isset($_GET['cardnumber'])) {

		$cardnumber = $_GET['cardnumber'];

		$sql = "UPDATE customer set cardstatus = 1 where cardnumber=$cardnumber";
		$query = $dbh->prepare($sql);
		$query -> execute();
		
	}
	header('location: manage-customer.php');
?>