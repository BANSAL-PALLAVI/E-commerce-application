<?php
$category=$_POST['category'];
$name= $_POST['name'];
$cp=$_POST['cost_price'];
$rp= $_POST['retail_price'];
$op=$_POST['our_price'];
$brand=$_POST['brand'];
$height=$_POST['height'];
$width=$_POST['width'];
$length=$_POST['length'];
$dc=$_POST['del_cond'];
$color=$_POST['color'];
$warranty=$_POST['warranty'];
$material=$_POST['material'];
$shipping=$_POST['shipping'];
$rt=$_POST['room_type'];
$quantity=$_POST['quantity'];
$noOfImages=$_POST['num_images'];


if(isset($_POST['submit']))
{
	$m= new MongoClient();
	$db = $m->clickfurnish;
	$collection = $db->product;
	
	$doc=array(
	"prod_id"=>$content['_id']=new MongoId(),
	"Name"=>$name,
	"Cost Price"=>$cp,
	"Retail Price"=>$rp,
	"Our Price"=>$op,
	"Brand"=>$brand,
	"Height"=>$height,
	"Width"=>$width,
	"Length"=>$length,
	"Delivery condition"=>$dc,
	"Color"=>$color,
	"Warranty"=>$warranty,
	"Material"=>$material,
	"Shipping"=>$shipping,
	"Room Type"=>$rt,
	"Quantity"=>$quantity,
	"No of Images"=>$noOfImages,
	);
	if($collection->update(array('category.category_name'=>$category),array('$push'=>array('category.$.products'=>$doc))))	
		echo "Inserted successfully";	
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
	$max_file_size = 5*1024*1024; 
	$path = "/var/www/html/project/images/product_images/"; // Upload directory
	$count = 0;
	echo $content['_id'];

	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	        	//snew $content['_id']=array();
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$content['_id'].$count))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}

	$m->close(); 
}

	
	

?>

<!doctype>
<html>
<head>
<title>Input product</title>

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
	<ul>
  	<li><a class="active" href="input_product.php">Insert</a></li>
  	<li><a href="update1.php">Update</a></li>
  	<li><a href="delete.php">Delete</a></li>
  	
	</ul>
	
	<h2><center>Input the Product</center></h2>
	<form method="POST", action="input_product.php" enctype="multipart/form-data">
		<?php if(isset($_POST['price'])){
  			$category=$_POST['category'];
  			$name=$_POST['name'];
  			$cp=$_POST['cost_price'];
			$calc=$_POST['retail_price'];
			$res=$calc*65/100;
		}
		?>
		
	
		Category: <br>
		<select name="category" value="<?php echo $category; ?>"> 
    		<option><?php
    		if(isset($_POST['price']))
    			echo $category;
    		else
    			echo "Pick a category";
    		?></option>  
    		<option value="tables">Tables</option>
    		<option value="chairs">Chairs</option>
    		<option value="sofa set">Sofa Set</option>
		<option value="Dinning tables">Dinning Tables</option>
		<option value="storage">Storage</option>
		<option value="beds">Beds</option>
		<option value="Kitchen furniture">Kitchen Furniture</option>
  		</select><br><br>
  		
  		
		Name:<br>
		<input type="text" name="name" value="<?php echo $name; ?>"><br><br>
		Cost Price : <br>
		<input type="text" name="cost_price" value="<?php echo $cp; ?>"><br><br>
		
		Retail Price : <br>
		<input type="text" name="retail_price" value="<?php echo $calc; ?>" >
		<button type="submit" name="price" >Calc our price</button>
		
		
		Our Price: <br>
		<input type="text" name="our_price" value="<?php echo $res; ?>">
		
		<br><br>
		Brand :<br>
		<select name="brand" ><br><br>
			<option value="Woodsworth"> Woodsworth </option>
			<option value="Amberville"> Amberville</option>
			<option value="CasaCraft"> CasaCraft</option>
			<option value="@Home"> @Home</option>
			<option value="Mintwud"> Mintwud</option>
			<option value="HomeTown"> HomeTown</option>
			<option value="Rpooyal Oak"> Rpooyal Oak</option>
			<option value="Home World"> Home World</option>
			<option value="In Houze"> In Houze</option>
			<option value="Parin"> Parin</option>
			<option value="GEBE"> GEBE</option>
			<option value="Forzza Furniture"> Forzza Furniture</option>
			<option value="TruHome Golfer"> Truhome Golfer</option>
			<option value="Can"> Can</option>
			<option value="Bohemiana"> Bohemiana</option>
			<option value="Debono"> Debono</option>
			<option value="Karigar"> Karigar</option>
			<option value="Muramark"> Muramark</option>
			<option value="Home Wud"> Home Wud</option>
			<option value="HomeEdge"> HomeEdge</option>
			<option value="Arra"> Arra</option>
			<option value="Wood Decor"> Wood Decor</option>
			<option value="Asian Arts"> Asian Arts</option>
			<option value="Jodhpur Handicrafts"> Jodhpur Handicrafts</option>
		</select> <br><br>
			
		Dimensions (in inches H x W x D) :- <br> 
		Height : <br><input type="number" name="height" min="1"><br>
		Width : <br><input type="number" name="width" min="1"><br>
		Length : <br><input type="number" name="length" min="1"><br><br>
		
		
		Delivery condition : <br>
		<input type="radio" name="del_cond" value="Assembled" checked >Assembled<br>
		<input type="radio" name="del_cond" value="Carpenter Assembled" >Carpenter Assembled<br><br>

		Color : <br>
		<input type="text" name="color"><br><br>

		warranty : <br>
		<select name="warranty">
			<option value="3"> 3 Months </option>
			<option value="6"> 6 Months</option>
			<option value="9"> 9 Months</option>
			<option value="12"> 12 Months</option>
			<option value="15"> 15 Months</option>
			<option value="18"> 18 Months</option>
		</select><br><br>
		Material : <br>
		<select name="material" >
			<option value="foam"> Foam </option>
			<option value="oak wood"> Oak Wood </option>
			<option value="teak"> Teak </option>
			<option value="mango wood"> Mango Wood</option>
			<option value="sheesham wood"> Sheesham Wood</option>
			<option value="stainless steel and artificial leather"> stainless steel and artificial leather </option>
			<option value="solid wood">Solid Wood </option>
			<option value="leatherette"> Leatherette</option>
			<option value="metal"> Metal</option>
			<option value="fabric"> Fabric</option>
			<option value="acacia wood"> Acacia Wood</option>
		</select> <br> <br>
		Shipping  : <br>
		<select name="shipping" >
			<option value="0"> Free Shipping</option>
			<option value="1000"> 1000 Rs. Shipping Charges </option>
		</select> <br><br> 
		Room type : <br>
		
		<select name="room_type">
		<option> Living Room  </option>
		<option> Dining Hall</option>
		<option> Bedroom</option>
		<option> Kitchen</option>
		</select><br><br>
		Quantity : <br>
		<input type="number" name="quantity" min="1" ><br><br>
		Enter No. of images for the product : <br>
		<input type="text" name="num_images" > <br><br>
		Upload Images : <br>
		<input type="file" name="files[]" id="fileToUpload" multiple><br><br>
		<button type="submit" name="submit" value="submit">Submit</button>
</body>
</html>
