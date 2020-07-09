<?php//
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

                   //http://localhost/json/favorite.php?userid=14&tag=1				
					$fav_sel="SELECT a.user_mode as usertype , b.favid as favoriteid, b.fav_dob as dob, b.prf_name as profilename, b.description, b.positives, b.negatives 
									FROM users a, favorites b
											WHERE a.userid='".$userid."' and b.userid='".$userid."'"; 	

					//echo $fav_sel;
					//exit;										
					$fav_res=mysql_query($fav_sel) or die ('Errant query:  '.$query);	
					
					while($result=mysql_fetch_assoc($fav_res))				
					{				
						$classes[] = $result;					
					}
					header('Content-type: application/json');
					print(json_encode(array('catagiries'=>$classes)));
				
				}				  
		
				else if($tagid==2)
				{
				//http://localhost/json/favorite.php?userid=18&catid=a&subid=8&tag=2&dob=2010-10-01
					$favinsert=" Insert into favorites (id,userid,favid,prf_name,fav_dob,description,positives,negatives,date,status) values('','".$userid."','1','aaa','".$dob."','".$desp."','".$pos."','".$neg."','".$curntdate."',1)";			 
					 mysql_query($favinsert);
					// echo  $favinsert;	
					// exit;
					$a = array(); 			
					$a['sucess']='1';
					$a['sucesstxt']='Favorite Inserted';	
					print json_encode($a);
				}
				else if($tagid==3)
				{
					//http://localhost/json/favorite.php?userid=14&favid=2&tag=3
					$favdelete="delete from favorites where userid='".$userid."' and favid='".$favid."' and status=1";			 
					//echo  $favdelete;	
					//exit;
					mysql_query($favdelete);				
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