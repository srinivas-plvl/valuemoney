<?php
//http://localhost/json/register.php?mail=sreee@tech-active.com&pass=admin&type=1&name=sree
error_reporting(0);
include "db/dbconfig.php";

$name=$_REQUEST['name'];
$mail=$_REQUEST['mail'];
$pass=$_REQUEST['password'];
$news=$_REQUEST['news'];
$type=$_REQUEST['type'];

	$user_sel= "SELECT * FROM users WHERE  email ='".$mail."'";    
	$user_selresult = mysql_query($user_sel) or die('Errant query:  '.$query);
	$user_num=mysql_num_rows($user_selresult);
	//echo  $user_num;	
if($user_num==1)
		{	
			$a = array(); 
			//$error='sorry';
			$a['sucess']='0';
			$a['sucesstxt']='Email Already Exists try Some Other';	
			print json_encode($a);
		}
		else
		{		
		     $curntdate=date("Y-m-d H:i:s");		 			
			 $userinsert=" Insert into users (userid,name,email,password,user_mode,user_type,status,login_status,rigister_date) values('','".$name."','".$mail."','".$pass."',0,'".$type."',1,0,'".$curntdate."')";
			 //echo $userinsert;
			// exit;
			 mysql_query($userinsert);
			$a = array(); 
			//$error='sorry';
			$a['sucess']='1';
			$a['sucesstxt']='Registered succesfully';						
			print json_encode($a);					  

		}
		?>