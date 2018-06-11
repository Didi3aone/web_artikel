$(document).ready(function() {

	$(".submit-form").on("click", function() {
		var fromId = $(this).data("form-target");
		$("#" + formId).submit();
	});
});
/**
 * ajax submit
 */

 /**
 * This function handles the ajax submission.
 * requires the form object and optional extraData to be sent.
 */
var formAjaxSubmit = function(form, extraData) {
    $(form).ajaxSubmit({
        dataType: 'json',
        //clearForm: true,
        //resetForm: true,
        type: 'post',
        data: extraData,
        beforeSend: function() {
            $('.btn .back-button, .btn .submit-form, .btn .edit-button, .btn .delete-button, .btn .reactivate-button').attr('disabled', true);
            $('.loading').css("display", "block");
        },
        success: function(data) {
            $('.loading').css("display", "none");

            $(document).trigger("form-ajax-submit:ajaxsuccess", [form, data]);

            //validate if success or not.
            if (data['is_error']) {
                //error in something.
                swal("Oops!", data['error_msg'], "error");
                $('.btn .back-button, .btn .submit-form, .btn .edit-button, .btn .delete-button, .btn .reactivate-button').attr('disabled', false);
                $(document).trigger("form-ajax-submit:error", [form, data]);

            } else {
                //success.
                $(form).resetForm();

                $.smallBox({
                    title: '<strong>' + data['notif_title'] + '</strong>',
                    content: data['notif_message'],
                    color: "#659265",
                    iconSmall: "fa fa-check fa-2x fadeInRight animated",
                    timeout: 1000
                }, function() {

                    $(document).trigger("form-ajax-submit:success", [form, data]);

                    //redirect to
                    if (data['redirect_to'] == "") {
                        $('.btn .back-button, .btn .submit-form, .btn .edit-button, .btn .delete-button, .btn .reactivate-button').attr('disabled', false);
                        $(".state-success").removeClass("state-success");

                    } else {
                        go(data['redirect_to']);
                    }
                });
            }
        },
        error: function() {
            $('.loading').css("display", "none");
            $('.btn .back-button, .btn .submit-form, .btn .edit-button, .btn .delete-button, .btn .reactivate-button').attr('disabled', false);
            swal("Sorry!", "Something went wrong.", "error");
            $(document).trigger("form-ajax-submit:failed", form);
        }
    });
};