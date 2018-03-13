<?php
session_start();
require('fpdf.php');
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->product;
$prodid=$_GET['prodid'];
$prodn=$_GET['prodname'];
echo $prodid;
//echo $prodn;
$query=array();
$cursor=$collection->find($query);
foreach($cursor as $doc)
{
   	foreach($doc['category'] as $doc1)
   	{
   		//echo $doc1['category_name'];
		foreach($doc1['products'] as $doc2)
   		{
   			
   				if($doc2['Name']==$prodn)
   				{
   					echo "hi";
   					//echo $doc2['prod_id'];
   				}
   				

}}}
$collection1=$db->cart;
$customerid=$_SESSION['cust_id'];
$cursor = $collection1->find(array('_id'=>"$customerid"));
foreach( $cursor as $obj)
{
	$id = $obj['_id'];
	$obj=$obj['purchased'];
	foreach($obj as $doc1)
	{
		$na=$doc1['prod_name'];
	
		$prod=$doc1['prod_id'];
		$n=new MongoId($prod);
		$new=new MongoDate();
		$criteria=array('prod_name'=>"$na");
		$collection1->update($criteria,array('$addToSet'=>array('purchased'=>array('prod_id'=>$doc1['prod_id'],'prod_name'=>$doc1['prod_name'],'prod_price'=>$doc1['prod_price'],'date'=>$new,'status'=>1))));
	}
}



/*class PDF extends FPDF
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
$pdf->Output();*/
?>
