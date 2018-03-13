<?php
	if(isset($_POST["newpass"])){
	$np = $_POST['np'];
	session_start();
	$email=$_SESSION['Email'];
	$m = new MongoClient;
	$db = $m->clickfurnish;
	$collection = $db->register;
	if($collection->update(array('Email'=>$email),array('$set'=>array('Password'=>$np)))){
		header("Location: login.php");	
	}
	}
	
?>
<!doctype>
<html>
	<head> 
		<link rel="stylesheet" type="text/css" >
		<link rel="icon" href="/project/images/cf.ico">
		<title>Set new password </title>
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
		<h2> <center> New Password </center></h2>
		<form method="POST" action="newpass.php">

			
			<label> <b> New Password</b> <label>
			<input type="password" name="np" required > <br><br>
			
			<br/> <button type="submit"  name="newpass"> Set New Password </button><br>
				
		</form>
	</body>

</html>

