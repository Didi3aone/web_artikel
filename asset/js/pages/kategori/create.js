$(document).ready(function () {
	var form = $('#category-create');
    var submit = $('#category-create button[type="submit"]');

    $(form).validate( {
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

        // Rules for form validation
        rules: {
            name: {
                required: true,
            },
        },

        // Messages for form validation
        messages: {},

        // Ajax form submition.
        submitHandler: function(form) {
            $(form).ajaxSubmit( {
                dataType: 'json',
                beforeSend: function() {
                    $(submit).attr('disabled', true);
                    $('.loading').css("display", "block");
                },
                success: function(data) {
                    $('.loading').css("display", "none");

                    if(data['is_error']) {
                        swal("Oops!", data['error_msg'], "error");
                        $(submit).attr('disabled', false);
                    } 
                    else {
                        if (data['redirect_to'] == "") {
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
                    $('.loading').css("display", "none");
                    $(submit).attr('disabled', false);
                    swal("Oops!", "Something went wrong.", "error");
                }
            });
        },
        // Do not change code below
        errorPlacement: function(error, element)
        {
            error.insertAfter(element);
        }
    });
});