$(document).ready(function() {
	var form = $('#form-login');
	var submit = $('#form-login .btn-submit');

	$(form).validate ( {
		errorClass: 'invalid',
		errorElement : 'em',

		highlight : function(element) {
			$(element).parent().removeClass('state-success').addClass('state-error');
			$(element).removeClass('valid');
		},

		unhighlight: function(element) {
			$(element).parent().removeClass("state-error").addClass("state-success");
			$(element).addClass('valid');
		},

		rules: {
			username: {
				required:true,
			},
			password: {
				required: true,
			},
		},

		messages:{},

		submitHandler: function(form) {
			$(form).ajaxSubmit ( {
				dataType: 'json',
				beforeSend: function() {
					$(submit).attr('disabled', false);
					// $('.loading').css("display","block");
				},
				success: function (data) {
					// $('.loading').css('display','none');

					if(data['is_error']) {
						swal("Oops", data['error_msg'],"error");
					    // $('.loading').css('display','none');
					} else {
						if(data['redirect_to'] == "") {
							$(form)[0].reset();
							$(submit).attr('disabled', false);
						}
						else {
							$(form)[0].reset();
							$(submit).attr('disabled', false);
							location.href = data['redirect_to'];
						}
					}
				},
				error: function() {
					// $('.loading').css('display','none');
					$(submit).attr("disabled",false);
					swal("Oops!","Something went wrong.","error");
				}
			});
		},
		errorPlacement: function(error, element)
		{
			error.insertAfter(element);
		}
	});

	$("#forgotpass-form").validate({
		rules: {
			email: {
				required:true,
				email:true,
			}
		},

		messages: { },
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent());
		}
	});
});