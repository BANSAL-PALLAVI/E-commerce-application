<?php
session_start();
require('fpdf.php');
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->product;
$prodid=$_GET['prodid'];
$prodn=$_GET['prodname'];
echo $prodid;
$collection1=$db->cart;
$customerid=$_SESSION['cust_id'];
//echo $customerid;
$cursor = $collection1->find(array('_id'=>"$customerid"));
foreach( $cursor as $obj)
{
	$id = $obj['_id'];
	foreach($obj['purchased'] as $doc1)
	{
		$na=$doc1['prod_name'];
		$prod=$doc1['prod_id'];
		$n=new MongoId("$prod");
		$cursor = $collection1->find(array('_id'=>"$customerid"));
	
$collection1->update(array('_id'=>"$customerid",'purchased.prod_name'=>"$na"),array('$set'=>array('purchased.$.status'=>1)),array('multiple'=>true,'safe'=>true));
}
}



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




$total=$_SESSION['total'];
$pdf->SetTextColor(204,41,0);
$pdf->Cell(90,8,'Items purchased :-',1,0);
$pdf->Cell(90,8,'Price :-',1,1);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
foreach( $cursor as $obj)
	{
		$id = $obj['_id'];
		
			foreach($obj['purchased'] as $doc1)
			{
			$pdf->Cell(90,10,$doc1['prod_name'],1,0);
			$pdf->Cell(90,10,$doc1['prod_price'],1,1);
			}
		}
$pdf->Cell(90,10,'Total Amount:-',1,0);		
$pdf->Multicell(90,10,$total.' (Including Shipping Charges)',1,1);
$pdf->Output();
?>
