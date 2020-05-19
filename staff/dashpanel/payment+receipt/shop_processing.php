<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');

extract($_POST);
//print_r($_POST);
//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

class processShop extends kas_framework {

	public function confirmDeletion($value) {
		print '<div style="border:1px solid #CCC; padding:10px; margin:5px 10px">Do You Really Want to Delete? &nbsp;&nbsp;&nbsp;
		<button class="btn btn-warning btn-flat" id="confirm_no">
		<i class="fa fa-thumbs-o-down"></i> No</button> &nbsp;&nbsp;
		<button class="btn btn-success btn-flat" id="confirm_yes" value="'.$value.'">
		<i class="fa fa-thumbs-o-up"></i> Yes</button></div>
		<br />';	
	}
	
	public function deleteItem($id) {
		/*$delQ = mysql_query("DELETE FROM school_item_price WHERE id = '".$id."' LIMIT 1");
			if (mysql_affected_rows() == 1) {
				$this->showInfoCallout('Record Deleted Successfully. Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/manageShop').'">Click Here</a> to See Changes...');
			} else {
				$this->showDangerCallout('Delete Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
				//print mysql_error();
			}
		*/
		$this->showInfoCallout('This functionality is deprecated. Please turn the status Off and make it invisible. This Item has been Indexed already. 
		Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/manageShop?act=edit&item='.$this->saltifyID($id).'').'">Click Here</a> to deactive this Item');
	}
	
	public function updateItem() {
	 extract($_POST);
	 require ('../../../php.files/classes/pdoDB.php');
		$rawUpdateQuery = "UPDATE school_item_price SET tution_code_rel_id = tution_code_rel_id, school_item_name = :school_item_name, school_item_desc = :school_item_desc, school_item_price = :school_item_price, 
					school_item_quantity_left = :school_item_quantity_left, status = '".$status."' WHERE id = '".$passingId."'";
				$db_rawUpdateQuery = $dbh->prepare($rawUpdateQuery);
				$db_rawUpdateQuery->bindParam(':tution_code_rel_id', $tution_code_rel_id); $db_rawUpdateQuery->bindParam(':school_item_name', $school_item_name); 
				$db_rawUpdateQuery->bindParam(':school_item_quantity_left', $school_item_quantity_left); $db_rawUpdateQuery->bindParam(':school_item_desc', $school_item_desc); 
				$db_rawUpdateQuery->bindParam(':school_item_price', $school_item_price);
				$db_rawUpdateQuery->execute();
				$get_rawUpdateQuery_rows = $db_rawUpdateQuery->rowCount();
				$db_rawUpdateQuery = null;
				if ($get_rawUpdateQuery_rows == 1) {
					$this->showInfoCallout('Item Updated Succesfully. Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/manageShop#shoptable').'">Click here</a>');
					$this->buttonController('#updateItemButton', 'enable');
				} else {
					$this->showDangerCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					$this->buttonController('#updateItemButton', 'enable');
					//print mysql_error();
				}	
	}
	
	public function addItem() {
	 extract($_POST);
	 require ('../../../php.files/classes/pdoDB.php');
	 if ($this->strIsEmpty($tution_code_rel_id) or $this->strIsEmpty($school_item_name) or $this->strIsEmpty($school_item_desc) or $this->strIsEmpty($school_item_price) or $this->strIsEmpty($school_item_quantity_left)) {
				$this->showDangerCallout('Please Fill in all Fields');
				$this->buttonController('#addItemButton', 'enable');
	 } else if (!is_numeric($school_item_price)) {
			$this->showDangerCallout('The Amount Field should be in Numeric format only');
				$this->buttonController('#addItemButton', 'enable');
	 } else {
		$rawAddItemQuery = "INSERT INTO school_item_price (tution_code_rel_id, tuition_codes_domain, school_item_name, school_item_desc, school_item_price, school_item_quantity_left, status) VALUES
		(:tution_code_rel_id, '".$loc_name_id."', :school_item_name, :school_item_desc, :school_item_price, :school_item_quantity_left, '1')";
			$db_rawAddItemQuery = $dbh->prepare($rawAddItemQuery);
			$db_rawAddItemQuery->bindParam(':school_item_name', $school_item_name); $db_rawAddItemQuery->bindParam(':school_item_desc', $school_item_desc); $db_rawAddItemQuery->bindParam(':tution_code_rel_id', $tution_code_rel_id); 
			$db_rawAddItemQuery->bindParam(':school_item_price', $school_item_price); $db_rawAddItemQuery->bindParam(':school_item_quantity_left', $school_item_quantity_left); 
				$db_rawAddItemQuery->execute();
				$get_rawAddItemQuery_rows = $db_rawAddItemQuery->rowCount();
				$db_rawAddItemQuery = null;
				if ($get_rawAddItemQuery_rows == 1) {
					$this->showInfoCallout('Item Added Succesfully. Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/manageShop#shoptable').'">Click here</a>');
					$this->buttonController('#addItemButton', 'enable');
					$this->formReset('#addItemForm');
				} else {
					$this->showDangerCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					$this->buttonController('#addItemButton', 'enable');
					//print mysql_error();
				}
	 
		}	
	}
	
	public function add_domain() {
	 extract($_POST);
	 require ('../../../php.files/classes/pdoDB.php');
	 if ($this->strIsEmpty($sales_name) or $this->strIsEmpty($sales_location)) {
				$this->showDangerCallout('Please Fill in all Fields');
				$this->buttonController('#addDomainButton', 'enable');
	 } else {
		$rawAddItemQuery = "INSERT INTO tuition_codes_domain (tuition_codes_domain_name, tuition_codes_domain_location) VALUES (:sales_name, :sales_location)";
			$db_rawAddItemQuery = $dbh->prepare($rawAddItemQuery);
			$db_rawAddItemQuery->bindParam(':sales_name', $sales_name); $db_rawAddItemQuery->bindParam(':sales_location', $sales_location);
				$db_rawAddItemQuery->execute();
				$get_rawAddItemQuery_rows = $db_rawAddItemQuery->rowCount();
				$db_rawAddItemQuery = null;
				if ($get_rawAddItemQuery_rows == 1) {
					$this->showInfoCallout('Sales Location Added Succesfully. Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/managelocations#shoptable').'">Click here</a>');
					$this->buttonController('#addDomainButton', 'enable');
					$this->formReset('#addDomainForm');
				} else {
					$this->showDangerCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					$this->buttonController('#addDomainButton', 'enable');
					//print mysql_error();
				}
	 
		}	
	}
	
	public function updateDomain() {
	 extract($_POST);
	 require ('../../../php.files/classes/pdoDB.php');
		$rawUpdateQuery = "UPDATE tuition_codes_domain SET tuition_codes_domain_name = :domain_name, tuition_codes_domain_location = :domain_location WHERE tuition_codes_domain_id = '".$passingId."'";
			$db_rawUpdateQuery = $dbh->prepare($rawUpdateQuery);
				$db_rawUpdateQuery->bindParam(':domain_name', $domain_name); $db_rawUpdateQuery->bindParam(':domain_location', $domain_location);
				$db_rawUpdateQuery->execute();
				$get_rawUpdateQuery_rows = $db_rawUpdateQuery->rowCount();
				$db_rawUpdateQuery = null;
				if ($get_rawUpdateQuery_rows == 1) {
					$this->showInfoCallout('Sales Location Updated Succesfully. Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/managelocations#shoptable').'">Click here</a>');
					$this->buttonController('#updateDomainButton', 'enable');
				} else {
					$this->showDangerCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					$this->buttonController('#updateDomainButton', 'enable');
					//print mysql_error();
				}	
	}
	
		
	public function deleteDomain($id) {
		/*$delQ = mysql_query("DELETE FROM tuition_codes_domain WHERE tuition_codes_domain_id = '".$id."' LIMIT 1");
			if (mysql_affected_rows() == 1) {
				$this->showInfoCallout('Domain Deleted Successfully. Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/manageShop').'">Click Here</a> to See Changes...');
			} else {
				$this->showDangerCallout('Delete Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
				//print mysql_error();
			}
		*/
		$this->showInfoCallout('This functionality is deprecated. The Only Option here is to rename this Location to an Existing one.
		Please <a href="'.$this->url_root('staff/dashpanel/payment+receipt/managelocations?action=edit&code='.$this->saltifyID($id).'').'">Click Here</a> to Update this Sales Location...');
	}
	
}

$__shop_processing = new processShop();

	$instruction = $_GET['instruction'];
	if ($instruction == 'deleteItem') {
		$__shop_processing->deleteItem($passingId);
	} else if ($instruction == 'updateItem') {
		$__shop_processing->updateItem();
	} else if ($instruction == 'additem') {
		$__shop_processing->addItem();
	} else if ($instruction == 'add_domain') {
		$__shop_processing->add_domain();
	} else if ($instruction == 'updateDomain') {
		$__shop_processing->updateDomain();
	} else if ($instruction == 'deleteDomain') {
		$__shop_processing->deleteDomain($passingId);
	}

?>
