http://localhost/json/offer.php?mail=suresh@tech-active.com&pass=admin
<?php
error_reporting(0);
include "db/dbconfig.php";
  
	$mail=$_REQUEST['mail'];
	$pass=$_REQUEST['pass'];
	
	//$comid='1';
	$disquery = "SELECT * FROM users WHERE email = '".$mail."' and password = '".$pass."' ";
	
	$disresult = mysql_query($disquery) or die('Errant query:  '.$query);	
	$num_rows = mysql_num_rows($disresult);
	
	//echo $num_rows;
	if($num_rows)
	{
	while($post = mysql_fetch_assoc($disresult))
	{
		$classes[] = $post;
	}	
	
	  header('Content-type: application/json');
	  print(json_encode(array('login'=>$classes)));
	
	}
	else
	{
	  header('Content-type: application/json');
	  print(json_encode(array()));
	}

	
	 $catid=$_REQUEST['catid'];
	 $subname=$_REQUEST['subname'];
	
	$catquery="select * from sub_catgs 	where cat_ref='".$catid."' and subcat_name = '".$subname."' "; 
	
	$catresult = mysql_query($catquery) or die('Errant query:  '.$query);
	$num_rows = mysql_num_rows($catresult);
	 if($num_rows)
	 {
	 while($post = mysql_fetch_assoc($catresult))
	 {
		$classes[] = $post;
	 }
	 {
	  header('Content-type: application/json');
	  print(json_encode(array('catagiries'=>$classes)));
	  }
	  }
	else
	{
	  header('Content-type: application/json');
	  print(json_encode(array()));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>