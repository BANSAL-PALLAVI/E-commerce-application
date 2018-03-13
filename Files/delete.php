<?php
	$category=$_POST['category'];
	$name=$_POST['name'];
	if(isset($_POST['delete']))
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
   						$id=$doc2['prod_id'];
   						$imageval=$doc2['No of Images'];
   						if($index!=='')
						{
    							$condition=array("category.products.Name"=>$name);
    							$data=array('$pull'=>array("category.$.products"=>array("Name"=>$name)));
    							echo "bye";
    							$result=$collection->update($condition,$data);	
    							echo "hi";
    						}
   					}
   				}
   											
   			}
   				
   			
   		}
   	}
   	$m->close();
   	$path = "/var/www/html/project/images/product_images/"; 
   	for($i=0; $i <$imageval;$i++)
   	{
   		$filename=$path.$id.$i;
   		unlink($filename);
   	}
   	
   		
	
}
?>

<!doctype html>
<html>
	<head> 
		<link rel="stylesheet" type="text/css" >
		<link rel="icon" href="/C:\Users\Priyanka\Desktop\Proj\testing/logoicon.ico">
	</head>

	<style>
	form {
    	border: 3px solid #f1f1f1;
    	margin-left : 30%;
    	margin-right : 30%;
    	margin-top : 5%;
    	padding: 2%;
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

button {
    background-color: #4CAF50;
    color: green;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
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

	<body>
	
	<?php include 'header_logout.php'; ?>
		<ul>
  	<li><a class="active" href="input_product.php">Insert</a></li>
  	<li><a href="update1.php">Update</a></li>
  	<li><a href="delete.php">Delete</a></li>
  	
	</ul>
		<h2><center> Delete Product from DataBase</center></h2>
		<form method="post" action="delete.php"> 
		Category: <br>
		<select name="category" > 
    		<option>Pick a category</option>  
    		<option value="tables">Tables</option>
    		<option value="chairs">Chairs</option>
    		<option value="sofa set">Sofa Set</option>
		<option value="Dinning Tables">Dinning Tables</option>
		<option value="storage">Storage</option>
		<option value="beds">Beds</option>
		<option value="Kitchen furniture">Kitchen Furniture</option>
  		</select><br><br>
  		
			<label><b> Enter the Product Name</b></label>
			<input type="text" name="name" placeholder="Product name" required>
			<button type="submit" value="delete" name="delete"><font color="white" size="2">Delete</font> </button>
		</form>
	
	</body>
