<?php
	session_start();
	$category = $_POST['category'];
	$name = $_POST['name'];
	
	
	$_SESSION['category']=$category;
	$_SESSION['name']=$name;
	if(isset($_POST['submit'])){
		header("Location: /project/Files/update.php");
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
	<ul>
  	<li><a class="active" href="input_product.php">Insert</a></li>
  	<li><a href="update.php">Update</a></li>
  	<li><a href="delete.php">Delete</a></li>
  	
	</ul>
	<h2><center>Update A Product</center></h2>
	<form method="post" action="update1.php" enctype="multipart/form-data">
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
		
		
		Name:<br>
		<input type="text" name="name" ><br><br>
		
		<button type="submit" name="submit" value="submit" ><font color="white" size="2">Update</font> </button>

</body>
</html>
