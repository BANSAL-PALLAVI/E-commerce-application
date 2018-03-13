<?php
	session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="icon" href="/project/images/cf.ico">
	<title>
		Clickfurnish.com
	</title>
	
</head>

<body>
		<?php
			if(!empty($_SESSION['authentication']))
				include 'header_logout.php';
			else
				include 'header.php';
		?>
		<div id="nav_bar">
			<ul>
		   		<li><a href="products.php?cat=tables">Tables</a></li>
		   		<li><a href="products.php?cat=chairs">Chairs</a></li>
		   		<li><a href="products.php?cat=beds">Beds</a></li>
		   		<li><a href="products.php?cat=sofa set">Sofa-set</a></li>
		   		<li><a href="products.php?cat=storage">Storage</a></li>
		   		<li><a href="products.php?cat=Dinning tables">Dining-Tables</a></li>
			</ul>
		</div>
	
		

	
	
		<div class="slideshow">
			<img class="imgbox" src="/project/images/slider/image1.jpg"> 
			<img class="imgbox" src="/project/images/slider/leaves.jpg"> 
			<img class="imgbox" src="/project/images/slider/image5.jpeg"> 
		</div>
		
		<script>
			var myIndex = 0;
			livingRoom();
			
			function livingRoom() {
				var i;
				var x = document.getElementsByClassName("imgbox");
				
				for(i=0; i<x.length; i++){
					x[i].style.display = "none";
				}
				
				myIndex++;
				if(myIndex > x.length) {myIndex = 1}
				x[myIndex-1].style.display = "block";
				setTimeout(livingRoom, 2000);
			}
		</script>
	
	
	
		<div> <!-- first row-->
			<div id="prod1" onclick="location.href='products.php?cat=Dinning tables';" style="cursor: pointer;"> 
				<div class="image">
				<img src="/project/images/home-display/diningtable.jpg"  width="100%" height="280px">
				</div>
				<p id="text" name="Dinning tables">Dinning Tables</p>
				<p id="text" style="font-style:italic">Gather for Fun Stories</p>
				<p id="text">Starting at Rs. 10,000</p>
			</div>
		
			<div id="prod2" onclick="location.href='products.php?cat=tables';" style="cursor: pointer;" >
			<div class="image">
				<img src="/project/images/home-display/table.jpg"  width="100%" height="280px">
				</div>
				<p id="text" name="tables">Tables</p>
				<p id="text" style="font-style:italic">Good Quality Tables</p>
				<p id="text">Starting at Rs. 4,359</p>
				
			</div>
		
			<div id="prod3"> 
			<div class="image" onclick="location.href='products.php?cat=sofa set';" style="cursor: pointer;">
				<img src="/project/images/home-display/sofaset.jpg"  width="100%" height="280px">
				</div>
				<p id="text" name="sofaset" >Sofa Set</p>
				<p id="text" style="font-style:italic">Elegant Living room Sofa Set</p>
				<p id="text">Starting at Rs. 25,000</p>
				
			</div>
		</div>

		<div> <!-- second row-->
			<div id="prod4"> 
				<div class="image" onclick="location.href='products.php?cat=chairs';" style="cursor: pointer;">
				<img src="/project/images/home-display/chair.jpg"  width="100%" height="280px">
				</div>
				<p id="text" name="chair">Chairs</p>
				<p id="text" style="font-style:italic">Comfy Chairs</p>
				<p id="text">Starting at Rs. 1000</p>
			</div>
		
			<div id="prod5"> 
			<div class="image" onclick="location.href='products.php?cat=beds';" style="cursor: pointer;"> 
				<img src="/project/images/home-display/bed.jpg" width="100%" length="300px">
				</div>
				<p id="text" name="beds">Beds</p>
				<p id="text" style="font-style:italic">A Posh Suit</p>
				<p id="text">Starting at Rs. 20,499</p>
			
				
			</div>
		
			<div id="prod6"> 
				<div class="image" onclick="location.href='products.php?cat=storage';" style="cursor: pointer;">
				<img src="/project/images/home-display/storage.jpg"  width="100%" height="280px">
				</div>
				<p id="text" name="storage">Storage</p>
				<p id="text" style="font-style:italic">The Attic</p>
				<p id="text">Starting at Rs. 4,000</p>
			</div>
		
		</div>
		
			
		
		<div id="space" > </div>
		
 		<div id="foot">
			<h3 style="font-family: Arial"> <center>&copy;Clickfurnish.com: All rights reserved. </center> </h3>
			<p> <center> <a href="aboutus.html"> About Us </a> </center> </p>

		</div>	

		
	
	</body>
	
	</html>
