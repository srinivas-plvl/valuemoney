<?php
//http://localhost/json/update.php?userid=14&mail=sreee.plvl@gmail.com&pass=sreee&name=sree
error_reporting(0);

include "db/dbconfig.php";

$userid=$_REQUEST['userid'];
$name=$_REQUEST['name']; 
$mail=$_REQUEST['mail'];
$pass=$_REQUEST['pass'];


//$user_id=$_REQUEST["user_id"];
//$user_id='11';
//$user_sel="select * from  users where status=1 and user_id='".$user_id."'";
   
    $user_sel= "SELECT * FROM users WHERE  email ='".$mail."' and userid='".$userid."' and status=1";    
	$user_selresult = mysql_query($user_sel) or die('Errant query:  '.$query);
	$user_num=mysql_num_rows($user_selresult);
	 
	 echo  $user_sel;
     exit;	
	
	if($user_num==1)
		{					
			 $userupdate="update users set password='".$pass."' WHERE  email ='".$mail."' and userid='".$userid."' and status=1";    
			 //echo $userupdate;
			//exit;
			 mysql_query($userupdate);
			$a = array(); 
			//$error='sorry';
			$a['sucess']='1';
			$a['sucesstxt']='updated succesfully';						
			print json_encode($a);	
		}
		else
		{		
		  $a = array(); 
			//$error='sorry';
			$a['sucess']='0';
			$a['sucesstxt']='User details not valid';	
			print json_encode($a);
		}
		?>