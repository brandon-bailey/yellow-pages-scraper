 <?php require_once('DB.php'); ?>  
 
 <?php

  include "simple_html_dom.php"; 

  $keyword=$_POST['keyword'];
  $keyword = preg_replace('/\s+/', '+', $keyword);
  
  $city=$_POST['city'];
  $city = preg_replace('/\s+/', '+', $city);
  
  $state=$_POST['state'];
  $state = preg_replace('/\s+/', '+', $state);
    

   $url='http://www.yellowpages.com/search?search_terms='.$keyword.'&geo_location_terms='.$city.'%2C+'.$state;


  
   $url=mysql_real_escape_string($url);

	 
	 $html = new simple_html_dom();
   
	$html = file_get_html($url);
    /////////////////////////////////////////////////////////////
    /// Get adress and business information(also insert to db)///
    /////////////////////////////////////////////////////////////
 
  
foreach ($html->find('div.info') as $dealership) {
	  $new_dealership = $dealership->plaintext;
      foreach ($dealership->find('a.business-name') as $name) 	 
	  		$new_name = $name->plaintext;
     		foreach ($dealership->find('span.street-address') as $streetAddress) 	
				$new_address = $streetAddress->plaintext;   
      			foreach ($dealership->find('span.locality') as $city) 					
					$new_city = $city->plaintext;
      				foreach ($dealership->find("span[itemprop='addressRegion']") as $state) 
						$new_state = $state->plaintext;
						foreach ($dealership->find("span[itemprop='postalCode']") as $zipCode) 
							$new_zip = $zipCode->plaintext;
       						foreach ($dealership->find('div.phones') as $telephone) 	
								$new_phone = $telephone->plaintext;			
															
								
						
		      														
 //Ensure the safety of each input before inserting to DB
$new_name=mysql_real_escape_string($new_name);
$new_address=mysql_real_escape_string($new_address);
$new_city=mysql_real_escape_string($new_city);
$new_state=mysql_real_escape_string($new_state);
$new_zip=mysql_real_escape_string($new_zip);
$new_phone=mysql_real_escape_string($new_phone);
//Insert the safe variables into the database
$insertSQL = sprintf("INSERT INTO dealerships (name,streetAddress,city,state,zipCode,telephone) VALUES ('$new_name','$new_address','$new_city','$new_state','$new_zip','$new_phone')"); 										
mysql_select_db($database_DB, $DB);  
mysql_query($insertSQL, $DB) or die(mysql_error());
	}



		echo "<meta HTTP-EQUIV='REFRESH' content='0; url=../index.php'>";
	 
 ?>