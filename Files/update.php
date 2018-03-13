<?php
$category=$_POST['category'];
$name=$_POST['name'];
$rp= $_POST['retail_price'];
$op=$_POST['our_price'];
$dc=$_POST['del_cond'];
$color=$_POST['color'];
$shipping=$_POST['shipping'];
$quantity=$_POST['quantity'];


if(isset($_POST['submit']))
{
	$m= new MongoClient();
	$db = $m->clickfurnish;
	$collection = $db->product;
	
	$query=array();
   	$cursor=$collection->find($query);
   	$index='';
   	foreach($cursor as $doc)
   	{
   		foreach($doc['category'] as $doc1)
   		{
   			if($doc1['category_name']==$category)
   			{
   				foreach($doc1['products'] as $k=>$doc2)
   				{
   					if($doc2['Name']==$name)
   					{
   						$index=$k;
   						if($index!=='')
						{
							
    							$condition=array("category.products.Name"=>$name);
    							$data1=array('$set'=>array("category.$.products.".$index.".Retail Price"=>$rp));
    							$result=$collection->update($condition,$data1);	
    							$data2=array('$set'=>array("category.$.products.".$index.".Our Price"=>$op));
    							$result=$collection->update($condition,$data2);	
    							$data3=array('$set'=>array("category.$.products.".$index.".Delivery condition"=>$dc));
    							$result=$collection->update($condition,$data3);	
    							$data4=array('$set'=>array("category.$.products.".$index.".Color"=>$color));
    							$result=$collection->update($condition,$data4);	
    							$data5=array('$set'=>array("category.$.products.".$index.".Shipping"=>$shipping));
    							$result=$collection->update($condition,$data5);	
    							$data6=array('$set'=>array("category.$.products.".$index.".Quantity"=>$quantity));
    							$result=$collection->update($condition,$data6);	
    						}
   					}
   				}
   											
   			}
   				
   			
   		}
   	}	
	
		
	
}
?>

<!doctype>
<html>
<head>
<title>Update product</title>

<style>
form {
    border: 3px solid #f1f1f1;
    margin-left : 30%;
    margin-right : 30%;
    margin-top : 5%;
    padding : 2%;
}

form:hover{
	box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type=number] {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

select {
	width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    background-color: white;
}
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}


.container {
    padding: 16px;
    margin-top : 30px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }

}

ul {
    list-style-type: none;
    margin: 0;
    margin-top : 10%;
    padding: 0;
    overflow: hidden;
    background-color: #cd853f;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: white;
    color : black;
}
</style>
</head>
<body>
	<?php include 'header_logout.php'; ?>
	<?php
	session_start();
	$category = $_SESSION['category'];
	$name = $_SESSION['name'];
	$m = new MongoClient();
	$db = $m->clickfurnish;
	$collection = $db->product;
	
	$query=array();
   	$cursor=$collection->find($query);
   	
   	foreach($cursor as $doc)
   	{
   		foreach($doc['category'] as $doc1)
   		{
   			if($doc1['category_name']==$category)
   			{
   				foreach($doc1['products'] as $k=>$doc2)
   				{
   					if($doc2['Name']==$name)
   					{
   						

   	
	?>
	<ul>
  	<li><a class="active" href="input_product.php">Insert</a></li>
  	<li><a href="update1.php">Update</a></li>
  	<li><a href="delete.php">Delete</a></li>
  	
	</ul>
	<h2><center>Update A Product</center></h2>
	<form method="POST" action="update.php" enctype="multipart/form-data">
	<!-- Send this name further to fetch the required document -->
		Category:<br>
		<input type="text" name="category" value="<?php echo $category; ?>" readonly><br><br>
		Name:<br>
		<input type="text" name="name" value="<?php echo $doc2['Name']; ?>" readonly><br><br>
		Retail Price: <br>
		<input type="text" name="retail_price" value="<?php echo $doc2['Retail Price']; ?>" ><br><br>
		Our Price: <br>
		<input type="text" name="our_price" value="<?php echo $doc2['Our Price']; ?>"><br><br> 

		
		
		Delivery condition : <br>
		<input type="radio" name="del_cond" value="Assembled" checked >Assembled<br>
		<input type="radio" name="del_cond" value="Carpenter Assembled" >Carpenter Assembled<br><br>

		Color : <br>
		<input type="text" name="color" value="<?php echo $doc2['Color']; ?>"><br><br>


		Shipping  : <br>
		<select name="shipping" >
			<option value="free" > Free Shipping</option>
			<option value="rs1000"> 1000 Rs. Shipping Charges </option>
		</select> <br><br> 

		Quantity : <br>
		<input type="number" name="quantity" min="1" value="<?php echo $doc2['Quantity']; ?>"><br><br>
		<button type="submit"  name="submit"><font color="white" size="2">Update</font> </button>
		
		<?php 
			
	
	   					}
   				}
   											
   			}
   				
   			
   		}
   	}
   	?>

</body>
</html>
