<?php
		session_start();
		
		$m = new MongoClient();
   		$db = $m->clickfurnish;
   		$collection=$db->product;
		
		$query=array();
   		$cursor=$collection->find($query);
		
   		
	?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="icon" href="/project/images/cf.ico">
	<title>Details</title>
	<style>
	body
	{
		background-color:#ffe6e6;
	}
	
	.prod{
		
		height : 900px;
		margin-top : 200px;
		
	}
	.small{
		width : 10%; height : 100px;
		margin-left : 70px;
		margin-top : 50px;
		border : 0.5px solid grey;
	}
	.big{
		width : 40%; height : 450px;
		float : left;
		margin-left : 280px;
		position : absolute;
		border : 0.5px solid grey;
	}
		
	#block{
		margin-left : 800px;
		float : left;
		position : absolute;
		margin-top : -270px;
	}
	#name{
		
		
		font-weight : bolder;
		font-size : 33px;
		
	}
	#retail_price{
		font-size : 20px;
		margin-left : 50px;
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
				margin-left : 30px;
	}
	.specs{
		margin-left : 330px;
		margin-top:330px;
		position : absolute;
	}
	
	
	.image img {
    -webkit-transition: all 1s ease; /* Safari and Chrome */
    -moz-transition: all 1s ease; /* Firefox */
    transition: all 1s ease;
}

.image:hover img {
    -webkit-transform:scale(1.03); /* Safari and Chrome */
    -moz-transform:scale(0.2); /* Firefox */
     transform:scale(2);
}

#space {
		width: 100%;
		height: 100px;
		position: relative;
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
	$name=$_REQUEST['name'];
	foreach($cursor as $doc)
   	{
   		foreach($doc['category'] as $doc1)
   		{
   			if($doc1['category_name']==$cat)
   			{
   				foreach($doc1['products'] as $doc2)
   				{
   					if($doc2['Name']==$name){
   					echo '<div class="prod"  >';
   					
   					$imgname=$doc2['prod_id']."0";
     					$dirname="/project/images/product_images/";
   					$image=($dirname."$imgname");
					$id=$doc2['prod_id'];
   					echo '<img class="big" id="myImage" alt="err" src="'.$image.'" align="right" >';
   					
   					echo "<div id='block'>";
   					echo '<p id="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
   					echo "<br><br><br><br><br><br>";
   					echo "&nbsp;&nbsp;&nbsp;&nbsp;".$doc2['Name']."<br>";
   					$sp=$doc2['Shipping'];
   					echo '</p>';
   					echo '<p id="retail_price">';
   					echo '<font size="3" color="red"><strike>RetailPrice</strike> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';
   					echo $doc2['Retail Price']."</font><br>";
   					echo "<font color='green'>Our Price : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
   					echo $doc2['Our Price']."</font><br>";
					$price=$doc2['Our Price'];
   					echo '</p><form method="post">';
   					echo '&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="b_n" type="submit" method  name="booknow" value=" Book Now "> </a>';
					if(isset($_POST['booknow']))
					{
						if($_SESSION['authentication']==1)
						{
							$collection1=$db->cart;
							echo "<br><br><br>".$collection1;
							$customerid=$_SESSION['cust_id'];
							$new=new MongoDate();
							$ins=array(
							"prod_id"=>$id,
							"prod_name"=>$name,
							"prod_price"=>$price,
							"shipping"=>$sp,
							"date"=>$new,
							"status"=>0,
							"quantity"=>1,
							);
							$cursor1 = $collection1->find(array('_id'=>"$customerid"));

							foreach($cursor1 as $obj1)
								$id1=$obj1['_id'];
								
								if($id1==$customerid)
									$collection1->update(array('_id'=>"$id1"),array('$addToSet'=>array('purchased'=>($ins))));
								
								header("Location: cart_wishlist.php");
						}
					
						else
   							header("Location: login.php");
   					}
   					
   						
   					
   					echo "</form></div>";
   					echo '<div class="specs" float="center">';
   					echo '<br><br><br><br><br><br><br><br><b><font face="Terminal"> Specifications : </font></b>';
   					echo '<br><br>Brand : ';
   					echo $doc2['Brand'];
   					echo '<br><br>Dimensions : ';
   					echo $doc2['Dimensions'];
   					echo '<br><br>Delivery Condition : ';
   					echo $doc2['Delivery Condition'];
   					echo '<br><br>Color : ';
   					echo $doc2['Color'];
   					echo '<br><br>Warranty : ';
   					echo $doc2['Warranty'].' years warranty';
   					echo '<br><br>Material : ';
   					echo $doc2['Material'];
   					echo '<br><br>Shipping : ';
   					echo $doc2['Shipping'];
   					echo '<br><br>Room Type : ';
   					echo $doc2['Room Type'];
   					echo '</div>';
   					
   					$j=0;
   					for($i=$doc2['prod_id']."0"; $i<$doc2['prod_id'].$doc2['No of Images']; $i++)
   					{
   						if($j<$i)
   						{
   							$imgname=$doc2['prod_id'].$j;
   							$dirname="/project/images/product_images/";
   							$image=($dirname."$imgname");
   							$j++;
   							echo "<div class='image'>";
   							echo '<img class="small" id="myImg" alt="err" src="'.$image.'" >';
   							echo "</div>";
   						}
   					}
   					
   					echo '</div>';
   					
   					}
   				}
   			}
   		}
   	}
				
				
	?>  
	
	<div id="foot">
			<h3 style="font-family: Arial"> <center>&copy;Clickfurnish.com: All rights reserved. </center> </h3>
			<p> <center> <a href="aboutus.html"> Contact Us </a> </center> </p>

		</div>	
</body>
</html>

