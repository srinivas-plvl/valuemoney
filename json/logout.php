
<?php
//http://localhost/json/logout.php?userid=2&mail=suresh@tech-active.com
error_reporting(0);

include "db/dbconfig.php";

$userid=$_REQUEST['userid'];
$mail=$_REQUEST['mail'];

//$user_id=$_REQUEST["user_id"];
//$user_id='11';
//$user_sel="select * from  users where status=1 and user_id='".$user_id."'";
   
    $user_sel= "SELECT * FROM users WHERE  email ='".$mail."' and userid='".$userid."' and login_status=1";    
	$user_selresult = mysql_query($user_sel) or die('Errant query:  '.$query);
	$user_num=mysql_num_rows($user_selresult);
	//echo  $user_sel;
	//exit;	
	if($user_num==1)
		{					
			 $userupdate="update users set login_status='0' WHERE  email ='".$mail."' and userid='".$userid."' and status=1";    
			//echo $userupdate;
			//exit;
			 mysql_query($userupdate);
			$a = array(); 
			//$error='sorry';
			$a['sucess']='1';
			$a['sucesstxt']='logout succesfully';						
			print json_encode($a);	
		}
		else
		{		
		  $a = array(); 
			//$error='sorry';
			$a['sucess']='0';
			$a['sucesstxt']='User not signed in';	
			print json_encode($a);
		}
		?>