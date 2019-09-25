 <div class="row" id="health_table">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"> Select One Health Category to View</h3>                                    
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
			<form action="#health_table" method="post">
				<button type="submit" name="h_a" class="btn bg-red text-white click_ult" style="margin:5px 0 5px 10px"><i class="fa fa-ambulance"></i> Allergy History</button>
				<button type="submit" name="h_i" class="btn bg-olive text-white click_ult" style="margin:5px 0 5px 10px"><i class="fa fa-user-md"></i> Immunization History</button>
				<button type="submit" name="h_h" class="btn bg-maroon text-white click_ult" style="margin:5px 0 5px 10px"><i class="fa fa-hospital-o"></i> Health History</button>
			</form>	
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>

	<?php 
			
		if (isset($_POST['h_a'])) {
			$health_retriever->get_allergy($decode_std_id);
		} 

		if (isset($_POST['h_i'])) {
			$health_retriever->get_immunz($decode_std_id);
		} 
		
		if (isset($_POST['h_h'])) {
			$health_retriever->get_health_history($decode_std_id);
		}
	

	?>