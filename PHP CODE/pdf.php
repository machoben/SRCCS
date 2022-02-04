
<?php 
include('includes/config.pdf');
if(isset($_POST['download'])) {

$filename="contract/".$reg." .pdf";

 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM customer where cardnumber = ?";
  $q = $dbh->prepare($sql);
  $q->execute(array($cardnumber));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  
            require('kepdf/fpdf.php');
            class PDF extends FPDF
{
// Page header
function Header()
{

    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    $this->Ln(20);
}

function Footer()
{
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF(); 
$pdf->AddPage('p','A4',0);
$pdf->AliasNbPages();
$width_cell=array(20,50,40,40,40);

$pdf->SetFont('Times','',14);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;
$pdf->SetXY (10,10);
$pdf->SetFontSize(5);
$pdf->Ln(10);
$pdf->Image('logo.png');
$pdf->write(5,'Hostel Contract');
$pdf->Ln(20);
$pdf->SetFontSize(20);
$pdf->write(5,'Firt Name:  '.$fname);
$pdf->Ln(10);
$pdf->write(5,'Last Name:  '.$lname);
$pdf->Ln(10);
$pdf->write(5,'Registration Number:  '.$reg);
$pdf->Ln(10);
$pdf->write(5,'Option : IT ');
$pdf->Ln(10);
$pdf->write(5,'Email: '.$email);
$pdf->Ln(10);
$pdf->write(5,'Signature Of Student ........');
$pdf->Ln(10);
$date=date('y-m-d h:m:s');
$pdf->write(5,'Payed On: '.$date);
$pdf->Ln(10);
$pdf->Ln(30);
$pdf->write(5,"Under consideration of Payment Simulation");
$pdf->Ln(10);
$pdf->Image('cashe.png',0,0,20,20);
$pdf->Output($filename,'F');
            ?>
            <center>
     <a title="PDF" href="<?=$filename?>" download='<?=date('Y-m-d H-i-s').$filename?>' class="btn btn-primary col-sm-2 pdocrud-actions pdocrud-button pdocrud-button-export" data-action="exporttable" data-export-type="pdf" data-objkey="xIYzPRmEfB">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>Download PDF</a>
                                        </center>
                                        <?php}?>