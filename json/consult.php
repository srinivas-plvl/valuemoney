
<?php
//http://localhost/json/update.php?userid=14&mail=sree.plvl@gmail.com&pass=sreee
error_reporting(0);

include "db/dbconfig.php";

$userid=$_REQUEST['userid'];
$name=$_REQUEST['name']; 
$mail=$_REQUEST['mail'];
$mobile=$_REQUEST['mobile'];
$dob=$_REQUEST['dob'];

   
    $user_sel= "SELECT * FROM contacts WHERE  email ='".$mail."' and userid='".$userid."' and status=1 ";    
	$user_selresult = mysql_query($user_sel);
	$user_num=mysql_num_rows($user_selresult);
	//echo  $user_num;
	//exit;	
	if($user_num)
		{	
             $a = array(); 
			//$error='sorry';
			$a['sucess']='0';
			$a['sucesstxt']='User details already existed';	
			print json_encode($a);			
		}
		else
		{		
		      $curntdate=date("Y-m-d H:i:s");		 			
		      $userinsert="Insert into contacts (userid,name,email,mobile,dob,status,date) values('".$userid."','".$name."','".$mail."','".$mobile."','".$dob."',1,'".$curntdate."')";
			  //echo $userinsert;
			 // exit;
			 mysql_query($userinsert);
			$a = array(); 
			//$error='sorry';
			$a['sucess']='1';
			$a['sucesstxt']='updated succesfully';						
			print json_encode($a);	
		}
		?>