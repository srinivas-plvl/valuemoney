
<?php
//http://localhost/json/login.php?mail=suresh@tech-active.com&pass=admin
error_reporting(0);
include "db/dbconfig.php";
  
///$mail=$_REQUEST['mail'];
$dob=$_REQUEST['dob'];
$userid=$_REQUEST['userid'];
$cat=$_REQUEST['catid'];
$sub=$_REQUEST['subid'];

//$user_id=$_REQUEST["user_id"];
//$user_id='11';
//$user_sel="select * from  users where status=1 and user_id='".$user_id."'";
   
		$user_sel= "SELECT * FROM users WHERE  userid ='".$userid."' and status = '1'"; 
		$user_result=mysql_query($user_sel) or die ('Errant query:  '.$query);
		$row=mysql_fetch_assoc($user_result);			
		$mode= $row['user_mode'];
		$dob= $row['dob'];
		//echo $mode;
		//exit;
		
		
		$cat_sel= "SELECT * FROM sub_catgs WHERE  cat_ref ='".$cat."'  and subcat_name ='".$sub."' and status = '1'"; 
		$cat_selresult = mysql_query($cat_sel) or die('Errant query:  '.$query);		
		$row=mysql_fetch_assoc($cat_selresult);			
		$desp= $row['description'];
		$pos= $row['positives'];
		$neg= $row['negatives'];		
		//echo $dsesp;
		//exit;
		$cat_num=mysql_num_rows($cat_selresult);
		//echo  $cat_num;	
		//exit;
		
		
		
	if($cat_num)
		{
			//$updateusr="update users set login_status='1' where email ='".$mail."'  and password ='".$pass."' and user_type = '".$type."' and  login_status='0'";	
			 
			//mysql_query($updateusr);
			$a = array(); 
			//$error='sorry';
			$a['sucess']='1';
			$a['dob']=$dob;
			$a['mode']=$mode;	
			$a['cat']=$cat;
			$a['sub']=$sub;
			$a['description']=$desp;
			$a['positives']=$pos;
			$a['negatives']=$neg;
			$a['sucesstxt']='details sent succesfully';						
			print json_encode($a);
		}				  

		else
		{
			$a = array(); 
			//$error='sorry';
			$a['sucess']='0';
			$a['sucesstxt']='An error';	
			print json_encode($a);
		}
		?>