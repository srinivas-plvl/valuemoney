<?php
/*
Site : http:www.vetbossel.in
Author :vetripandi
*/


require_once 'config.php';
$request_body = file_get_contents('php://input');
$payload = json_decode($request_body);

if( isset($payload->type) && !empty($payload->type )  ){
	$type = $payload->type;
	
	switch ($type) {
		case "create":
			save_employee($mysqli, $payload);
			break;
        case "getEmployees":
			getEmployees($mysqli);
			break;
		case "updateEmployees":
			update_employees($mysqli, $payload);
			break;
        case "downloadEmployees":
            download_employees($mysqli, $payload);
            break;
		case "deleteEmployee":
			delete_employee($mysqli, $payload);
			break;
		default:
			invalidRequest();
	}
} 
elseif($_POST['type'] == 'uploadEmployees')
{
    upload_employees($mysqli, $_POST);
}
else{
	invalidRequest();
}

/**
 * This function gets list of users from database
 */

function download_employees($mysqli)
{
    /** PHPExcel */
    include 'Classes/PHPExcel.php';
    $conn = new mysqli('localhost', 'root', '');  
    mysqli_select_db($conn, 'sync_skills');  
    // create new PHPExcel object
    $objPHPExcel = new PHPExcel;
    // set default font
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
    // set default font size
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
    // create the writer
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    // Create your database query
    $query = "SELECT emp_id , emp_name, email , designation , reporting_to , tech_domain , tech_category, skill_set FROM `sync_employees`";  

    // Execute the database query
    $result = mysqli_query($conn, $query);  
    $objPHPExcel = new PHPExcel(); 
    $objPHPExcel->setActiveSheetIndex(0); 
    $rowCount = 2; 

    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Employee ID');
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Employee Name'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Designation'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Reporting To'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Domain'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Category'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Skill Set'); 

    while($row = mysqli_fetch_array($result)){ 
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['emp_id']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['emp_name']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['email']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['designation']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['reporting_to']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['tech_domain']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['tech_category']); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['skill_set']); 
        $rowCount++; 
    } 
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
    $objWriter->save('some_excel_file.xlsx');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="test.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    SaveViaTempFile($objWriter);
    exit;
}

function SaveViaTempFile($objWriter){
    $filePath = '' . rand(0, getrandmax()) . rand(0, getrandmax()) . ".tmp";
    $objWriter->save($filePath);
    readfile($filePath);
    unlink($filePath);
    exit;
}


//function download_employees1($mysqli)
//{
//	    
//        $setSql = "SELECT 
//        emp_id as `Employee ID`,
//        emp_name as `Employee Name`,
//        email as `Email`,
//        designation as  `Designation`,
//        reporting_to as  `Reporting To`,
//        tech_domain as  `Domain`,
//        tech_domain as  `Category`,
//        skill_set as  `Skill Set`
//        FROM `sync_employees`, (SELECT @a:= 0) AS a;
//        ";  
//    
//        $setRec = $mysqli->query( $setSql );
//        
//        $columnHeader = '';  
//        $columnHeader = "Employee ID" . "\t" . "Employee Name" . "\t" . "Email" . "\t" . "Designation" . "\t" . "Reporting To" . "\t" . "Domain" . "\t" . "Category" . "\t" . "Skill Set" . "\t";  
//
//        $setData = '';  
//
//        while ($rec = mysqli_fetch_row($setRec)) {  
//        $rowData = '';  
//        foreach ($rec as $value) {  
//        $value = '"'.$value.'"'. "\t";  
//        $rowData .= $value;  
//        }  
//        $setData .= trim($rowData) . "\n";  
//        }  
//
//
//        header("Content-type: application/octet-stream");  
//        header('Content-Disposition: attachment;filename="survey.xls"');
//        header("Pragma: no-cache");  
//        header("Expires: 0");  
//
//        echo ucwords($columnHeader) . "\n" . $setData . "\n"; 
//    
//}


function add_table($mysqli){
    
    $query = "CREATE TABLE `sync_employees` (
      `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE KEY,
      `emp_id` varchar(50) NOT NULL PRIMARY KEY,
      `emp_name` varchar(50) NOT NULL,
      `email` varchar(50) NOT NULL,
      `designation` varchar(50) NOT NULL,
      `reporting_to` varchar(50) DEFAULT NULL,
      `tech_domain` varchar(120) DEFAULT NULL,
      `tech_category` varchar(120) DEFAULT NULL,
      `skill_set` text NOT NULL,
      `status` tinyint(4) NOT NULL,
      `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $result = $mysqli->query( $query );
}

function upload_employees($mysqli, $payload){
    
    /** Include path **/
    set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

    /** PHPExcel_IOFactory */
    include 'PHPExcel/IOFactory.php';


    $inputFileName = $_FILES['EmpData']['tmp_name'];
        
    try {
	    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	} catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
    
    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

    $arrayCount = count($allDataInSheet);

    $invalidCnt = checkValidEmployees($allDataInSheet);

    if(($invalidCnt == 0) && ($arrayCount >1) ){
        try {
        
        $mysqli->query('TRUNCATE TABLE `sync_employees`');

        $query = "INSERT INTO sync_employees (`id`, `emp_id`, `emp_name`, `email`, `designation`, `reporting_to`, `tech_domain`, `tech_category`, `skill_set`, `status`,`modified_date`)  VALUES";

        for($i=2;$i<=$arrayCount;$i++) {

            $emp_id = trim($allDataInSheet[$i]["A"]);
            $emp_name = trim($allDataInSheet[$i]["B"]);
            $email = trim($allDataInSheet[$i]["C"]);
            $designation = trim($allDataInSheet[$i]["D"]);
            $reporting_to = trim($allDataInSheet[$i]["E"]);
            $domains = trim($allDataInSheet[$i]["F"]);
            $catgs = trim($allDataInSheet[$i]["G"]);
            $skills = trim($allDataInSheet[$i]["H"]);
            $modified_date = date("Y-m-d h:i:s"); 

             $query .= "('', '$emp_id', '$emp_name', '$email', '$designation', '$reporting_to', '$domains', '$catgs', '$skills', '1', '$modified_date')";
              if($i < ($arrayCount)){
                 $query .=",";
               }
        }
      //echo $query; exit;
       if( $mysqli->query( $query ) ){
            $data['success'] = true;
            $data['message'] = 'Employee Details updated successfully.';
            getEmployees($mysqli);
        }else{
            throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
        }
        $mysqli->close();
        echo json_encode($data);
        exit;
    } catch (Exception $e){
        $data = array();
        $data['success'] = false;
        $data['message'] = 'Error while uploding employee data.'.$e->getMessage();
        echo json_encode($data);
        exit;
    } 
    } else {
        $data = array();
        $data['success'] = false;
        $data['message'] = "Employees data is not in required format.";
        echo json_encode($data);
        exit; 
    }

    
}


function checkValidEmployees($empData){
    
    $arrayCount = count($empData);
    $nullVal = 0;
    for($i=2;$i<=$arrayCount;$i++) {
        $emp_id = trim($empData[$i]["A"]);
        $emp_name = trim($empData[$i]["B"]);
        $email = trim($empData[$i]["C"]);
        if($emp_id == '' || $emp_name == '' || $email == ''){
            $nullVal = $nullVal + 1;
         }
    }
    return $nullVal;
}


function getEmployees($mysqli){
	try{
	
		$query = "SELECT * FROM `sync_employees` order by id";
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
function save_employee($mysqli, $payload){
   
	try{
        
		$data = array();
		$emp_id = $mysqli->real_escape_string(isset( $payload->emp_id ) ? $payload->emp_id : '');	
        $id = $mysqli->real_escape_string(isset( $payload->id ) ? $payload->id : '');
        $emp_name = $mysqli->real_escape_string(isset( $payload->emp_name ) ? $payload->emp_name : '');   
        $email = $mysqli->real_escape_string(isset( $payload->email ) ? $payload->email : '');      
        $designation = $mysqli->real_escape_string(isset( $payload->designation ) ? $payload->designation : '');
        $reporting_to = $mysqli->real_escape_string(isset( $payload->reporting_to ) ? $payload->reporting_to : '');
        
        
        if($payload->domains){
            $domain_list = $payload->domains;
            $domains = join(', ', $domain_list);
        } else {
            $domains = $payload->tech_domain;
        } 
        
        if($payload->categories){
            $catg_list = $payload->categories;
            $catgs = join(', ', $catg_list);
        } else {
            $catgs = $payload->tech_category;
        }  
        
        if($payload->skills){
            $skill_list = $payload->skills;
            $skills = join(', ', $skill_list);
        }  else {
            $skills = $payload->skill_set;
        }
       
        
        $modified_date = date("Y-m-d h:i:s"); 
	   
	   if($emp_id == ''){
			throw new Exception( "Required fields missing, Please enter and submit" );
		}
        
		if($id== ''){
            
			$query = "INSERT INTO sync_employees (`id`, `emp_id`, `emp_name`, `email`, `designation`, `reporting_to`, `tech_domain`, `tech_category`, `skill_set`, `status`,`modified_date`) 
            VALUES ('', '$emp_id', '$emp_name', '$email', '$designation', '$reporting_to', '$domains', '$catgs', '$skills', '1', '$modified_date')";
            
            
		}else{
           
            $query = "UPDATE sync_employees SET  `designation`='$designation', `emp_name`= '$emp_name',`reporting_to`='$reporting_to', `tech_domain`='$domains', `tech_category`= '$catgs',`skill_set`='$skills', `modified_date` = '$modified_date' where emp_id='$emp_id'"; 
			
		}
        
        //echo $query; exit;
	
		if( $mysqli->query( $query ) ){
			$data['success'] = true;
			if(!empty($emp_id))$data['message'] = 'Employee Details updated successfully.';
			else $data['message'] = 'Employee inserted successfully.';
			if(empty($id))$data['id'] = (int) $mysqli->insert_id;
			else $data['id'] = (int) $id;
            getEmployees($mysqli);
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
 * This function will handle employee update functionality
 * @throws Exception
 */
function update_employees($mysqli, $payload){
   
	try{
		$data = array();
        
        $empId = $mysqli->real_escape_string(isset( $payload->emp_id ) ? $payload->emp_id : '');
        if($empId){
         $ids = $empId;
        } else {
        $emp_list = $payload->empList;
        $ids = join("', '", $emp_list);
        }
       
        $domain_list = $payload->domains;
        $domains = join(', ', $domain_list);
        
        $catg_list = $payload->categories;
        $catgs = join(', ', $catg_list);
        
        $skill_list = $payload->skills;
        $skills = join(', ', $skill_list);
        
        $modified_date = date("Y-m-d h:i:s"); 
        
        $type = $mysqli->real_escape_string(isset( $payload->type ) ? $payload->type : '');
       
        if($empId){
           $query = "UPDATE sync_employees SET  `designation`='$payload->designation', `emp_name`= '$payload->emp_name',`reporting_to`='$payload->reporting_to', `tech_domain`='$domains', `tech_category`= '$catgs',`skill_set`='$skills', `modified_date` = '$modified_date' where emp_id='$ids'"; 
        } else {
          $query = "UPDATE sync_employees SET  `tech_domain`='$domains', `tech_category`= '$catgs',`skill_set`='$skills', `modified_date` = '$modified_date' where emp_id IN('$ids')"; 
        }
        
        
	
		if( $mysqli->query( $query ) ){
          getEmployees($mysqli);
		  //$data['success'] = true;
	     // $data['message'] = 'User Details updated successfully.';
            
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
function delete_employee($mysqli, $payload){
	
    try{
        
        $id  = $mysqli->real_escape_string(isset( $payload->empId ) ? $payload->empId : '');
		if(empty($id)) throw new Exception( "Invalid Employee." );
		$query = "DELETE FROM `sync_employees` WHERE `emp_id` = '$id'";
		if($mysqli->query( $query )){
			$data['success'] = true;
			$data['message'] = 'Employee deleted successfully.';
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





