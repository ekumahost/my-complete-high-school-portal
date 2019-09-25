function highlightRow(rowId, bgColor, after)// this is for teacher management
{
	var rowSelector = $("#" + rowId);
	rowSelector.css("background-color", bgColor);
	rowSelector.fadeTo("normal", 0.5, function() { 
		rowSelector.fadeTo("fast", 1, function() { 
			rowSelector.css("background-color", '#BFE8C5');// HILIGHT ANY CHANGED ROW WITH LIGHT GREEN
			//rowSelector.css("background-color", '');
		});
	});
}

function highlight(div_id, style) {
	highlightRow(div_id, style == "error" ? "#e5afaf" : style == "warning" ? "#ffcc00" : "#8dc70a");
}
        


// create our editable grid
var editableGrid = new EditableGrid("grade_history_primary", {
	enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
	editmode: "absolute", // change this to "fixed" to test out editorzone, and to "static" to get the old-school mode
	editorzoneid: "edition", // will be used only if editmode is set to "fixed"
	pageSize: 5,
	maxBars: 50
});

// helper function to display a message
function displayMessage(text, style) { 
	_$("message").innerHTML = "<p class='" + (style || "ok") + "'>" + text + "</p>"; 
} 

// helper function to get path of a demo image
function image(relativePath) {
	return "images/" + relativePath;
}

// this will be used to render our table headers
function InfoHeaderRenderer(message) { 
	this.message = message; 
	this.infoImage = new Image();
	this.infoImage.src = image("information.png");
};

InfoHeaderRenderer.prototype = new CellRenderer();
InfoHeaderRenderer.prototype.render = function(cell, value) 
{
	if (value) {
		// here we don't use cell.innerHTML = "..." in order not to break the sorting header that has been created for us (cf. option enableSort: true)
		var link = document.createElement("a");
		link.href = "javascript:alert('" + this.message + "');";
		link.appendChild(this.infoImage);
		cell.appendChild(document.createTextNode("\u00a0\u00a0"));
		cell.appendChild(link);
	}
};

// this function will initialize our editable grid
EditableGrid.prototype.initializeGrid = function() 
{
	with (this) {

	
		addCellValidator("exam_score", new CellValidator({ 
			isValid: function(value) { return value == "" || (parseInt(value) >= 0 && parseInt(value) < 100); }
		}));
		
		addCellValidator("ca_score", new CellValidator({ 
			isValid: function(value) { return value == "" || (parseInt(value) >= 0 && parseInt(value) < 100); }
		}));
		
		
		
		
		
		
		
		
		// register the function that will handle model changes: 
		modelChanged = function(rowIndex, columnIndex, oldValue, newValue, row, onResponse) { 
		
		// HANDLE HTTP REQUEST HERE TO UPDATE TABLE: WOO WOO WHENEVER HE CHANGES A COLUMN, LETS UPDATE THE DB
		// all these var we define here is of no use, just for debugging. delete now!
		var tablename = editableGrid.name; // studentbio
		var colname = this.getColumnName(columnIndex);// firstname
	     var id = editableGrid.getRowId(rowIndex); // id 56
         var coltype = this.getColumnType(columnIndex);// for firstname its string
		




$.ajax({// httprequest will post the new data to the server to update db
		url: 'update.php',
		type: 'GET',
		dataType: "html",
		data: {
			tablename : editableGrid.name,
			id: editableGrid.getRowId(rowIndex), 
			newvalue: editableGrid.getColumnType(columnIndex) == "boolean" ? (newValue ? 1 : 0) : newValue, 
			colname: this.getColumnName(columnIndex),
			coltype: this.getColumnType(columnIndex)			
		},
		success: function (response) 
		{ 
			// reset old value if failed then highlight row with red color
			var success = onResponse ? onResponse(response) : (response == "ok" || !isNaN(parseInt(response))); // by default, a sucessfull reponse can be "ok" or a database id 
			if (!success) editableGrid.setValueAt(rowIndex, columnIndex, oldValue);
		    highlight(row.id, success ? "ok" : "error"); 
			
				//	alert(colname); alert(tablename); alert(id); alert(coltype);

			//alert("we just saved the data");// BROTHER, THIS HTTP REQUEST IS NOT RETURNING ANY ERROR MESSAGE ON FAILURE
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true // yea, so the admin wont kknow what we are doing go asynchronous
	});




		
			displayMessage("Value for '" + this.getColumnName(columnIndex) + "' for Student with serial number " + this.getRowId(rowIndex) + " has changed from '" + oldValue + "' to '" + newValue + "'");
		
			this.renderCharts();
		};
		
		// update paginator whenever the table is rendered (after a sort, filter, page change, etc.)
		tableRendered = function() { this.updatePaginator(); };

		// update charts when the table is sorted or filtered
		tableFiltered = function() { this.renderCharts(); };
		tableSorted = function() { this.renderCharts(); };

		rowSelected = function(oldRowIndex, newRowIndex) {
			if (oldRowIndex < 0) displayMessage("Selected student id: '" + this.getRowId(newRowIndex) + "'");
			else displayMessage("Selected Result id has changed from '" + this.getRowId(oldRowIndex) + "' to '" + this.getRowId(newRowIndex) + "'");
		};
		
		rowRemoved = function(oldRowIndex, rowId) {
			displayMessage("hidden row '" + oldRowIndex + "' - ID = " + rowId);
		};
		
		// render for the action column
		setCellRenderer("action", new CellRenderer({render: function(cell, value) {
			// this action will remove the row, so first find the ID of the row containing this cell 
			var rowId = editableGrid.getRowId(cell.rowIndex);
			// we can folow link to edit specific student here
			cell.innerHTML = "<a onclick=\"if (confirm('Are you sure you want to hide this student ? ')) { editableGrid.remove(" + cell.rowIndex + "); editableGrid.renderCharts(); } \" style=\"cursor:pointer\">" +
							 "<img src=\"" + image("delete.png") + "\" border=\"0\" alt=\"delete\" title=\"Hide Student\"/></a>";
			
			cell.innerHTML+= "&nbsp;<a onclick=\"editableGrid.duplicate(" + cell.rowIndex + ");\" style=\"cursor:pointer\">" +
			 "<img src=\"" + image("duplicate.png") + "\" border=\"0\" alt=\"duplicate\" title=\"Duplicate row\"/></a>";
			
		}})); 
		
		
		
		
		
		
		
		
		
		// render the grid (parameters will be ignored if we have attached to an existing HTML table)
		renderGrid("tablecontent", "testgrid", "tableid");
		
		// set active (stored) filter if any
		_$('filter').value = currentFilter ? currentFilter : '';
		
		// filter when something is typed into filter
		_$('filter').onkeyup = function() { editableGrid.filter(_$('filter').value); };
		
		// bind page size selector
		$("#pagesize").val(pageSize).change(function() { editableGrid.setPageSize($("#pagesize").val()); });
		$("#barcount").val(maxBars).change(function() { editableGrid.maxBars = $("#barcount").val(); editableGrid.renderCharts(); });
	}
};

EditableGrid.prototype.onloadXML = function(url) 
{
	// register the function that will be called when the XML has been fully loaded
	this.tableLoaded = function() { 
		displayMessage("DATA loaded from database: " + this.getRowCount() + " Results(s)"); 
		this.initializeGrid();
	};

	// load XML URL
	this.loadXML(url);
};

EditableGrid.prototype.onloadJSON = function(url) 
{
	// register the function that will be called when the XML has been fully loaded
	this.tableLoaded = function() { 
		displayMessage("Grid loaded from JSON: " + this.getRowCount() + " row(s)"); 
		this.initializeGrid();
	};

	// load JSON URL// not working here
	this.loadJSON(url);
};




// function to render our two demo charts
EditableGrid.prototype.renderCharts = function() 
{
	this.renderBarChart("barchartcontent", 'Rating per Courses' + (this.getRowCount() <= this.maxBars ? '' : ' (first ' + this.maxBars + ' Courses out of ' + this.getRowCount() + ')'), 'course_code', { limit: this.maxBars, bar3d: false, rotateXLabels: this.maxBars > 1 ? 270 : 0 });
	
	this.renderPieChart("piechartcontent", 'Exam Score Distribution', 'ca_score', 'exam_score');
};

// function to render the paginator control
EditableGrid.prototype.updatePaginator = function()
{
	var paginator = $("#paginator").empty();
	var nbPages = this.getPageCount();

	// get interval
	var interval = this.getSlidingPageInterval(20);
	if (interval == null) return;
	
	// get pages in interval (with links except for the current page)
	var pages = this.getPagesInInterval(interval, function(pageIndex, isCurrent) {
		if (isCurrent) return "" + (pageIndex + 1);
		return $("<a>").css("cursor", "pointer").html(pageIndex + 1).click(function(event) { editableGrid.setPageIndex(parseInt($(this).html()) - 1); });
	});
		
	// "first" link
	var link = $("<a>").html("<img src='" + image("gofirst.png") + "'/>&nbsp;");
	if (!this.canGoBack()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { editableGrid.firstPage(); });
	paginator.append(link);

	// "prev" link
	link = $("<a>").html("<img src='" + image("prev.png") + "'/>&nbsp;");
	if (!this.canGoBack()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { editableGrid.prevPage(); });
	paginator.append(link);

	// pages
	for (p = 0; p < pages.length; p++) paginator.append(pages[p]).append(" | ");
	
	// "next" link
	link = $("<a>").html("<img src='" + image("next.png") + "'/>&nbsp;");
	if (!this.canGoForward()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { editableGrid.nextPage(); });
	paginator.append(link);

	// "last" link
	link = $("<a>").html("<img src='" + image("golast.png") + "'/>&nbsp;");
	if (!this.canGoForward()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { editableGrid.lastPage(); });
	paginator.append(link);
};
