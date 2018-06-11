var askToDelete = function(aid = null) {
    
    var data_name = $(this).data("name");

    var url = "/artikel/manager/tag/delete";

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
    $(document).ready(function () {
    var responsiveHelper_dt_basic = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    var table = $("#dataTable");
    var url = "/artikel/manager/tag/list_all_data";

    // Check if div exist
    if(table.length > 0) {
        $(table).dataTable({
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
            "bSortable" : true,
            "sAjaxSource": url,
            "aoColumns": [
                {"sTitle": "ID", "mData": "tag_id"},
                {"sTitle": "Tag", "mData": "name"},
                {
                    "sTitle" : "Action" , "sClass" : "center", "mData" : null,
                    "bSortable" : false,
                    "mRender" : function(data ,type, full) {
                        var button = '<td>';
                        if(full.status == 1) {
                            button += '<a class="btn btn-info btn-circle" href="/artikel/manager/tag/edit/' + full.tag_id + '"><i class="fa fa-pencil"></i></a>';
                            button += '<a class="btn btn-danger btn-circle" href="javascript:askToDelete('+ full.tag_id +'); " data-name="'+ full.name +'"><i class="fa fa-trash"></i></a>';
                        }
                        button += '</td>';
                        return button;
                    }
                },
            ],
            "preDrawCallback" : function() {
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dataTable'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });
    }
});