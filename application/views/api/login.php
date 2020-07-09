
<?php
//http://localhost/json/login.php?mail=suresh@tech-active.com&pass=admin
error_reporting(0);
include "db/dbconfig.php";
  
$mail=$_REQUEST['mail'];
$pass=$_REQUEST['pass'];
$type=$_REQUEST['type'];

//$user_id=$_REQUEST["user_id"];
//$user_id='11';
//$user_sel="select * from  users where status=1 and user_id='".$user_id."'";
   
    $user_sel= "SELECT * FROM users WHERE  email ='".$mail."'  and password ='".$pass."' and user_type = '".$type."'";    
	$user_selresult = mysql_query($user_sel) or die('Errant query:  '.$query);
	
	$row=mysql_fetch_assoc($user_selresult);	
    $name= $row['name'];
	$mail= $row['email'];
	$usermode= $row['user_mode'];
	
	$user_num=mysql_num_rows($user_selresult);
	//echo  $user_num;
	
	if($user_num==1)
	 {
			 $lgusrsts="select * from  users WHERE  email ='".$mail."'  and password ='".$pass."' and user_type = '".$type."' and login_status=0";
			 $lgsts_result=mysql_query($lgusrsts);	
			 $num=mysql_num_rows($lgsts_result);
			 // echo $lgsts_result;
					  if($num)
						{
						    $updateusr="update users set login_status='1' where email ='".$mail."'  and password ='".$pass."' and user_type = '".$type."' and  login_status='0'";	
                             
							mysql_query($updateusr);
							$a = array(); 
							//$error='sorry';
							$a['sucess']='1';
							$a['name']=$name;
							$a['email']=$mail;
							$a['type']=$usermode;
							$a['sucesstxt']='Logged in succesfully';						
							print json_encode($a);
						}				  
					 else
						{						
							$a = array(); 							
							$a['sucess']='0';
							$a['sucesstxt']='User already logged in some other mobile';							
							print json_encode($a);
						}

		}
		else
		{
			$a = array(); 
			//$error='sorry';
			$a['sucess']='0';
			$a['sucesstxt']='Invalid Credentials';	
			print json_encode($a);
		}
		?>