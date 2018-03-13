<?php
	session_start();
?>

<!doctype html>
<html>
<head>
	<link rel="icon" href="/project/images/cf.ico">
	<title>Products </title>
	<style>
		body
		{
			background-color:#ffe6e6;
		}
		.prod
		{
		background-color:white;
		width: 30%;
		height: 400px;
		float: left;
		padding: 2px;
		position:relative;
		margin-top: 150px;
		margin-left: 2%;
		border : 1px solid grey;
		box-shadow :  0 8px 12px 0 rgba(0,0,0,0.5);
		}
		#b_n{
				padding: 5px;	
				position:absolute;
				background-color :#1e90ff;
				font-weight : bold;
				padding : 3px;
				color: white;
				border : 1px solid #a9a9a9;
				border-radius : 8px;
				width : 130px;
				height : 40px;
				margin-left : -50px;
		}
		#space {
		width: 100%;
		height: 100px;
		position: relative;
		margin-top: 5%;
		clear: left;

		
	}


#foot {
	background-color: black;
	color: white;
	height :100px;
	width: 100%;
	clear: left;
	padding-top:2%;

}
	</style>
</head>
<body>
		<?php
			
			if(!empty($_SESSION['authentication']))
				include 'header_logout.php';
			else
				include 'header.php';
		?>
<?php


	$cat=$_REQUEST['cat'];
	$m = new MongoClient();
   	$db = $m->clickfurnish;
   	$collection=$db->product;
   	$query=array();
   	$cursor=$collection->find($query);
   	foreach($cursor as $doc)
   	{
   		foreach($doc['category'] as $doc1)
   		{
   			if($doc1['category_name']==$cat)
   			{
   				foreach($doc1['products'] as $doc2)
   				{
   					$imgname=$doc2['prod_id']."0";
   					$dirname="/project/images/product_images/";
   					$image=($dirname."$imgname");
   					echo '<div class="prod">';
   					echo '<img src="'.$image.'" width=100% height=250px>';
   					echo $doc2['Name']."<br>";
   					echo '<center><font size=2><strike>Retail Price</strike> :  ';
   					echo '<strike>'.$doc2['Retail Price'].'</strike></font></center>';
   					echo "<center>Our Price : ";
   					echo $doc2['Our Price']."</center>";
   					echo "<center>Brand : ";
   					echo $doc2['Brand']."<center>";
   					echo '<a href="details.php?cat='.$cat.'&name='.$doc2['Name'].'"> <input type="submit"  name="buynow" id="b_n" value=" Buy Now "> </a>';
   					echo '</div>';
   					
   				}
   			}
   		}
   	}
   	
?>
		<div id="space" > </div>
		
 		<div id="foot">
			<h3 style="font-family: Arial"> <center>&copy;Clickfurnish.com: All rights reserved. </center> </h3>
			<p> <center> <a href=#> Contact Us </a> </center> </p>

		</div>	
</body>

</html>
