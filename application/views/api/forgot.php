<?php
//http://localhost/json/login.php?mail=suresh@tech-active.com
error_reporting(0);
include "db/dbconfig.php";
  
$mail=$_REQUEST['mail'];


//$user_id=$_REQUEST["user_id"];
//$user_id='11';
//$user_sel="select * from  users where status=1 and user_id='".$user_id."'";
   
    $user_sel= "SELECT * FROM users WHERE  email ='".$mail."'  and status ='1'";    
	$user_selresult = mysql_query($user_sel) or die('Errant query:  '.$query);
	
	$user_num=mysql_num_rows($user_selresult);
	 $row=mysql_fetch_assoc($user_selresult);	
	  $email=$row['email'];
	  $pass=$row['password'];
	   //echo  $pass;	
	if($user_num==1)
	{
		$subject= 'Your password is successfully reset';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= "From: <".$from_email.">\r\n" ; 
    'X-Mailer: PHP/' . phpversion();
		$message  ="<div style='width:640px;margin:0 auto;padding:10px 10px 20px;height:46px;'><a href='https://buzoonga.co.uk' style='float:left'><img src='https://buzoonga.co.uk/assets/themes/common/logo.jpg' alt='LOGO'/></a><h3 style='float:right;font-family:Arial,Helvetica,sans-serif;'>Forgot Password</h3></div>
	   <div style='font:14px Arial,Helvetica,sans-serif;width:600px;margin:0 auto;padding:18px;border:2px solid #d3d3d3;color:#6A6A6A;clear:both;background:#f3f3f3'> 
         <span style='color:#000;'><b>Dear ".$name.";</b></span> <br/>
         <p>Your Password was successfully reset. Please find the new password below.</p>
         
         <p style='margin:5px'>Password    : ".$pass."</p>
         <p>&nbsp;</p>
         <p style='margin:5px;color:#000'>Regards</p>
         <p style='margin:5px;color:#000'>Buzoonga Team</p>
      </div>";
	mail($email, $subject, $message, $headers);
	// update password start
	//$pass_update="UPDATE users SET password=md5($pass) WHERE email=$email";
	//echo $pass_update;
	//mysql_query($pass_update);
	//update password End
		$a = array(); 
	//$error='sorry';
	$a['sucess']='1';
	$a['sucesstxt']='A new password has been emailed to you.';
	print json_encode($a);			
		}			
	else
	{
	$a = array(); 
	//$error='sorry';
	$a['sucess']='0';
	$a['sucesstxt']='Invalid email. Please re-try with a valid email.';
	print json_encode($a);
	}
?>
