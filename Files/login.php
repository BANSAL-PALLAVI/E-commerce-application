<?php
if(isset($_POST["Login"])){
	$email = $_POST['email'];
	$userPass = $_POST['password'];

	$m = new MongoClient;

	$db = $m->clickfurnish;
	
	$collection = $db->customer;
	
	$cursor = $collection->find(array('Email'=>$email));

	foreach( $cursor as $obj){
		$foundUserN = $obj['Email'];
		$foundUserP = $obj['Password'];
		$customerid=$obj['_id'];
	
		if($foundUserN == $email && $foundUserP == $userPass){
			session_start();
			$_SESSION['Email'] = $email;
			$_SESSION['Password'] = $password;
			$_SESSION['cust_id']=$customerid;
			
			$_SESSION['authentication'] = 1;
			?>
			<script type="text/javascript">
				window.history.go(-2);
					/*if(window.history.go(-2)==window.history.go("signup.php"))
						window.history.go(-3);
					else
						window.history.go(-1);*/
					
			</script>
			<?php
			

		}
		else
		{
			$wrongFlag = 1;
		}
	}
	if($foundUserN != $email)
	{
		echo "<script type='text/javascript'> ";
		echo "alert('Username not registered')";
		echo "</script>";
	}
	if($email=="admin" && $userPass=="admin")
	{

		header("Location: /project/Files/input_product.php");
		
	}
		
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="/project/images/cf.ico">
	<title>Login </title>
</head>
<style>
form {
    border: 3px solid #f1f1f1;
    margin-left : 30%;
    margin-right : 30%;
    margin-top : 5%;
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

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
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
    .cancelbtn {
       width: 100%;
    }
}
</style>

<body>

<h2><center>Login Form<center></h2>

<form action="login.php" method="post">

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" value="Login" name="Login" >Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" onclick="location.href='newhome.php';" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="f_pass.php">password?</a></span>
  </div>
</form>

</body>
</html>

