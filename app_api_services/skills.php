<?php

require_once 'config.php';
$request_body = file_get_contents('php://input');
$payload = json_decode($request_body);


if( isset($payload->type) && !empty($payload->type )  ){
	$type = $payload->type;
	
	switch ($type) {
		case "create":
			save_skills($mysqli, $payload);
			break;
        case "getskills":
			getSkills($mysqli);
			break;
        case "getSkillSet":
        getSkillSet($mysqli);
        break;
        case "deleteSkill":
			delete_skill($mysqli, $payload);
			break;
		default:
			invalidRequest();
	}
}else{
	invalidRequest();
}


/**
 * This function gets list of users from database
 */
function getSkills($mysqli){
	try{
	
		$query = "SELECT skill_type.skill_id,skill_type.skill_name, skill_category.category_name,skill_category.category_id, skill_type.status, skill_domain.domain_name, skill_domain.domain_id
                  FROM `skill_type` 
                  LEFT JOIN skill_category ON skill_type.category_id = skill_category.category_id
                  LEFT JOIN skill_domain ON skill_category.domain_id=skill_domain.domain_id";
		$result = $mysqli->query( $query );
		$data = array();
		while ($row = $result->fetch_assoc()) {
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
 * This function gets list of users from database
 */
function getSkillSet($mysqli){
	try{
        
        $skill_data_array['domains'] = array();    
        $skill_data_array['categories'] = array();
        $domain_array = array();
        $categories_array = array();
        $skills_array = array();
        
        $fetch_domains = mysqli_query($mysqli, "SELECT domain_id, domain_name FROM `skill_domain` order by domain_id") or die(mysqli_error($mysqli));
        
		while ($row_domains = mysqli_fetch_assoc($fetch_domains)) {
             $domain_array['domain_id'] = $row_domains['domain_id'];
             $domain_array['domain_name'] = $row_domains['domain_name'];
             array_push($skill_data_array['domains'], $domain_array);
        }
        
        $fetch_users = mysqli_query($mysqli, "SELECT category_id, category_name FROM `skill_category` order by category_id") or die(mysqli_error($mysqli));
        while ($row_users = mysqli_fetch_assoc($fetch_users)) {
            $categories_array['category_id'] = $row_users['category_id'];
            $categories_array['category_name'] = $row_users['category_name'];
            $categories_array['skills'] = array();

            $fetch_notes = mysqli_query($mysqli, "SELECT skill_type.skill_id,skill_type.skill_name  FROM `skill_type` WHERE category_id = ".$row_users['category_id']."") or die(mysqli_error($mysqli));
            while ($row_notes = mysqli_fetch_assoc($fetch_notes)) {
                $skills_array['id']=$row_notes['skill_id'];
                $skills_array['skill_name']=$row_notes['skill_name'];
                array_push($categories_array['skills'], $skills_array);
            }

            array_push($skill_data_array['categories'],$categories_array);
        }

        $jsonData = json_encode($skill_data_array, JSON_PRETTY_PRINT);

        echo $jsonData;exit;
        
	
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
function save_skills($mysqli, $payload){
    
	try{
        
		$data = array();
       
		$skill_name = $mysqli->real_escape_string(isset( $payload->skill_name ) ? $payload->skill_name : '');		
        $skillID = $mysqli->real_escape_string(isset( $payload->skill_id ) ? $payload->skill_id : '');    
        $loginID = $mysqli->real_escape_string(isset( $payload->loginID ) ? $payload->loginID : '');  
        $status = $mysqli->real_escape_string(isset( $payload->status ) ? $payload->status : ''); 
        $modified_date = date("Y-m-d h:i:s");       
        $type = $mysqli->real_escape_string(isset( $payload->type ) ? $payload->type : ''); 
	    
		if($loginID == '' || $skill_name == '' ){
			throw new Exception( "Required fields missing, Please enter and submit" );
		}
	     
        $domainID = update_domain($mysqli, $payload);
	    $categoryID = update_category($mysqli, $payload, $domainID);
        
		if(empty($skillID)){
			$query = "INSERT INTO skill_type (`skill_id`, `skill_name`, `category_id`,  `status`, `modified_on`) 
            VALUES ('', '$skill_name', '$categoryID', '$status', '$modified_date')";
            
		} else {
            
			$query = "UPDATE skill_type SET `skill_name` = '$skill_name', `category_id` = '$categoryID', status = '$status', `modified_on` = '$modified_date' WHERE `skill_type`.`skill_id` = $skillID";
		}
        
	     
		if($mysqli->query( $query)){
			$data['success'] = true;
//			if(!empty($skillID))$data['message'] = 'Skills updated successfully.';
//			else $data['message'] = 'Skills inserted successfully.';
            getSkills($mysqli);
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
 * This function will handle domain updation
 * @param string $id
 * @ */

function update_category($mysqli, $payload, $domainID){
    try{
        
        $data = array();
        $category = $mysqli->real_escape_string(isset( $payload->category ) ? $payload->category : '');           
        $status = $mysqli->real_escape_string(isset( $payload->status ) ? $payload->status : '');   
        $modified_date = date("Y-m-d h:i:s");    
        
        if(is_numeric($category)){
			$query = "UPDATE skill_category SET  `domain_id`= '$domainID', status = '$status', `modified_on` = '$modified_date' WHERE `skill_category`.`category_id` = $category";
		}else{
            
            $query = "INSERT INTO skill_category (`category_id`, `category_name`, `domain_id`, `status`, `modified_on`) 
            VALUES ('', '$category', '$domainID', '$status','$modified_date')";
		} 
        
       
        if($mysqli->query( $query)){
			$data['success'] = true;
			if(is_numeric($category))$category_id =  (int) $category;
			else $category_id = (int) $mysqli->insert_id;
            return $category_id;
		}else{
			throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
		}
		
        
    } catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
}

/**
 * This function will handle domain updation
 * @param string $id
 * @ */

function update_domain($mysqli, $payload){
    
    try{
        
        $domain = $mysqli->real_escape_string(isset( $payload->domain ) ? $payload->domain : '');
        $status = $mysqli->real_escape_string(isset( $payload->status ) ? $payload->status : '');   
        $modified_date = date("Y-m-d h:i:s");  
        
        if(is_numeric($domain)){
            $query = "UPDATE skill_domain SET status = '$status', `modified_on` = '$modified_date' WHERE `skill_domain`.`domain_id` = $domain";
			
		} else {
			$query = "INSERT INTO skill_domain (`domain_id`, `domain_name`, `status`, `modified_on`) 
            VALUES ('', '$domain','$status','$modified_date')";
		}
        
        
        if( $mysqli->query( $query ) ){
			if(is_numeric($domain))$domain_id = $domain;
			else $domain_id = (int) $mysqli->insert_id;
            return $domain_id;
		} else {
			throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
		}
		
         
    } catch (Exception $e){
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
function delete_skill($mysqli, $payload){
	
    try{
        
        $id  = $mysqli->real_escape_string(isset( $payload->skillId ) ? $payload->skillId : '');
		if(empty($id)) throw new Exception( "Invalid Skill." );
		$query = "DELETE FROM `skill_type` WHERE `skill_id` = $id";
		if($mysqli->query( $query )){
			$data['success'] = true;
			$data['message'] = 'Skill deleted successfully.';
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





