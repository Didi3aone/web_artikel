$(document).ready(function(){
	$("#addimage").click(function () {
    	var image_size = $(this).data("maxsize");
    	var words_max_upload = $(this).data("maxwords");
    	imageCropper ({
            target_form_selector : "#form",
            file_input_name : "image-file",
            data_crop_name : "data-image",
            image_ratio : 540/350,
            button_trigger_selector : "#addimage",
            image_preview_selector : ".add-image-preview",
            placeholder_path : "/artikel/asset/img/placeholder/540x350.png",
            max_file_size : image_size,
            words_max_file_size : words_max_upload,
        });
    });

    $("#mymarkdown").markdown({
		autofocus:false,
		savable:false
	});

	validate();
});

function validate() {
	
	var form = $("#form");	
	var submit = $("#form .btn-submit");

	$(form).validate({
		errorClass      : 'invalid',
        errorElement    : 'em',

        highlight: function(element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },

        unhighlight: function(element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },
		//rules form validation
		rules:
		{
			desc:
			{
				required: true,
			},
		},
		//messages
		messages:
		{ },
		//ajax form submition
		submitHandler: function(form)
		{
			$(form).ajaxSubmit({
				dataType: 'json',
				beforeSend: function()
				{
					$(submit).attr('disabled', true);
					$('.loading').css("display", "block");
				},
				success: function(data)
				{
					//validate if error
					$('.loading').css("display","none");
					if(data['is_error']) {
						swal("Oops!", data['error_msg'], "error");
						$(submit).attr('disabled', false);
					} 
					else {
						//succes
						$.smallBox({
                                title: '<strong>' + data['notif_title'] + '</strong>',
                                content: data['notif_message'],
                                color: "#659265",
                                iconSmall: "fa fa-check fa-2x fadeInRight animated",
                                timeout: 1000
                            }, function() {
		                	if(data['redirect_to'] == "") {
		                		$(form)[0].reset();
		                		$(submit).attr('disabled', false);
		                	} else {
							    
						       location.href = data['redirect_to'];
			                }
			            });
                	}					
				},
				error: function() {
					$('.loading').css("display","none");
					$(submit).attr('disabled', false);
				}
			});
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent());
			swal("Oops", "Something went wrong.", "error");
		},
	});
}
