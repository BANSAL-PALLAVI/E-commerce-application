<?php
session_start();
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->cart;
$value = isset($_POST['item']) ? $_POST['item'] : 1;
$name=$_GET['name'];
$customerid=$_SESSION['cust_id'];

if(isset($_POST['incqty']))
{
   $value += 1;
   $cursor = $collection->find(array('_id'=>"$customerid"));
	foreach( $cursor as $obj)
	{
		$id = $obj['_id'];
		foreach($obj['purchased'] as $doc1)
		{
			if($doc1['status']==0){
		$cursor = $collection->find(array('_id'=>"$customerid"));
	$collection->update(array('_id'=>"$customerid",'purchased.prod_name'=>"$name"),array('$set'=>array('purchased.$.quantity'=>$value)),array('multiple'=>true,'safe'=>true));}
}
}
$query=array();
$collection1=$db->product;
$cursor=$collection1->find($query);
foreach($cursor as $doc)
{
   	foreach($doc['category'] as $doc1)
   	{
   		//echo $doc1['category_name'];
		foreach($doc1['products'] as $doc2)
   		{
   			echo $doc2['Name'];
   				if($doc2['Name']==$name)
   				{
   					if($doc2['Quantity'] >= $value){
   					echo $doc2['Quantity'];
   					$q=$doc2['Quantity']-$value;
   					echo $q;
   					$collection1->update(array("products.$.Name"=>"$name"),array('$set'=>array('products.$.Quantity'=>$q)),array('multiple'=>true,'safe'=>true));
   					}
   					
   				}
   				

}}}
  
  
header("Location: cart_wishlist.php");
   
}

if(isset($_POST['decqty'])){
	if($value >=2)  
    $value -= 1;
    $cursor = $collection->find(array('_id'=>"$customerid"));
	foreach( $cursor as $obj)
	{
		$id = $obj['_id'];
		foreach($obj['purchased'] as $doc1)
		{
		
	$collection->update(array('_id'=>"$customerid",'purchased.prod_name'=>"$name"),array('$set'=>array('purchased.$.quantity'=>$value)),array('multiple'=>true,'safe'=>true));
}
}
   header("Location: cart_wishlist.php");
                                            
}
?>


