var askToDelete = function(aid = null) {

    var url = "/artikel/manager/background/delete";

    title = 'Delete Confirmation';
    content = 'Do you really want to delete this';

	swal({
        title: "Delete Confirmation",
        text: content,
        type: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        animation: true,
        customClass: "",
    }).then(function () {

        //show loading.
        $('.loading').css("display", "block");

        //ajax post.
        $.ajax({
            type: "post",
            url: url,
            cache: false,
            data: {
                id: aid,
            },
            dataType: 'json',
            success: function(data) {
                //stop loading.
                if(data.is_error == true ) {
            	   swal("Error!", data.error_msg, "error");
                } else {
                	//succes
					$.smallBox({
                            title: '<strong>' + data['notif_title'] + '</strong>',
                            content: data['notif_message'],
                            color: "#659265",
                            iconSmall: "fa fa-check fa-2x fadeInRight animated",
                            timeout: 1000
                        }, function() {
                        //reload table
					    location.reload();			             
		            });
                }
            },
            error: function() {
                //stop loading.
                $('.loading').css("display", "none");
            }
        });
    }).catch(swal.noop);
}

$(document).ready(function () {
	// delete_article();
	/* COLUMN FILTER  */
    var responsiveHelper_datatable_fixed_column = undefined;

    var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};

    var url = "/artikel/manager/background/list_all_data";

    var otable = $('#dataTable');

	    if(otable.length > 0) {
	    	$(otable).dataTable({
	    	 "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" + "t" + "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            "aaSorting": [[2, "desc"]],
            "iDisplayLength" : 10,
            "sPaginationType": "full_numbers",
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": url,
			"aoColumns" : [
				{"sTitle" : "No", "mData" : "slider_id"},
				{
					"sTitle" : "Gambar", 
					"mData" : null,
					"bSortable" : false,
					"mRender" : function(data, type, full) {
						if(full.image != null) {
							var path_image = "/artikel" + full.image;
							var data = 
	                            '<a href="'  + path_image + '" data-lightbox="roadtrip"><img src="' + path_image + '" width=300 height=100></a>'; 
						} else {
							var data = '<img src="/artikel/asset/images/pejuangsubuh.jpg" width=300 height=100>';
						}
						return data;
					}
				},
				{"sTitle" : "Penulis", "mData" : "username"},
				{"sTitle" : "Deskripsi" , "mData" : "description"},
				{"sTitle" : "Status" , "mData" : "status_name"},
				{
					"sTitle" : "Action" , "sClass" : "center", "mData" : null,
					"bSortable" : false,
					"mRender" : function(data ,type, full) {
						var button = '<td>';
						if(full.status == 1) {
							button += '<a class="btn btn-info btn-circle" href="/artikel/manager/background/edit/' + full.slider_id + '"><i class="fa fa-pencil"></i></a>';
							button += '<a class="btn btn-danger btn-circle" href="javascript:askToDelete('+ full.slider_id +'); " ><i class="fa fa-trash"></i></a>';
						}

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
	    // $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
	    
	    //setup before functions
	    var typingTimer;                //timer identifier
	    var doneTypingInterval = 800;  //time in ms, 1 second for example
	    // Apply the filter
	    $("#DataTable thead th input[type=text]").on( 'keyup change', function () {

		    	clearTimeout(typingTimer);
			        typingTimer = setTimeout(function () {
			            $(table_id).dataTable().fnClearTable();
		        }, doneTypingInterval);
		    	
	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	            
	    } );
	}
});