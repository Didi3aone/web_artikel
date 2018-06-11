$(document).ready(function() {
    //init function
    validate();
    tinymceinit();
    kategori();

    $("#addimage").click(function () {
    	var image_size = $(this).data("maxsize");
    	var words_max_upload = $(this).data("maxwords");
    	imageCropper ({
            target_form_selector : "#form",
            file_input_name : "image-file",
            data_crop_name : "data-image",
            image_ratio : 640/640,
            button_trigger_selector : "#addimage",
            image_preview_selector : ".add-image-preview",
            placeholder_path : "/artikel/asset/img/placeholder/640x640.png",
            max_file_size : image_size,
            words_max_file_size : words_max_upload,
        });
    });

    $(function() {
	    $('#periode_start').daterangepicker({
	        timePicker: true,
	        timePickerIncrement: 30,
	        singleDatePicker: true,
	        locale: {
	            format: 'MM/DD/YYYY h:mm A'
	        }
	    });
	});

	$(function() {
	    $('#periode_end').daterangepicker({
	        timePicker: true,
	        timePickerIncrement: 30,
	        singleDatePicker: true,
	        locale: {
	            format: 'MM/DD/YYYY h:mm A'
	        }
	    });
	});

	//$('input[name="periode_end"]').val("#periode_start");

    // $('.datepickers').datepicker();
    // $("#periode_start").datepicker({
    //     defaultDate: "+1w",
    //     changeMonth: true,
    //     numberOfMonths: 1,
    //     prevText: '<i class="fa fa-chevron-left"></i>',
    //     nextText: '<i class="fa fa-chevron-right"></i>',
    //     onClose: function (selectedDate) {
    //         $("#periode_end").datepicker("option", "minDate", selectedDate);
    //     }

    // });
    // $("#periode_end").datepicker({
    //     defaultDate: "+1w",
    //     changeMonth: true,
    //     numberOfMonths: 1,
    //     prevText: '<i class="fa fa-chevron-left"></i>',
    //     nextText: '<i class="fa fa-chevron-right"></i>',
    //     // onClose: function (selectedDate) {
    //     //     $("#available_to_date").datepicker("option", "minDate", selectedDate);
    //     // }
    // });

});
    

    function tinymceinit() {

	    tinymce.init({
	        selector: '.tinymce',
	        menubar: false,
	        allow_script_urls: true,
	        plugins: [
	          "code fullscreen preview table visualblocks contextmenu responsivefilemanager link image media",
	          "table hr textcolor lists "
	        ],
	        height: 400,
	        toolbar1: "bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | styleselect formatselect fontsizeselect",
	        toolbar2: "link unlink image responsivefilemanager media code | bullist numlist outdent indent | removeformat table hr",
	        image_advtab: true ,
	        extended_valid_elements: "a[href|onclick]",
	        external_filemanager_path:"/artikel/asset/js/plugins/filemanager/",
	        filemanager_title:"Responsive Filemanager" ,
	        external_plugins: { "filemanager" : "/artikel/asset/js/plugins/filemanager/plugin.min.js"},
	        media_url_resolver: function (data, resolve/*, reject*/) {
	            if (data.url.indexOf('youtube') !== -1) {
	                var id_youtube = getIdYoutube(data.url);
	                var embedHtml = "<div class='embed-responsive embed-responsive-16by9'>" +
	                                    '<iframe class="embed-responsive-item" src="//www.youtube.com/embed/' + id_youtube + '" allowfullscreen></iframe>'+
	                                "</div>";
	                resolve({html: embedHtml});
	            } else {
	                resolve({html: ''});
	            }
	        }
	    });
	}
	
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
				jadwal_name:
				{
					required: true,
				},
				jadwal_location: {
					required:true,
				},
				jadwal_start_date: 
				{
					required: true,
				},
				jadwal_end_date:
				{
					required:true,
				},
			},
			//messages
			messages:
			{
			    jadwal_name:
				{
					required: "Nama harus diisi",
				},
				jadwal_location:
				{
					required: "Lokasi harus diisi",
				},
				jadwal_start_date:
				{
					required: "Start date harus diisi",
				},
				jadwal_end_date: {
					required:"end harus diisi",
				}
			},
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
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
				error.insertAfter(element.parent());
				swal("Oops", "Something went wrong.", "error");
			},
		});
	}

	function kategori() {
		//select2 for gudang.
		var element = $("#kategori")
	    $(element).select2({
	        ajax: {
	            url: "/artikel/manager/jadwal/list_kategori",
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
	                    results: $.map(data.datas, function(item) {
	                        return {
	                            text: item.kategori_name,
	                            id: item.jadwal_kategori_id,
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
	        placeholder: "Pilih Kategori",
	        tags: false,
	        maximumSelectionLength: 1,
	    });
	}