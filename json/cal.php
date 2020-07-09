
<?php
//http://localhost/json/register.php?mail=sree@tech-active.com&pass=admin&type=1
error_reporting(0);
include "db/dbconfig.php";
header('Content-type: application/json');
$userid=$_REQUEST['userid']; 
$dob=$_REQUEST['dob'];

        /* date dividing  */
		
		if (preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $dob, $matches))
		{
			 $day   = $matches[3];
			 $month = $matches[2];
			 $year  = $matches[1];
		 }			 
      else
	    {
			echo 'invalid format';
			exit;
		}
		//echo $day, $month, $year;
	//	exit;
		
		/* single digit calculation  */
		
		function set_singledigit($tnumber)
		{
			$length = strlen($tnumber);
			$thisvalue='';	
			for ($i=0; $i<$length; $i++) 
			{
				$thisvalue +=$tnumber[$i];		
			}
			if(strlen($thisvalue)==2) $thisvalue =substr($thisvalue, 0, 1)+substr($thisvalue, 1, 1);
			return $thisvalue;
		}		
	
		$a= set_singledigit("$day");
		$b= set_singledigit("$month");
		$c= set_singledigit("$year");
	
		/* caltg  values  */
	   
	   $amask=set_singledigit("$a");
	   
	   $beye=set_singledigit("$a+$b");
	   // echo $eye;  exit;
	   $cKey=set_singledigit("$b+$c");
		
	   $dHandshake=set_singledigit("$b");
	 
	   $eGlobe=set_singledigit("$c");
	  
	   $fCycle=set_singledigit("$a+$b+$c");
	  
	   $gClassroom=set_singledigit("('$a')+('$a+$b+$c')");
	    
	   $hEagle=set_singledigit("('$a+$b')+('$b+$c')");	  
	   //echo $Classroom;  exit;
	   
	  
			$cat_sel= "SELECT * FROM users WHERE  userid ='".$userid."'";    
			
			$cat_selresult = mysql_query($cat_sel) or die('Errant query:  '.$query);
			$row=mysql_fetch_assoc($cat_selresult);
			
			$user_mode= $row['user_mode'];
			
			//echo $user_mode;
			//exit;
			
			$user_num=mysql_num_rows($cat_selresult);					
			//echo  $user_num;
			//exit;			
	if($user_num==1)
			 {		
				  $lgusrsts="SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='a' AND subcat_name ='".$amask."'
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='b' AND subcat_name = '".$beye."' 
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='c' AND subcat_name = '".$cKey."' 
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='d' AND subcat_name = '".$dHandshake."' 
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='e' AND subcat_name = '".$eGlobe."' 
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='f' AND subcat_name = '".$fCycle."' 
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='g' AND subcat_name = '".$gClassroom."' 
				  UNION 
				  SELECT cat_ref,subcat_name,description,positives,negatives FROM sub_catgs WHERE cat_ref ='h' AND subcat_name = '".$hEagle."'";
				  
				// echo $lgusrsts;
				//exit;
				
				/* $lgusrsts="select cat_ref,subcat_name,description,positives,negatives from  sub_catgs where  cat_ref in() and status=1";
				 $lgsts_result=mysql_query($lgusrsts);	
				 $num=mysql_num_rows($lgsts_result);   */
				
				   $cat_res=mysql_query($lgusrsts) or die ('Errant query:  '.$query);						
					
					$e = array(); 
						$e['sucess']='1';
						$e['sucesstxt']='sucess';
						$e['dob']=$dob;
						$e['user_mode']=$user_mode;
						$mesage=json_encode($e);
						$mesage_cut=substr($mesage, 0, -1);
						echo $mesage_cut.',';
					while($result=mysql_fetch_assoc($cat_res))				
					{	                 						
						$classes[] = $result;
					}
					 $category=(json_encode(array('Category'=>$classes)));
					 $category_cut=substr($category, 1, -1);
					 echo $category_cut.'}';
					
					//print(json_encode(array($classes)));

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