$(document).on('click', '.publish', function(e) {
    e.stopPropagation();
    e.preventDefault();

    var data_name = $(this).data("name");
    var data_id   = $(this).data("id");

    var url = "/artikel/manager/article/publish_artikel";

    title = 'publish confirmation';
    content = 'Do you really want to publish ' + data_name + ' ?';

	swal({
        title: title,
        text: content,
        type: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, publish it!",
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
                id: data_id,
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
					    location.href = data['redirect_to'];	             
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