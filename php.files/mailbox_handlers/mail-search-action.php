    <div class="row pad">
        <div class="col-sm-6">
           <!--  <label style="margin-right: 10px;">
                <input type="checkbox" id="check-all"/>
            </label>
            Action button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
           <?php if (@$_GET['folder'] == 'inbox') {
			   print '<li class="click_ult"><button type="submit" name="mass_mark_as_read" class="btn btn-default btn-block">
			   <i class="fa fa-thumbs-o-up"></i> Mark as read</button></li>
                <li class="click_ult"><button type="submit" name="mass_mark_as_unread" class="btn btn-default btn-block">
				<i class="fa fa-thumbs-o-down"></i> Mark as unread</button></li><li class="divider"></li>';
		   }?>
                
           <?php if (@$_GET['folder'] == 'junk') {
           	print '<li class="click_ult"><button type="submit" name="mass_restore_junk" class="btn btn-default btn-block">
           <i class="fa fa-level-up"></i> Restore To Folder</button></li>';
           } else {
			print '<li class="click_ult"><button type="submit" name="mass_move_to_junk" class="btn btn-default btn-block">
           <i class="fa fa-archive"></i> Move to junk</button></li>';   
		   }
		   ?>
                    <li class="divider"></li>
                    <li class="click_ult"><button type="submit" name="mass_delete" class="btn btn-default btn-block">
                    <i class="fa fa-trash-o"></i> Delete Permanently</button></li>
                </ul>
            </div>
    
		<a href="?folder=inbox" class="btn btn-default btn-sm click_ult"><i class="fa fa-repeat"></i> Refresh Inbox</a>
	
        </div>
        <div class="col-sm-6 search-form">
            <form action="#" class="text-right">
                <div class="input-group">                                                            
                    <input type="text" class="form-control input-sm" placeholder="Search">
                    <div class="input-group-btn">
                        <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>                                                     
            </form>
        </div>
    </div><!-- /.row -->