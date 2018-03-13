<?php
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 5*1024*1024; //100 kb
$path = "/var/www/html/"; // Upload directory
$count = 0;

if(isset($_POST['submit']) )
{
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) 
	{     
	    if ($_FILES['files']['error'][$f] == 4) 
	    {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) 
	    {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) 
	        {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) )
			{
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else
	        { // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$_FILES['files']['name']))
	            {
	            	echo "success";
	            	$count++; 
	            	
	            }// Number of successfully uploaded file
	        }
	    }
	}
}
	    ?>
	    <!doctype html>
	    <html>
	    <body>
	    <form method="POST" action="test.php" enctype="multipart/form-data">
	    Upload Images : <br>
		<input type="file" name="files[]" id="fileToUpload" multiple="multiple"><br><br>
		<button type="submit" name="submit" value="submit">Submit</button>
		</form>
		</body>
		</html>
