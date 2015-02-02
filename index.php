<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Scrape Yellow Pages</title>


<link href="css/style.css" rel="stylesheet" type="text/css">
  
</head>
<body>
<div><h1 class="header">Yellow Pages Web Scrape</h1></div>

<!--Sets the form to send the information to the create-csv.php script -->
<form action="scripts/create-csv.php" method="post"  class="form-wrapper cf">

	<input type="text" id="keyword" name="keyword" placeholder="Keywords" required>

		<button type="submit" name="submit"  value="search">Search</button>
    
		<br><br><br><br><br><br>

			<input type="text"  style="width: 150px;height: 20px;padding: 10px 5px 10px 5px;
			font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';border: 0;
			background: #eee;-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;
			border-radius: 3px 3px 3px 3px;" id="city" name="city" placeholder="City" required>

   <?php include "scripts/states.php";?>
   
  		 <span>
    			<label for="state" style="font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
    			 vertical-align:basline;">State</label>
                 
			<select name="state" id="state" style="width:auto;height: auto;padding: 10px 5px 10px 5px;
			font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;
     		border-radius: 3px 3px 3px 3px;" required>
                    
	<?php echo StateDropdown('New Hampshire', 'name'); ?>
        
        	</select>
        </span>

</form>

			
			


</body>
</html>