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
				name:
				{
					required: true,
				},
				username: 
				{
					required: true,
					minlength: 3,
					maxlength: 100,
				},
				email:
				{
					required:true,
					email:true,
				},
				password: 
				{
					required: true,
					minlength: 6,
					maxlength: 20,
				},
				conf_password: 
				{
					required: true,
					minlength: 6,
					maxlength: 20,
					equalTo: "#password",
				},
				new_password :
				{
					minlength: 6,
					maxlength: 20,
				},
				conf_new_password: 
				{
					minlength: 6,
					maxlength: 20,
					equalTo: "#new_password"
				}
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

$(document).ready(function() {
	validate();
	validate_level();
	role();
});

function validate_level() {
	var form = $("#level-form");
	var submit = $("#level-form .btn-submit");


	$(form).validate({
		highlight: function(element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },

	    unhighlight: function(element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
	    },

	    rules:
			{
				name:
				{
					required: true,
				},
			},

		messages: { },

		submitHandler: function (form) {
			$(form).ajaxSubmit( {
				dataType: 'json',
				beforeSend: function() {
					$(submit).attr('disabled', false);
					$('.loading').css("display", "block");
				},
				success: function(data) {
					if(data['is_error']) {
						swal("Oops", data['error_msg'], "error");
					} else {

						if(data['is_error'] == false) {

							swal("success",data['notif_title'], "success");
							setTimeout(function(){
						        window.location.reload();
							}, 2000);
						}
					}
				}, error: function() {
						$('.loading').css("display","none");
						$(submit).attr('disabled', false);
					},
			}); 
		}, errorPlacement: function(error, element) {
			error.insertAfter(element.parent());
			swal("Oops", "Something went wrong.", "error");
		},
	});
}

function role() {
		//select2 for gudang.
		var element = $("#role")
	    $(element).select2({
	        ajax: {
	            url: "/artikel/admin/user/list_select_role",
	            dataType: "json",
	            delay: 500,
	            data: function(params) {
	                return {
	                    q: params.term,
	                    page: params.page,
	                };
	            },
	            processResults: function(data, params) {

	                params.page = params.page || 1;

	                return {
	                    results: $.map(data.get, function(item) {
	                        return {
	                            text: item.role_name,
	                            id: item.role_id,
	                        }
	                    }),
	                    pagination: {
	                        more: (params.page * data.paging_size) < data.total_data,
	                    }
	                };
	            },
	            cache: true,
	        },
	        minimumInputLength: 0,
	        allowClear: true,
	        placeholder: "Pilih Role",
	        tags: false,
	        maximumSelectionLength: 1,
	    });
	}