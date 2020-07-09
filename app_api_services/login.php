<?php
/*
Site : http:www.vetbossel.in
Author :vetripandi
*/
require_once 'config.php';

$request_body = file_get_contents('php://input');
$payload = json_decode($request_body);

//$empid = $payload->emp_id;


if( isset($payload->type) && !empty($payload->type ) ){
	$type = $payload->type;
	
	switch ($type) {
		case "login_user":
			login_user($mysqli, $payload);
			break;
		case "logout_user":
			logout_user($mysqli, $payload);
			break;
		case "change_password":
			change_password($mysqli, $payload);
			break;
		case "forget_password":
			forget_password($mysqli, $payload);
			break;
			
		default:
			invalidRequest();
	}
}else{
	invalidRequest();
}

/**
 * This function will handle user add, update functionality
 * @throws Exception
 */
function login_user($mysqli, $payload){
   
	try{
       
        $username = $mysqli->real_escape_string(isset( $payload->username ) ? $payload->username : '');
        $password = $mysqli->real_escape_string(isset( $payload->password ) ? $payload->password : '');

        $query = "SELECT * FROM `sync_users` where `user_name`= '$username' and `password`= '$password'";
        $result = $mysqli->query( $query );
        $row = $result->fetch_assoc();
       
		if($row){
            $data['success'] = true;
            $data['message'] = "valid user";
            $data['data'][] = $row;
           
            echo json_encode($data);
			exit;
		}else{
			$data['success'] = false;
			$data['message'] = "Please login with valid credentials";
            echo json_encode($data);
			exit;
		}
	
	}catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
}   

/**
 * This function will handle user deletion
 * @param string $id
 * @throws Exception
 */

function logout_user($mysqli, $payload){
   // print_r($payload);
   // echo session_id();
    print_r($_SESSION); exit;
	
}
	
/**
 * This function gets list of users from database
 */
function change_password($mysqli, $payload){
    
    
    try{
       
        $oldpassword = $mysqli->real_escape_string(isset( $payload->oldpassword ) ? $payload->oldpassword : '');
        $newpassword = $mysqli->real_escape_string(isset( $payload->password ) ? $payload->password : '');       
        $emp_id = $mysqli->real_escape_string(isset( $payload->emp_id ) ? $payload->emp_id : '');


        $query = "SELECT * FROM `sync_users` where `emp_id`= '$emp_id' and `password`= '$oldpassword'";
        $result = $mysqli->query( $query );
        $row = $result->fetch_assoc();
        
		if($row){
            
              $query = "UPDATE  `sync_users` SET  `password`= '$newpassword' where `emp_id`= '$emp_id' and `password`= '$oldpassword'";
              $result = $mysqli->query( $query );
              //$row = $result->fetch_assoc();
                if($result){
                     $data['success'] = true;
                     $data['message'] = "Password changed succesfully .Please login again";
                    echo json_encode($data);
                    exit;  
                }
                else{
                    $data['success'] = false;
                    $data['message'] = "Password not updated. Please try again";
                    echo json_encode($data);
                    exit;
                }
                
		}else{
			$data['success'] = false;
			$data['message'] = "Invalid user details";
            echo json_encode($data);
			exit;
		}
	
	}catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
    
	
}
	

/**
 * This function gets list of users from database
 */
function forget_password($mysqli, $payload){
    
    
    try{
       
           
        $email_id = $mysqli->real_escape_string(isset( $payload->email ) ? $payload->email : '');


        $query = "SELECT * FROM `sync_users` where `email`= '$email_id' ";
        $result = $mysqli->query( $query );
        $row = $result->fetch_assoc();
        
		if($row){

			$newpassword = getRandomString();
			$subject = "Sync skills password information";
			$body = "<h4>Hello " . $row['user_name'] . " , <br>
					Please find the new password for sync skills </h4>
					<p>New Password :- $newpassword </p>

					<p>Thanks, <br>
				  Sync Skills.</p>";
			$headers  = "From: Sync Skills <srinivas.plvl@gmail.com>" . "\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$retval = mail($email_id, $subject, $body, $headers);
			if(isset($retval))
			{
			      $query = "UPDATE  `sync_users` SET  `password`= '$newpassword' where `email`= '$email_id' ";
	              $result = $mysqli->query( $query );
	                if($result){
	                     $data['success'] = true;
	                     $data['newpassword'] = $newpassword;
	                     $data['message'] = "New Password sent to register email id .Please login again";
	                    echo json_encode($data);
	                    exit;  
	                }
	                else{
	                    $data['success'] = false;
	                    $data['message'] = "Password not sent. Please try again";
	                    echo json_encode($data);
	                    exit;
	                }
			} else {
				$data['success'] = false;
                $data['message'] = "Password not sent. Please try again";
                echo json_encode($data);
                exit;
			}
              
                
		}else{
			$data['success'] = false;
			$data['message'] = "Email id not exists";
            echo json_encode($data);
			exit;
		}
	
	}catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
    
	
}

function getRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function invalidRequest()
{
	$data = array();
	$data['success'] = false;
	$data['message'] = "Invalid request.";
	echo json_encode($data);
	exit;
}





