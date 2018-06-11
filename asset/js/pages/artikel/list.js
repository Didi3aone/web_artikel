var askToDelete = function(aid = null) {
    var data_name = $(this).data("name");

    var url = "/artikel/manager/article/delete";

    title = 'Delete Confirmation';
    content = 'Do you really want to delete ' + data_name + ' ?';

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
                console.log("error");

                //stop loading.
                $('.loading').css("display", "none");
            }
        });
    }).catch(swal.noop);
}

$(document).on("click", ".delete-confirm", function(e) {
	e.stopPropagation();
    e.preventDefault();

    var data_name = $(this).data("name");

    var url = "/artikel/manager/article/delete";

    title = 'Delete Confirmation';
    content = 'Do you really want to delete ' + data_name + ' ?';

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
                console.log("error");

                //stop loading.
                $('.loading').css("display", "none");
            }
        });
    }).catch(swal.noop);
});

$(document).ready(function () {
	// delete_article();
	/* COLUMN FILTER  */
    var responsiveHelper_datatable_fixed_column = undefined;

    var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};

    var url = "/artikel/manager/article/list_all_data";

    var otable = $('#dataTable').dataTable({

	    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" + "t" + "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        "aaSorting": [[2, "desc"]],
        "iDisplayLength" : 50,
        "sPaginationType": "full_numbers",
        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": url,
		"aoColumns" : [
				{"sTitle" : "No", "mData" : "artikel_id"},
				{"sTitle" : "Judul Artikel", "mData" : "artikel_judul"},
				{"sTitle" : "Di Buat" , "mData" : "artikel_created_date"},
				{"sTitle" : "Penulis", "mData" : "username"},
				{
					"sTitle" : "Gambar", 
					"mData" : null,
					"bSortable" : false,
					"mRender" : function(data, type, full) {
						if(full.artikel_photo != null) {
							var path_image = "/artikel" + full.artikel_photo;
							var data = 
	                            '<a href="'  + path_image + '" data-lightbox="roadtrip"><img src="' + path_image + '" width=300 height=100></a>'; 
						} else {
							var data = '<img src="/artikel/asset/images/pejuangsubuh.jpg" width=300 height=100>';
						}
						return data;
					}
				},
				{"sTitle" : "Status", "mData" : "status_name"},
				{
					"sTitle" : "Action" , "sClass" : "center", "mData" : null,
					"bSortable" : false,
					"mRender" : function(data ,type, full) {

						var button = '<td>';
							button += '<a class="btn btn-primary btn-circle" href="/artikel/manager/article/edit/' + full.artikel_id + '" rel="tooltip" title="Edit Article"><i class="fa fa-pencil"></i></a> &nbsp;';
							button += '<a class="btn btn-info btn-circle" href="/artikel/manager/article/detail/' + full.artikel_id + '" rel="tooltip" title="View Article"><i class="fa fa-eye"></i></a> &nbsp;';
							button += '<a class="btn btn-danger btn-circle delete-confirm" data-name="'+ data.artikel_judul +'" href="" rel="tooltip" title="Delete Article"><i class="fa fa-trash"></i></a> &nbsp;';
						button += '</td>';
						return button;
					}
				}
			],
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($("#dataTable"), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			}		
		
	    });
	    
	    // Apply the filter
    $("#dataTable thead th input[type=text]").on( 'keyup change', function () {
    	
        otable
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
            
	});
});