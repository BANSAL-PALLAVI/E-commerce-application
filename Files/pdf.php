<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('logo-trans.png',10,10,50);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,10,'Invoice',1,0,'C');
	// Line break
	$this->Ln(20);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',18);
session_start();
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->cart;
$customerid=$_SESSION['cust_id'];
$total=$_SESSION['total'];
$cursor = $collection->find(array('_id'=>"$customerid"));
$pdf->Multicell(90,8,'Items purchased :-');
$pdf->SetFont('Arial','B',10);
foreach( $cursor as $obj)
	{
		$id = $obj['_id'];
		
			foreach($obj['purchased'] as $doc1)
			{
			$pdf->Multicell(90,10,$doc1['prod_name']);
			$pdf->Multicell(90,10,$doc1['prod_price']);
			}
		}
$pdf->Multicell(90,10,'Total Amount:-');		
$pdf->Multicell(90,10,$total);
$pdf->Output();
?>
