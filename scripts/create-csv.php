<?php

include "simple_html_dom.php";

ini_set('max_execution_time', 300); 

//removes white space from input and add + sign in accordance with yp search url
  $keyword=$_POST['keyword'];
  $keyword = preg_replace('/\s+/', '+', $keyword);  
  $city=$_POST['city'];
  $city = preg_replace('/\s+/', '+', $city);  
  $state=$_POST['state'];
  $state = preg_replace('/\s+/', '+', $state);
  
//Send headers to the browser to let it know it will be a csv file  
header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=".$keyword.".csv"); 

//Concatenate the url to match the yp sites url 
$url='http://www.yellowpages.com/search?search_terms='.$keyword.'&geo_location_terms='.$city.'%2C+'.$state;
//Ensure no special characters are in the url 
$url= html_entity_decode($url);

$nextLink = $url;
$fp = fopen('php://output', 'w'); 

//Begin the loop with the beginning url  
while ($nextLink){ 

$html = new simple_html_dom(); 
$html = file_get_html($nextLink);

foreach ($html->find('div.info') as $businessName) {    
 	  foreach ($businessName->find('a.business-name') as $name)	
	  $name=$name->plaintext;	 
		foreach ($businessName->find('span.street-address') as $streetAddress)	
		 $streetAddress=$streetAddress->plaintext;
		 
			foreach ($businessName->find('span.locality') as $city)	
			 $city=$city->plaintext;	
			 			 	
				foreach ($businessName->find("span[itemprop='addressRegion']") as $state)	
				 $state=$state->plaintext;	
				 			
			foreach ($businessName->find("span[itemprop='postalCode']") as $zip)	
				$zip=$zip->plaintext;	
						
		 foreach ($businessName->find('div.phones') as $phone)	
		  $phone=$phone->plaintext;
		  
			
	$td = array($name,$streetAddress,$city,$state,$zip,$phone);	 
  fputcsv($fp,$td); 
  
  //If the crawler finds a link labeled next in the page, it will concatenate the url to run through
  //the loop again with the new page
  $nextLink = (($temp = $html->find("div.pagination a[class='next']",0)) ?"http://www.yellowpages.com".$temp->href : NULL ); 
  //Remove special characters from the url string
$nextLink = html_entity_decode($nextLink);
  }
  
$html->clear();
unset($html);

}

 fclose($fp);
 
 ?>