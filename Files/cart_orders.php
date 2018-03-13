<!doctype html>
<html>
<head>
	<link rel="icon" href="/project/images/cf.ico">
	<title>Cart</title>
	<style>
		.small{
		width : 15%; 
		height : 150px;
		margin-left : 30px;
		margin-top : 25px;
		border : 0.5px solid grey;
		position:absolute;
		}
		.prod{
		height : 200px;
		margin-top : 50px;
		border:0.5px solid grey;
		}
		#name{
		font-weight : bolder;
		font-size : 25px;
		margin-top:20px;
		margin-left:250px;
		}	
		#price{
		margin-left:249px;
		margin-top:-30px;
		}
		#cs{
		margin-top:80px;
		}
		#quantity{
		margin-left:250px;
		margin-top:60px;
		}
		#bin
			{
				
				margin-left:95%;
				margin-top:-90px;
			}
			#div1{
	margin-top : 130px;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #cd853f;
    border-bottom : 9px solid #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 20px 40px;
    text-decoration: none;
}

li a:hover {
    background-color: white;
      border-bottom : 6px solid white;
      color : black;
}
		
		
	</style>
</head>


<body>
 
<?php
include 'header_logout.php';
?>
<div id=div1>
	<ul>
  		<li><a href="cart_profile.php">Profile</a></li>
  		<li><a  class="active" href="cart_wishlist.php">Wishlist</a></li>
  		<li><a   href="cart_orders.php">Orders</a></li>
	</ul>
</div>

<?php
session_start();
$m=new MongoClient();
$db=$m->clickfurnish;
$collection=$db->cart;
$customerid=$_SESSION['cust_id'];
$cursor = $collection->find(array('_id'=>"$customerid"));

foreach($cursor as $obj)
{
	foreach($obj['purchased'] as $doc1)
	{
		if($doc1['status']==1)
		{
		$prod_id=$doc1['prod_id'];
				$name=$doc1['prod_name'];
				$price=$doc1['prod_price'];
				$imgname=$prod_id."0";
				$dirname="/project/images/product_images/";
				$image=($dirname."$imgname");
				echo '<div class="prod">';
				echo '<img class="small"  alt="err" src="'.$image.'" >';
				echo '<p id="name">'.$name."</p>";
				echo '<br><p id="price">';
				echo "<font color='green' size='4'>Price : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo $price."</font><br>";
				echo '</p>';
				echo '</div>';
		}
	}
}
?>
