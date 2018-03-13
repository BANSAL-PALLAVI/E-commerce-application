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
			#logoutbox
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
			
			#cart
			{
				
				margin-left:83%;
				margin-top:26px;
			}
			a:hover
			{
				background-color:#ffe6e6;
			}
			
		
		</style>
	</head>
	
	<body>
		<div>
			<div > <img id="logobox" src="/project/images/logo-trans.png"> </div>
			<div id="cart"><a href="cart_wishlist.php"><img src='/project/images/cart.png' height="40px"	width="40px"></a></div>
			<a href="logout.php"> <input id="logoutbox" type="button" value ="Log out" > </a>
			
			
		<div>
	</body>
</html>
