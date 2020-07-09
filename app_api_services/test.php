<?php
/*
Site : http:www.vetbossel.in
Author :vetripandi
*/
require_once 'config.php';
$request_body = file_get_contents('php://input');
$payload = json_decode($request_body);
getUsers($mysqli);
//
//if( isset($payload->type) && !empty($payload->type )  ){
//	$type = $payload->type;
//	
//	switch ($type) {
//		case "create":
//			save_user($mysqli, $payload);
//			break;
//        case "getusers":
//			getUsers($mysqli);
//			break;
//		case "deleteUser":
//			delete_user($mysqli, $payload);
//			break;
//		case "change_password":
//			change_password($mysqli);
//			break;
//		default:
//			invalidRequest();
//	}
//}else{
//	invalidRequest();
//}

/**
 * This function gets list of users from database
 */
function getUsers($mysqli){
	try{
	
		$query = "select *, CASE login_type WHEN '3' THEN 'ADMIN' WHEN '2' THEN 'HR' WHEN '1' THEN 'MANAGER' END AS `logintype` FROM `sync_users` order by id";
		$result = $mysqli->query( $query );
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$row['id'] = (int) $row['id'];
			$data['data'][] = $row;
		}
		$data['success'] = true;
		echo json_encode($data);exit;
	
	}catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
}

/**
 * This function will handle user add, update functionality
 * @throws Exception
 */
function save_user($mysqli, $payload){
   
	try{
		$data = array();
        
		$emp_id = $mysqli->real_escape_string(isset( $payload->emp_id ) ? $payload->emp_id : '');	
        $emp_name = $mysqli->real_escape_string(isset( $payload->emp_name ) ? $payload->emp_name : '');       
        $user_name = $mysqli->real_escape_string(isset( $payload->user_name ) ? $payload->user_name : '');
        $password = $mysqli->real_escape_string(isset( $payload->password ) ? $payload->password : '');
        $email = $mysqli->real_escape_string(isset( $payload->email ) ? $payload->email : '');      
        $designation = $mysqli->real_escape_string(isset( $payload->designation ) ? $payload->designation : '');
        $login_type = $mysqli->real_escape_string(isset( $payload->login_type ) ? $payload->login_type : '');  
        $status = $mysqli->real_escape_string(isset( $payload->status ) ? $payload->status : '');     
        $modified_date = date("Y-m-d h:i:s");       
        $type = $mysqli->real_escape_string(isset( $payload->type ) ? $payload->type : ''); 
        $id = $mysqli->real_escape_string( isset( $payload->id ) ? $payload->id : '');

	    
		if($emp_id == '' || $user_name == '' || $password == ''|| $login_type == '' ){
			throw new Exception( "Required fields missing, Please enter and submit" );
		}
	
	
		if(empty($id)){
			$query = "INSERT INTO sync_users (`id`, `emp_id`, `emp_name`, `user_name`, `password`, `email`, `designation`, `login_type`, `status`,`modified_date`) 
            VALUES (NULL, '$emp_id', '$emp_name', '$user_name', '$password', '$email', '$designation', '$login_type', '$status', '$modified_date')";
            
		}else{
            
			$query = "UPDATE sync_users SET `emp_id` = '$emp_id', emp_name = '$emp_name', `user_name` = '$user_name', `password` = '$password', `email` = '$email', designation = '$designation', `login_type` = '$login_type', status = '$status', `modified_date` = '$modified_date' WHERE `sync_users`.`id` = $id";
		}
	
		if( $mysqli->query( $query ) ){
			$data['success'] = true;
//			if(!empty($id))$data['message'] = 'User updated successfully.';
//			else $data['message'] = 'User inserted successfully.';
//			if(empty($id))$data['id'] = (int) $mysqli->insert_id;
//			else $data['id'] = (int) $id;
            getUsers($mysqli);
		}else{
			throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
		}
		$mysqli->close();
		echo json_encode($data);
		exit;
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
function delete_user($mysqli, $payload){
	
    try{
        
        $id  = $mysqli->real_escape_string(isset( $payload->userId ) ? $payload->userId : '');
		if(empty($id)) throw new Exception( "Invalid User." );
		$query = "DELETE FROM `sync_users` WHERE `id` = $id";
		if($mysqli->query( $query )){
			$data['success'] = true;
			$data['message'] = 'User deleted successfully.';
			echo json_encode($data);
			exit;
		}else{
			throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
		}
		
	
	}catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
    
}
	

	


function invalidRequest()
{
	$data = array();
	$data['success'] = false;
	$data['message'] = "Invalid request.";
	echo json_encode($data);
	exit;
}





