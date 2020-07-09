<?php
if (!class_exists(Database)) 
{ 

//echo "in";exit;
include "dbconfig.php";

class database { 

  var $_db_linkid = 0; 
  var $_db_qresult = 0; 
  var $RowData = array(); 
  var $NextRowNumber = 0; 
  var $RowCount = 0; 
  var $debug =1;
 function database ($host=MYSQL_HOST,$user=MYSQL_USER,$pass=MYSQL_PASSWORD,$db=MYSQL_DATABASE) { 
    $this->Open ($host, $user, $pass); 
    if ($db != "")  
      $this->SelectDB($db); 
  }   
  function Open ($host, $user, $pass) { 
    $this->_db_linkid = mysql_connect($host, $user, $pass); 
  }   
  function Close () { 
    @mysql_free_result($this->_db_qresult); 
    return mysql_close ($this->_db_linkid); 
  }   

  function SelectDB ($dbname) { 
    if (@mysql_select_db ($dbname, $this->_db_linkid) == true) { 
      return 1;     
    }  
    else { 
      return 0; 
    }    
  }
  
 function Read($querystr = ""){
    if ($querystr){
      $this->Query($querystr);
    } 
    return $this->ReadRow();
 }

  function  Query ($querystr){
	 $result = mysql_query ($querystr, $this->_db_linkid); 
      if ($result == 0){ 
      //$this->SystemError("Can't do query : $querystr\n\n".mysql_errno().": ".mysql_error());
      return 0; 
    }else{ 
		
      @mysql_free_result($this->_db_qresult); 
	  $this->RowData = array();       
      $this->_db_qresult = $result; 
      $this->RowCount = @mysql_num_rows ($this->_db_qresult); 
      if (!$this->RowCount) { 
        // The query was probably an INSERT/REPLACE etc. 
      $this->RowCount = 0; 
      } 
      return 1; 
    } 
  }   

  function f($Variable) {
	  return $this->RowData[$Variable];
  }

  function LastInsertID() {
    return mysql_insert_id();
  }

  function ReadRow() { 
    if($this->RowData = mysql_fetch_array ($this->_db_qresult)) { 
      $this->NextRowNumber++; 
      return 1; 
    } 
    else { 
      return 0; 
    } 
  }   

  function quote($str) {
    return mysql_escape_string($str);
  }

function getNumRows() {
return	$this->RowCount = @mysql_num_rows ($this->_db_qresult);
}

function getTabColumns() {
    $Columns = array();
    $fields = mysql_num_fields($this->_db_qresult);
    while ($i < $fields) {
      $type  = mysql_field_type($this->_db_qresult, $i);
      $name  = mysql_field_name($this->_db_qresult, $i);
      $len   = mysql_field_len($this->_db_qresult, $i);
      $flags = mysql_field_flags($this->_db_qresult, $i);
      $Columns[] = $name;
      $i++;
    }
    return $Columns;
}

  function getColumns() {
    $Columns = array();
    $fields = mysql_num_fields($this->_db_qresult);
    while ($i < $fields) {
      $type  = mysql_field_type($this->_db_qresult, $i);
      $name  = mysql_field_name($this->_db_qresult, $i);
      $len   = mysql_field_len($this->_db_qresult, $i);
      $flags = mysql_field_flags($this->_db_qresult, $i);
      $Columns[] = array(
        "type" => $type,
        "name" => $name,
        "len" => $len,
        "flags" => $flags);
      $i++;
    }
    return $Columns;
  }

  function Array2Date($Date) {
    return $Date['Year']."-".$Date['Month']."-".$Date['Day']." ".$Date['Hour'].":".$Date['Minute'].":".$Date['Second'];
  }
  function A2D($Date) {
    return $Date['Day']."-".$Date['Month']."-".$Date['Year'];
  }
function A3D($Date) {
    return $Date['Year']."-".$Date['Month']."-".$Date['Day'];
  }
  function Date2Array($Date) {
    $Date = strtotime($Date);
    return array(
      'Day' => date('d',$Date),
      'Month' => date('m',$Date),
      'Year' => date('Y',$Date),
      'Hour' => date('H',$Date),
      'Minute' => date('i',$Date),
      'Second' => date('s',$Date)
     );
  }
} 
}
	$query="select * from page where page_name  = '$pagename'";	
	$db=new database();
	$db->query($query);
	$db->ReadRow();
	$pageid = $db->f('page_id');
	$pagename = $db->f('page_name');
	$pagebanner = $db->f('page_banner');
	$pagetitle = $db->f('page_title');
	$pagesummary = $db->f('page_summary'); 
	
	/*$toprightpaneltitle = $db->f('top_rightpanel_title'); 
	$toprightpanel = $db->f('rightpanel');  	
	$toprightpanelreadmore = $db->f('first_rightpanel_readmore');  
	$bottomrightpanel = $db->f('another_rightpanel');  */	 
	$box1title = $db->f('box1_title'); 
	$box1description = $db->f('box1_description'); 
	$box1linktext = $db->f('box1_linktext'); 
	$box1link = $db->f('box1_link'); 
	
	$box2title = $db->f('box2_title'); 
	$box2description = $db->f('box2_description'); 
	$box2linktext = $db->f('box2_linktext'); 
	$box2link = $db->f('box2_link');

	
	$box3title = $db->f('box3_title'); 
	$box3description = $db->f('box3_description'); 
	$box3linktext = $db->f('box3_linktext'); 
	$box3link = $db->f('box3_link'); 
						
	
	$metakeywords = $db->f('page_mk');  
	$metadesccription = $db->f('page_md');  
		
	
	$query_header="select * from headerpart ";	
	$dbhd=new database();
	$dbhd->query($query_header);
	$dbhd->ReadRow();
	$headerphoneno = $dbhd->f('header_phoneno');
	$headerpartname = $dbhd->f('headerpart_name');
	$headerpartnamelink = $dbhd->f('headerpart_name_link');
	
	$query_footer="select * from footerpart ";	
	$dbfd=new database();
	$dbfd->query($query_footer);
	$dbfd->ReadRow();
	$footercopyrightstext = $dbfd->f('copyrightsto');
	$footercopyrightstext_link = $dbfd->f('copyrightslink');
	$footer_menu = $dbfd->f('footermenu');
	
		
	$dbbn1=new database();
	$dbbn2=new database();
	$dbbn3=new database();
	$dbbn4=new database();
	$dbbn5=new database();
	
	$dbbn1->query($query_bn="select * from banner where banner_sequence='1'");
	$dbbn2->query($query_bn="select * from banner where banner_sequence='2'");
	$dbbn3->query($query_bn="select * from banner where banner_sequence='3'");
	$dbbn4->query($query_bn="select * from banner where banner_sequence='4'");
	$dbbn5->query($query_bn="select * from banner where banner_sequence='5'");
	
	$dbbn1->ReadRow();	
	$bannerpath1 = $dbbn1->f('banner_path');
	
	$dbbn2->ReadRow();	
	$bannerpath2 = $dbbn2->f('banner_path');
	
	$dbbn3->ReadRow();	
	$bannerpath3 = $dbbn3->f('banner_path');
	
	$dbbn4->ReadRow();	
	$bannerpath4 = $dbbn4->f('banner_path');
	
	$dbbn5->ReadRow();	
	$bannerpath5 = $dbbn5->f('banner_path');
	//echo $bannerpath1.$bannerpath2.$bannerpath3.$bannerpath4.$bannerpath5; exit;
	
?>