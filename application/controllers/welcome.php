<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
   
   function staticdata()
	{		
		$data['header']='content/header';		
		$data['footer']='content/footer';			
		return $data;
	}
	public function index()
	{		

		    $data['page'] = "login";
			$data['status'] = "";
			$data['pagetitle'] = 'Login';
			$data['user_email'] = "";
			$data['user_password'] = "";
			if($this->session->userdata('user_logged_in'))
			{
			redirect('welcome/number');
			}
			if($this->input->post('btn_sbt'))
			{
			$uname=$this->input->post('login_name');
			$pwd=$this->input->post('login_password');	
			$login=$this->user_model->userlogin($uname,$pwd);			
			if($login == 'valid')		
			redirect('welcome/number', $data);
			else 
			{									
				$data['status']="<p class='error'>The email /password field must be valid</p>";
				$data['user_email']=trim($this->input->post('username'));
				$data['user_password']='';
			}
			}	            	
	        $this->load->view('login',$data);
	    }	
	
		function logout()
		{	
			$usersession = array(
   					   'userid'   => "",
	                   'usertype'  =>"",	                  
	                   'sendsms'  => "",	                  
					   'companyid' => "",
					   'fn' => "",					
					   'mobile' => "",
					   'company' => "",
	                   'user_logged_in' => FALSE,
				);
		$this->session->unset_userdata($usersession);		
		//$this->session->sess_destroy();					
		redirect('welcome');	
		}
	function number()
	{	 
     	if(!$this->session->userdata('user_logged_in')){redirect('welcome/index');}	
	    $data=$this->staticdata();
	    $data['pagetitle'] = 'Number Category';	
        $data['page'] = "number";		
	    $data['description'] = $this->user_model->catgdesp();	
	    $data['content']='content/number';	
	    $this->load->view('welcome',$data);
	}	
	function number_inner($id="",$cat_id="", $cat_name="")
	{	   
	    if(!$this->session->userdata('user_logged_in')){redirect('welcome/index');}	
	    $data=$this->staticdata();
	    $data['pagetitle'] = 'Number Category';		
	    $data['description'] = $this->user_model->catgdesp();	
	    $data['content']='content/numberinner';
	    $data['subcat']= $this->drop_subcat();
	    $data['tabval']= $this->user_model->get_tabname($id);
	    $data['id']=$id;
		$data['page'] = "number";
		$data['cat_id']=$cat_id;
	    $data['catname']=$cat_name;
		$data['sub_radio']= $this->drop_radio();
	    $this->load->view('welcome',$data);
	}
	
	function drop_subcat()
	{
		$data = array(""=>"Select","1"=>1,"2"=>2,"3"=>3,"4"=>4,"5"=>5,"6"=>6,"7"=>7,"8"=>8,"9"=>9);
		return $data;
	}	
	function drop_radio()
	{
		$data = array(""=>"radio","1"=>1,"2"=>2,"3"=>3,"4"=>4,"5"=>5,"6"=>6,"7"=>7,"8"=>8,"9"=>9);
		return $data;
	}
	
	function getnuemerology()
	{	   
		$res = $this->user_model->select_ajax();
		echo $res;
	}		
	function news()
	{  
		if(!$this->session->userdata('user_logged_in')){redirect('welcome/index');}	
		$data=$this->staticdata();
	   $data['pagetitle'] = "News Letter";
        $data['page'] = "news";	   
	   $data['content']='content/news';	
	   $data['user_type'] = $this->user_model->user_type();
	   $this->load->view('welcome',$data);	
	}
	function accounts()
	{	
	   $data=$this->staticdata();	
	   $data['pagetitle'] = "Payments";	  
	   $data['page'] = "accounts";	   
	   $data['users'] = $this->user_model->users();
	   $data['user_catgs'] = $this->user_model->user_catgs();	 
	   $data['user_type'] = $this->user_model->user_type(); 
	   $data['content']='content/accounts';	
	   $this->load->view('welcome',$data);
	}
	function users()
	{
		if(!$this->session->userdata('user_logged_in')){redirect('welcome/index');}	
	    $data=$this->staticdata(); 
	   $data['users'] = $this->user_model->users();
	   $data['user_catgs'] = $this->user_model->user_catgs();	 
	   $data['user_type'] = $this->user_model->user_type();
	   $data['pagetitle'] = "Users"; 
	   $data['page'] = "accounts";
	   $data['content']='content/users';	
	   $this->load->view('welcome',$data);	 
	}	
	function catg_users()
	{		    
		$data['cattype'] = $this->input->post("cattype");
		$res = $this->user_model->get_user_catgs($data['cattype']);
		$data['users'] = $res;
		$data['page'] = "accounts";	
        $data['user_type'] = $this->user_model->user_type();
		$this->load->view('content/dynamic',$data);	 			
	}
	function payments()
	{		    
		$data['catmode'] = $this->input->post("catmode");			
		$data['cattype'] = $this->input->post("cattype");	
		$data['user_catgs'] = $this->user_model->user_catgs();	 
		$data['user_type'] = $this->user_model->user_type();	 
		$res = $this->user_model->get_user_payments($data['catmode'],$data['cattype']);
		$data['users'] = $res;	
        $data['page'] = "accounts";		
		$this->load->view('content/payments',$data);	 			
	}
	
	function tabs()
	{
		if(!$this->session->userdata('user_logged_in')){redirect('welcome/index');}	
	   $data=$this->staticdata();	   
	   $data['content']='content/tabs';
	   $data['pagetitle'] = "Accounts Details"; 	   
	   $data['users'] = $this->user_model->users();
	   $data['user_catgs'] = $this->user_model->user_catgs();	 
	   $data['user_type'] = $this->user_model->user_type();	 
	   $this->load->view('welcome',$data);	 
	}
	
	function catg_activate($id='', $status='')
	{	
		if($status==0)
		{ 
		     $updata = array( 'status' =>1);			                      			
		}
		else
		{
			$updata = array( 'status' =>0);			
		}
			$this->db->where('id',$id);	  
			$res=$this->db->update('num_catgs',$updata);
	  
		//echo $this->db->last_query();exit;
	     if($res!=''){
	     $this->session->set_flashdata('success','<ul class="homesuccess"><li>Group Activated for Campaign</li></ul>');
	     redirect('welcome/number/');
	  } 
	  else{
	   $this->session->set_flashdata('success','<ul class="homefailed"><li>Group is not activated!</li></ul>');
	   redirect('welcome/number/');
	  }  
    }
	function updatenumbers($id="")
	{		    
		$cat = $this->input->post("cat");			
		$sub_cat = $this->input->post("sub_cat");			
		$desc = $this->input->post("desc");			
		$pos = $this->input->post("pos");			
		$neg = $this->input->post("neg");	
		//echo $sub_cat;
		$res = $this->user_model->get_user_update($cat,$sub_cat,$desc,$pos,$neg,$id);			
		if($res) {
				 $this->session->set_flashdata('success','successfully  updated');
				 redirect("welcome/number_inner/$id");
			}
		else{
			$this->session->set_flashdata('success','Update failed');
			redirect("welcome/number_inner/$id");
			}
	}
		function insertnumbers($id="")
	{		    
		$cat = $this->input->post("cat");			
		$sub_cat = $this->input->post("sub_cat");			
		$desc = $this->input->post("desc");			
		$pos = $this->input->post("pos");			
		$neg = $this->input->post("neg");	
		//echo $sub_cat;
		$res = $this->user_model->get_num_insert($cat,$sub_cat,$desc,$pos,$neg,$id);			
		if($res) {
				 $this->session->set_flashdata('success','successfully  inserted');
				 redirect("welcome/number_inner/$id");
			}
		else{
			$this->session->set_flashdata('success','insert failed');
			redirect("welcome/number_inner/$id");
			}
	}
	
	function order()
	{		  
			
		$sub_cat=$this->input->post("sub_cat");				
		$res = $this->user_model->get_order_update($sub_cat);			
		if($res) 
		{
		 $this->session->set_flashdata('success','successfully  updated');
		 redirect('welcome/number');
		}
		else{
			$this->session->set_flashdata('success','Update failed');
			redirect('welcome/number');
			}
	}
		
	function newsmail()
	{	  
		if(!$this->session->userdata('user_logged_in')){redirect('welcome/index');}		
		$subject=$this->input->post("subject");				
		$message=$this->input->post("message");				
		$cattype=$this->input->post("cattype");				
		//$emailid='info@winkkey.com';	
		$emailid='srinivas.plvl@gmail.com';	
		$today = date("F j, Y, g:i a"); 
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$tonames = $this->user_model->get_mails($cattype);			
		if($tonames!='') 
		{
		$message_body  ="<html><body style='background:#DEDEDE; width:100%;font-family:calibri'>";
		$message_body .="<div style='width: 100%; background: none repeat scroll 0px 0px rgb(222, 222, 222);'>";		
		$message_body .='<table  width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100.0%;padding-top:2%;padding-bottom:1%;padding-left:20%;padding-right:20%;">';
		$message_body .='<tbody style="background: none repeat scroll 0 0 #FFFFFF;font-family:calibri">';		
		$message_body .='<tr><td style="color:#666;padding: 0 3%;font-family:calibri;font-size:15px;"> $message </td></tr>';	
		
		$message_body .='<tr><td style="color:#666;padding: 0 3%;font-family:calibri;font-size:15px;">Kind Regards,</td></tr>';	
		$message_body .='<tr><td style="color:#666;padding: 0 3%;font-family:calibri;font-size:15px;">The Winkkey Team.</td></tr>';	
		    
		//echo $message_body."<br/>";
		//echo $emailid."<br/>";	
		//echo $tonames."<br/>";	
		//exit;
			
		   $config['mailtype']="html";  
		   $this->email->initialize($config); 
		   $this->email->from($emailid);
		   $this->email->to($emailid);
		   $this->email->cc("srinivas@tech-active.com"); 			   
		   $this->email->bcc($tonames);			   
		   $this->email->subject($subject);
		   $this->email->message($message_body);			 
		   if($this->email->send())
		   { 				
			$this->session->set_flashdata('success',"<ul  style='list-style:none'><li style='font-size:12px;text-align:left'>Message successfully sent</li></ul>");
			redirect('welcome/news');
		   }
		   else
		   {
			$this->session->set_flashdata('success',"<ul  style='list-style:none'><li style='font-size:12px;text-align:left'>Message not send</li></ul>");
			redirect('welcome/news');
		   }
		}
		else
		{
			$this->session->set_flashdata('success','no Emails');
			redirect('welcome/news');
		}
		//$this->load->view('content/news',$data);	
	}
	function user_activate($id='', $status='')
	{	
		if($status==0)
		{ 
		     $updata = array( 'status' =>1);			                      			
		}
		else
		{
			$updata = array( 'status' =>0);			
		}
			$this->db->where('userid',$id);	  
			$res=$this->db->update('users',$updata);
	  
		//echo $this->db->last_query();exit;
	     if($res!=''){
	     $this->session->set_flashdata('success','<ul class="homesuccess"><li>Group Activated for Campaign</li></ul>');
	     redirect('welcome/users/');
	  } 
	  else{
	   $this->session->set_flashdata('success','<ul class="homefailed"><li>Group is not activated!</li></ul>');
	   redirect('welcome/users/');
	  }  
    }
	function forgotpassword()
		{
			$email = $this->input->post('forgot_email');
			$user = $this->user_model->check_user_forpassword($email); 
			if($user == 1)
			{
				$rand  = base64_encode(rand(100000,999999));
				$encode = substr($rand,0,8);
				
				$fn = $this->user_model->get_fn($email);
				$this->user_model->update_password($email,$encode);
				//echo $encode;
				//exit;
				$this->session->set_flashdata('success','<p class="error" style="color:green">Please check your email address for password</p>');
				//$username=$user_login['name'];				 			
					$regmessage="						
						<div style='width:640px;margin:0 auto;padding:10px 10px 20px;height:46px;'><a href='".base_url()."' style='float:left'><img src='".base_url()."assets/img/green.png' alt='LOGO'/></a><h3 style='float:right;font-family:Arial,Helvetica,sans-serif;'>Forgot Password</h3></div>
						<div style='font:14px Arial,Helvetica,sans-serif;width:600px;margin:0 auto;padding:18px;border:2px solid #d3d3d3;color:#6A6A6A;clear:both;background:#f3f3f3'>	
								<span style='color:#000;'><b>Dear ".$fn.",</b></span> <br/>
									<p>Your Password was successfully reset. Please find the new password below.</p>
									<p style='margin:5px'>User name : $email</p>
									<p style='margin:5px'>Password    : $encode</p>
									<p>&nbsp;</p>
									<p style='margin:5px;color:#000'>Regards</p>
									<p style='margin:5px;color:#000'>Tech Active</p>
						</div>";
				//echo $regmessage;exit;
				$this->load->library('email');
				$config['mailtype']="html";		
				$this->email->initialize($config);	
				$this->email->from('admin@tech-active.com');
				$this->email->to($email);
				$this->email->subject('Your password is successfully reset');
				$this->email->message($regmessage);
				$this->email->send();
			}
			else
			{
				$this->session->set_flashdata('success','<p class="error">Please check your email and try again</p>');
			}
			redirect('welcome/index');
		}
}

