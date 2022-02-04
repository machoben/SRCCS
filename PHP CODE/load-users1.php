<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Transaction_id</th>
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
                                        
                                            <th>Transaction_id</th>
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

include('includes/config.php');
$seldate = $_SESSION['exportdata'];

$sql = "SELECT * from  transaction where data= $seldate  ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                        
                                            <td><?php echo htmlentities($result->transaction_id);?></td>
                                            <td><?php echo htmlentities($result->transaction_type);?></td>
                                            <td><?php echo htmlentities($result->cardnumber);?></td>
                                            <td><?php echo htmlentities($result->amount);?></td>
                                            <td><?php echo htmlentities($result->availablebalance);?></td>
                                            <td><?php echo htmlentities($result->date);?>
                                            <td><?php echo htmlentities($result->time)?></td>
                                            </td>
                                                                

                                
                                        
                                        <?php  
                                    }} ?>
                                        
                                    </tbody>
                                </table>