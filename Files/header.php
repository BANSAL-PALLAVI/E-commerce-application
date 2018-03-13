<!doctype html>
<html>
	<head>
		<style>
			#logobox 
			{
				width: 50%;
				float:left;
				position: absolute;
				top:15px;
				padding:5px;
				
			}

			#loginbox
			{
				padding: 5px;	
				position:absolute;
				top:0px;
				right:180px;
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
			
			#signupbox
			{
				position: absolute;
				top : 0px;
				right : 40px;
				background-color : #cd853f;
				font-weight : bold;
				padding : 3px;
				color: white;
				border : 1px solid #A9A9A9;
				border-radius : 8px;
				width : 130px;
				height : 40px;
				margin-top : 30px;
			}
		
		</style>
	</head>
	
	<body>
		<div>
			<div > <a href="newhome.php"><img id="logobox" src="/project/images/logo-trans.png"></a> </div>
			<a href="login.php"> <input id="loginbox" type="button" value ="Log In" > </a>
			<a href="signup.php"> <input id="signupbox" type="button" value ="Sign Up" > </a>
		<div>
	</body>
</html>
