<?php
	session_start();
	$email = $_SESSION['Email'];
	
	$m = new MongoClient();
	$db = $m->clickfurnish;
	$collection = $db->customer;
	$cursor = $collection->find(array('Email'=>$email));
	
	foreach($cursor as $obj)
		$foundUserN = $obj['Email'];
		
		if($foundUserN == $email)
	
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

#logoutbox
			{
				padding: 5px;	
				position:absolute;
				top:0px;
				right:100px;
				background-color :#cd853f;
				font-weight : bold;
				padding : 3px;
				color: white;
				border : 1px solid #a9a9a9;
				border-radius : 8px;
				width : 130px;
				height : 40px;
				margin-top : 30px;
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

#div1{
	margin-top : 130px;
}

#logobox 
	{
		width: 50%;
		height: 75px;
		float:left;
		position: absolute;
		top:0;
		padding:5px;
		z-index: 100;
	}
#prof{
	
	float : left;
}
#profile{
	margin-left : 0px;
position : absolute;
}

#space {
		width: 100%;
		height: 100px;
		position: relative;
		/*margin-top: 5%;*/
		clear: left;

		
	}


#foot {
	background-color: black;
	color: white;
	height :120px;
	width: 100%;
	clear: left;
	padding-top:2%;
}

</style>
</head>
<body>


<div id="logobox"> <a href="newhome.php"><img src="/project/images/logo-trans.png"></a> </div>
<a href="logout.php"> <input id="logoutbox" type="submit" value ="Log Out" > </a>
<div id=div1>
	<ul>
  		<li><a class="active" href="cart_profile.php">Profile</a></li>
  		<li><a href="cart_wishlist.php">Wishlist</a></li>
  		<li><a   href="cart_orders.php">Orders</a></li>
	</ul>
</div>
	<h2><center>User Profile</center></h2><br>
	<div id="prof">
		
		
		
		<div class="container">
  <h2>Details</h2>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Name</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body"><?php echo $obj['Firstname']." ".$obj['Lastname']; ?></div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Email and Contact info</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $obj['Email']; ?></div>
        <div class="panel-body"><?php echo $obj['Contact']; ?></div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Address</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $obj['Address'].", ".$obj['Country']; ?></div>
      </div>
    </div>
  </div> 
</div>
		
		
		

		
	</div>
	
		<img id="profile" src="/project/images/images.png">
		
		<div id="space" > </div>
		
 		<div id="foot">
			<h3 style="font-family: Arial"> <center>&copy;Clickfurnish.com: All rights reserved. </center> </h3>
			<p> <center> <a href=#> Contact Us </a> </center> </p>

		</div>	

</body>
</html>

