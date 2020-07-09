<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class User_model extends CI_Model
   {

	function userlogin($uname,$pwd)
	{		
		$query =$this->db->query("SELECT * FROM login WHERE username = '$uname' AND password = '$pwd' AND status = 1");
		if($query->num_rows == 1)
			{
				$row = $query->row();
				$usersession = array(   					   
					   'name' => $row->name,
					   'email' => $row->email,					   
					   'username' => "username",
					   'password' => "password",
					   //'sendsms'=>$row->send_sms,
	                   'user_logged_in' => TRUE,
					);
				 $this->session->set_userdata($usersession);
				 
				 return "valid";
			}
				else
			{
			return "invalid";
	        }
    }
	function check_user_forpassword($email)
	{
		$this->db->where('email',$email);
		$res  = $this->db->get('login');
		return $res->num_rows;
	}
	
	function get_fn($email)
	{
		$this->db->where('email',$email);
		$res  = $this->db->get('login');
		return $res->row()->name;
	}
	
	function update_password($email,$encode)
	{
		$data = array('password'=>$encode);
		$this->db->where('email',$email);
		$this->db->update('login',$data);
	}
	function get_productgroup($category)
	{
		$query = $this->db->query("select * from users");
  		return $query->result();
	}
	
	function users()
	{
		$query = $this->db->get("users");
		return $query->result();
	}
	
	function user_catgs()
	{
	    $data = array();
		$data["all"]="All";
		$data[0] = "Free User";
		$data[1] = "Paid User";		
		return $data;
	}
	function user_type()
	{
	$data= array();
	$data["all"]="All";
	$data["0"]="Web Users";
	$data["1"]="Android Users";	
	$data["2"]="Iphone Users";	
	return $data;
	}
	function catgdesp()
	{			
		$this->db->order_by("rate","asc");
		$q = $this->db->get_where('num_catgs');
		return $q->result();
	}
	
	function get_user_catgs($cattype="")
	{
		if($cattype=="all")
		{
			$res = $this->db->get('users');			
		}
		else
		{
			$this->db->where('user_type',$cattype);
			$res = $this->db->get('users');	
           // echo $this->db->last_query();		
		}		
		return $res->result();		
	}
				
	function select_ajax()
	{		
		  
	  $query = $this->db->get_where('sub_catgs',array("cat_ref"=>$this->input->post("cat"),"subcat_name"=>$this->input->post("sub_cat"),'status'=>1));
	  
	 // echo $this->db->last_query();
	  $row = $query->row();
	  $positive = $row->positives;
	  $negative = $row->negatives;
	  $description = $row->description;
	  return $description."*". $positive."*".$negative;
	}
	function get_user_update($cat,$sub_cat,$desc,$pos,$neg,$id)
	{	
	  /*$query = $this->db->query("select * from users");	
	  $this->db->where('cat_id', $cat);			  
	  $this->db->update('num_catgs',array("positive"=>$pos,"description"=>$desc,"negatives"=>$neg));
	  return true;	*/
	   
	//$this->db->query("UPDATE num_catgs SET description = '$desc', positive = '$pos', negatives = '$neg',  WHERE cat_id = '$cat',sub_id='$sub_cat'");
		$data = array("positives"=>$pos,"negatives"=>$neg,"description"=>$desc);
		$this->db->update("sub_catgs",$data,array("cat_ref"=>$id,"subcat_name"=>$sub_cat));
		
	 //  $this->db->query("UPDATE sub_catgs SET positives = '$pos', negatives = '$neg', description = '$desc'  WHERE cat_ref = '$cat_id' AND subcat_name=$sub_cat ");
	  return true;	
		  
	}
	
	function get_order_update($sub_cat)
	{	
		foreach($sub_cat as $key => $value)
		{
			$data = array('rate'=>$value);
			$this->db->update('num_catgs',$data,array("cat_id"=>$key));
		}
		
		return true;	
	}
	function get_user_payments($catmode="", $cattype="")
		{
				if($catmode != "all" && $cattype !="all")
			 {
				$this->db->where('user_mode',$catmode);
				$this->db->where('user_type',$cattype);						
			 }
			 else if($catmode == "all"  && $cattype != "all")
			 {
			  $this->db->where('user_type',$cattype);
			 }
			 else if($catmode != "all" && $cattype == "all")
			 {
			   $this->db->where('user_mode',$catmode);
			 }
			 $res = $this->db->get('users');
			return $res->result();
			//print_r ($res);
			//echo $this->db->last_query();
				
		}
	function get_mails($cattype="")
	{
		if($cattype == "all")
		 {				
		  $query = $this->db->query("select email from users");		
		 }
		 else if($cattype != "all")
		 {
			$query = $this->db->query("select email from users where user_type='$cattype'");			
		 }			 	

		$allemails= $query->result();
		$data='';
		$allemail='';
		foreach($allemails as $type)
		{
			$data1 = $type->email;
			$allemail.=$data1.",";
		}			
		return $allemail;	
	}
	
	function get_tabname($id)
	{
		$res = $this->db->get_where("num_catgs",array("cat_id"=>$id));
		return $res->row()->cat_name;
	}
}
?>
	