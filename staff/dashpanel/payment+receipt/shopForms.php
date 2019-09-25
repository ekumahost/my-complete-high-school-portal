<?php
class shopForms {
	public function confirmDeletion($value) {
		print '<div style="border:1px solid #CCC; padding:10px; margin:5px 10px" id="deleteDiv">Do You Really Want to Delete? &nbsp;&nbsp;&nbsp;
		<button class="btn btn-warning btn-flat" id="confirm_no">
		<i class="fa fa-thumbs-o-down"></i> No</button> &nbsp;&nbsp;
		<button class="btn btn-success btn-flat" id="confirm_yes" value="'.$value.'">
		<i class="fa fa-thumbs-o-up"></i> Yes</button></div>
		<br />';	
	}
	
	public function editForm($dbQuery) {
	 $general = new general();
		print '<form role="form" action="" method="post" id="updateItemForm">
				<div class="col-md-6">
					<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Update Item Basic</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label>Category</label>                                         
									<select name="tution_code_rel_id" required="required" class="form-control">
								<option></option>';
								$kas_framework->getallFieldinDropdownOption('tuition_codes', 'tuition_codes_desc', 'tuition_codes_id', @$dbQuery->tution_code_rel_id);
								print '</select>
								</div>

								<div class="form-group">
									<label>Item Name</label>                                         
									<input type="text" required="required" class="form-control" name="school_item_name" value="'.@$dbQuery->school_item_name.'" />
								</div>
								
								<div class="form-group">
									<label>Description</label>                                         
									<textarea class="form-control" required="required" name="school_item_desc">'.@$dbQuery->school_item_desc.'</textarea>
								</div>
							</div>
						 </div>
				</div>';
			print '<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Update Item Status</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Price</label>                                         
								<input type="text" required="required" class="form-control" name="school_item_price" value="'.@$dbQuery->school_item_price.'" />
							</div>

							<div class="form-group">
								<label>Quantity Left</label>                                         
								<input type="text" required="required" class="form-control" name="school_item_quantity_left" value="'.@$dbQuery->school_item_quantity_left.'" />
							</div>
							
							<div class="form-group">
								<label>Status</label>                                         
								<select name="status" required="required" class="form-control">';
									if ($dbQuery->status == '1') {
										print '<option value = "1" selected="selected">Active</option>';
										print '<option value = "0" >Deactive?</option>';
									} 
									if ($dbQuery->status == '0') {
										print '<option value = "0" selected="selected">In-Active</option>';
										print '<option value = "1">Activate?</option>';
									}
								print'</select>
								<input type="hidden" name="byepass" value="TBUG4fw24RE6CV6ru7Y8Y8" />
								<input type="hidden" name="passingId" value="'.@$dbQuery->id.'" />
							</div>
						</div>
					
					<div class="box-footer">
						<button type="submit" id="updateItemButton" class="btn btn-primary">Update Item</button>
					</div>
					<center><span id="message_for_updateItem"></span></center>
				 </div>
				</div>
			</form>';
	}
	
		public function addItemForm() {
	 $general = new general();
		print '<form role="form" action="" method="post" id="addItemForm">
				<div class="col-md-6">
					<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Add Item Basic</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label>Category</label>                                         
									<select name="tution_code_rel_id" required="required" class="form-control">
										<option></option>';
										$kas_framework->getallFieldinDropdownOption('tuition_codes', 'tuition_codes_desc', 'tuition_codes_id');
									print '</select>
								</div>
								<div class="form-group">
									<label>Location Name</label>                                         
									<select name="loc_name_id" required="required" class="form-control">
										<option></option>';
										$kas_framework->getallFieldinDropdownOption('tuition_codes_domain', 'tuition_codes_domain_name', 'tuition_codes_domain_id');
									print '</select>
								</div>

								<div class="form-group">
									<label>Item Name</label>                                       
									<input type="text" required="required" class="form-control" name="school_item_name" placeholder="Item Name" />
								</div>
								
								<div class="form-group">
									<label>Description</label>                                         
									<textarea required="required" class="form-control" name="school_item_desc" placeholder="Item Description"></textarea>
								</div>
							</div>
						 </div>
				</div>';
			print '<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Add Item Status</h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Price (N)</label>                                         
								<input type="text" required="required" class="form-control" name="school_item_price" placeholder="Item Price" />
							</div>

							<div class="form-group">
								<label>Quantity Left</label>                                         
								<input type="text" required="required" class="form-control" name="school_item_quantity_left" placeholder="Item Quantity Left" />
								<input type="hidden" name="byepass" value="yGU5F4d3457ghtftREREDR" />
							</div>
						</div>
					
					<div class="box-footer">
						<button type="submit" id="addItemButton" class="btn btn-primary"><i class="fa fa-plus"></i> Add Item</button>
					</div>
					<center><span id="message_for_addItem"></span></center>
				 </div>
				</div>
			</form>';
	}
	
	public function yes_domain_exist() {
		require ('../../../php.files/classes/pdoDB.php');
		$domain_exist_q = "SELECT * FROM tuition_codes_domain";
		$db_domain_exist_q = $dbh->prepare($domain_exist_q);
		$db_domain_exist_q->execute();
		$get_domain_exist_q_rows = $db_domain_exist_q->rowCount();
		$db_domain_exist_q = null;
			return ($get_domain_exist_q_rows == 0)? false: true;	
	}
	
	public function add_domain_form() {
			print '<form role="form" action="" method="post" id="addDomainForm">
				<div class="col-md-6">
					<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Add Sales Location</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label>Sales Location name</label>                                       
									<input type="text" required="required" class="form-control" name="sales_name" placeholder="Item Name" />
								</div>
								<div class="form-group">
									<label>Sales Location</label>                                         
									<textarea required="required" class="form-control" name="sales_location" placeholder="Item Description"></textarea>
									<input type="hidden" name="byepass" value="TBUG4fw24RE6CV6ru7Y8Y8" />
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" id="addDomainButton" class="btn btn-primary"><i class="fa fa-plus"></i> Add Sales Location</button>
							</div>
							<center><span id="message_for_addDomain"></span></center>
						 </div>
						
				</div>
			</form>';
	}
	
	public function edit_domain_form($object_pass) {
			$general = new general();
		print '<form role="form" action="" method="post" id="updateDomainForm">
				<div class="col-md-6">
					<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Update Sales Location</h3>
							</div>
							<div class="box-body">

								<div class="form-group">
									<label>Name</label>                                         
									<input type="text" class="form-control" required="required" value="'.@$object_pass->tuition_codes_domain_name.'" name="domain_name">
								</div>
								<div class="form-group">
									<label>Location</label>                                         
									<textarea class="form-control" required="required" name="domain_location">'.@$object_pass->tuition_codes_domain_location.'</textarea>
									<input type="hidden" name="passingId" value="'.@$object_pass->tuition_codes_domain_id.'" />
									<input type="hidden" name="byepass" value="TBUG4fw24RE6CV6ru7Y8Y8" />
								</div>
							</div>
						<div class="box-footer">
							<button type="submit" id="updateDomainButton" class="btn btn-primary">Update Sales Location</button>
						</div>
						<center><span id="message_for_updateDomain"></span></center>
					</div>
					
				</div>
			</form>';
	}
}

$myshopForms = new shopForms();
?>