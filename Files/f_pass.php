<?php
	if(isset($_POST["fpass"])){
	$fp = $_POST['fp'];
	$email=$_POST['id'];
	
	$m = new MongoClient;

	$db = $m->clickfurnish;
	
	$collection = $db->register;

	$cursor = $collection->find(array('Email'=>$email));
	echo 'hi';

	foreach( $cursor as $obj){
		$foundUserN = $obj['Fav Food'];
	
		if($foundUserN == $fp){
			session_start();
			$_SESSSION['Email'] = $email; 
			header("Location: newpass.php");

		}
		else
		{
			$wrongFlag = 1;
		}
	}
	if($foundUserN != $email){
		echo "<br>Username not registered";}
		
}
?>


<!doctype>
<html>
	<head> 
		<link rel="stylesheet" type="text/css" >
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
		<h2> <center> Forgot password </center></h2>
		<form method="POST" action="f_pass.php">

			<label> <b> Enter your mail id</b> <label>
			<input type="text" name="id" required > <br><br>
			
			<label> <b> What is your fav. food ?</b> <label>
			<input type="text" name="fp" required > <br><br>
			
			<br/> <button type="submit" value="signup" name="fpass"> Next </button><br>
				
		</form>
	</body>

</html>

