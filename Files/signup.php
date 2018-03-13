<?php
$fn = $ln = $email = $country = $address = $contact = $favfood= "";
$fnErr = $lnErr = $emailErr = $countryErr = $contactErr = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$fn = test_input($_POST['firstname']);
	if(!preg_match("/^[a-zA-Z ]*$/",$fn))
	{
		$fnErr = "Only letters allowed";
		$flag = 1;
	}
	
	$ln = test_input($_POST['lastname']);
	if(!preg_match("/^[a-zA-Z ]*$/",$ln))
	{
		$lnErr = "Only letters allowed";
		$flag = 1;
	}
	
	$country = test_input($_POST['country']);
	if(!preg_match("/^[a-zA-Z ]*$/",$country))
	{
		$countryErr = "Only letters allowed";
		$flag = 1;
	}
	
	$email = test_input($_POST["email"]);
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    	{
      		$emailErr = "Invalid email format";
      		$flag = 1;
    	}
    	
    	$address = test_input($_POST['favfood']);
    	
    	$address = test_input($_POST['address']);
    	
    	$contact = test_input($_POST['contact']);
    	if(!preg_match("/^[0-9]{10}$/", $contact)){
    		$contactErr = "Only Digits allowed";
    		$flag = 1;
    	}
    	
}

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


$fn = $_POST['firstname'];
$ln = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$country = $_POST['country'];
$favfood = $_POST['favfood'];

if($flag != 1){
if(isset($_POST['signup']))
{
	$doc=array(
	"Firstname"=>$fn,
	"Lastname"=>$ln,
	"Email"=>$email,
	"Password"=>$password,
	"Contact"=>$contact,
	"Address"=>$address,
	"Country"=>$country,
	"Fav Food"=>$favfood);
	
	$m= new MongoClient();
	$db = $m->clickfurnish;
	$collection = $db->customer;
	echo $collection;
	if($collection->insert($doc))
	{
		$id=$doc['_id'];
		$collection1=$db->cart;
		$ins=array(
			'_id'=>"$id",
			'purchased'=>[],
		);
		$collection1->insert($ins);
		header("Location: login.php");
	}
}
}


?>



<!doctype>
<html>
	<head> 
		<link rel="stylesheet" type="text/css" >
		<link rel="icon" href="/project/images/cf.ico">
		<title> Sign Up</title>
	</head>

	<style>
	form {
    	border: 3px solid #f1f1f1;
    	margin-left : 30%;
    	margin-right : 30%;
    	margin-top : 5%;
    	padding : 20px;
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
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn{
	background-color: red;
	width : 100px;
}

</style>
	
	<body>
		<h2> <center> Sign Up Process </center></h2>
		<form method="POST" action="signup.php">

			
			<label> <b> First Name </b> <label>
			<input type="text" placeholder="First Name" name="firstname" required value="<?php echo $fn;?>"> <?php echo "<font size='2px' color='red' face='Arial'>".$fnErr."</font>"; ?> <br><br>

			<label> <b> Last Name </b> <label>
			<input type="text" placeholder="Last Name" name="lastname" required value="<?php echo $ln;?>">  <?php echo "<font size='2px' color='red' face='Arial'>".$lnErr."</font>"; ?> <br><br>

			<label> <b> Enter Email id</b> <label>
			<input type="text" placeholder="Email id" name="email" required value="<?php echo $email;?>">  <?php echo "<font size='2px' color='red' face='Arial'>".$emailErr."</font>"; ?> <br><br>

			<label> <b> Enter a  Password</b> <label>
			<input type="password" placeholder="Enter Password" name="password" required> <br/> <br/>

			<label> <b> Choose your Country</b> <label><br/>
			<select name="country">
			  <option value="India">India</option>
			  <option value="Russia">Russia</option>
			  <option value="Austrailia">Australia</option>
			  <option value="USA">USA</option>
			  <option value="England">England</option>
			</select> <br/> <br/> 

			<label> <b> Enter Mobile Number </b> <label> <br/>
			<input type="text" placeholder="Mobile Number" name="contact" required value="<?php echo $contact;?>"> <?php echo "<font size='2px' color='red' face='Arial'>".$contactErr."</font>"; ?> <br><br> <br/> <br/>

			<label> <b> Enter your Address</b> <label>
			<br/> <textarea name="address" cols="40" rows="5" value="<?php echo $address; ?>"> </textarea><br/> <br/>
			
			<label> <b> Favourite Food</b>(Hint in case forgot password) <label>
			<input type="text" placeholder="Fav Food" name="favfood">
			
			<br/> <button type="submit" value="signup" name="signup" onclick="location.href = 'login.php';"> Sign Up </button><br>

			<a href="javascript:window.history.go(-1);"><button type="button"  class="cancelbtn">Cancel</button></a>
		
		</form>
	</body>

</html>

