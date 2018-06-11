$(document).ready(function () {
/* COLUMN FILTER  */
    var responsiveHelper_datatable_fixed_column = undefined;

    var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};

    var url = "/artikel/manager/user/list_all_data";

    var otable = $('#dataTable');

	    if(otable.length > 0) {
	    	$(otable).dataTable({
	    	 "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" + "t" + "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
            },
            "aaSorting": [[2, "desc"]],
            "iDisplayLength" : 50,
            "sPaginationType": "full_numbers",
            "bProcessing": false,
            "bServerSide": true,
            "sAjaxSource": url,
			"aoColumns" : [
				{"sTitle" : "ID", "mData" : "user_id"},
				{"sTitle" : "Nama", "mData" : "name"},
				{"sTitle" : "Posisi", "mData" : "role_name"},
				
				{
					"sTitle" : "Action" , "sClass" : "center", "mData" : null,
					"bSortable" : false,
					"mRender" : function(data ,type, full) {
						var button = '<td>';
						// if(full.status == 0) {
							button += '<a class="btn btn-info btn-circle" href="/artikel/admin/article/edit/' + full.artikel_id + '"><i class="fa fa-pencil"></i></a>';
						// }

						button += '</td>';
						return button;
					}
				}
			],
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($(otable), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			}		
		
	    });
	    
	    // custom toolbar
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
	    	   
	    // Apply the filter
	    $("#DataTable thead th input[type=text]").on( 'keyup change', function () {
	    	
	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	            
	    } );
	}
});