
<?php
//http://localhost/json/login.php?mail=suresh@tech-active.com&pass=admin
error_reporting(0);
include "db/dbconfig.php";
  
///$mail=$_REQUEST['mail'];
$dob=$_REQUEST['dob'];
$userid=$_REQUEST['userid'];
$cat=$_REQUEST['catid'];
$sub=$_REQUEST['subid'];
$tagid=$_REQUEST['tag'];
$favid=$_REQUEST['favid'];
		
		$cat_sel= "SELECT * FROM sub_catgs WHERE  cat_ref ='".$cat."'  and subcat_name ='".$sub."' and status = '1'"; 
		$cat_selresult = mysql_query($cat_sel) or die('Errant query:  '.$query);		
		$row=mysql_fetch_assoc($cat_selresult);		
		
		$desp= $row['description'];
		$pos= $row['positives'];
		$neg= $row['negatives'];		
		$cat_num=mysql_num_rows($cat_selresult);
		//echo  $cat_num;	
		//exit;
	  if(cat_num)
	  {
     	$usr_sel="select * from users  where  userid='".$userid."' and  status=1";
		//echo $usr_sel;
		//exit;
		$user_res=mysql_query($usr_sel) or die ('Errant query:  '.$query);
		$row=mysql_fetch_assoc($user_res);
		
		$mode= $row['user_mode'];
		$dob= $row['dob'];
		
		//echo $mode;
		//exit;
		
	    if($tagid==1)
		{			
				$fav_sel="select * from  favorites where  userid='".$userid."' and status=1"; 				
				//echo $fav_sel;
				//exit;
				
				$fav_res=mysql_query($fav_sel) or die ('Errant query:  '.$query);				
				$row=mysql_fetch_assoc($fav_res);

			      while($row = mysql_fetch_array($fav_res)){
                 $dlink[] = $row['*'];
				 echo $dlink;
				 exit;
				 }
				
				$prfname= $row['prf_name'];
				$favid= $row['favid'];
				$favdob= $row['fav_dob'];
				//echo $favdob;
			   //exit;
				$a = array(); 
				//$error='sorry';
				$a['sucess']='1';
				$a['dob']=$favdob;
				$a['mode']=$mode;	
				$a['cat']=$cat;
				$a['sub']=$sub;
				$a['description']=$desp;
				$a['positives']=$pos;
				$a['negatives']=$neg;
				$a['sucesstxt']='details sent succesfully';						
				print json_encode($a);
		}				  

		else if($tagid==2)
		{
		
		    $favinsert=" Insert into favorites (id,userid,favid,prf_name,fav_dob,description,positives,negatives,date,status) values('','".$userid."','1','aaa','".$dob."','".$desp."','".$pos."','".$neg."','".$curntdate."',1)";			 
			 mysql_query($favinsert);
			// echo  $favinsert;	
			// exit;
			$a = array(); 			
			$a['sucess']='1';
			$a['sucesstxt']='Favorite Inserted';	
			print json_encode($a);
		}
			else
		{
		
		    $favdelete="delete from favorites where userid='".$userid."' and favid='".$favid."' and status";			 
			 mysql_query($favdelete);
			// echo  $favinsert;	
			// exit;
			$a = array(); 
			//$error='sorry';
			$a['sucess']='1';
			$a['sucesstxt']='Favorite deleted';	
			print json_encode($a);
		}
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