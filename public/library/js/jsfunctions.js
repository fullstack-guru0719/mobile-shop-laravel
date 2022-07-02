var base_url = $('body').attr('data-url');
var base_url2 = $('body').attr('data-current-url');
var page_lang = $('body').attr('data-lang');


/*********************************************/
/*	 FOR CHANGING LANGUAGE
/*********************************************/
$(document).on('change', '#select_language', function () {
    translator2();
});
$(document).on('change', '#select_language2', function () {
    translator3();
});


function getAdviceDetails(hashid) 
{
	$('#modal-lawyeradvice-lawyer-name, #modal-lawyeradvice-price, #modal-lawyeradvice-lawyer-avatar, .modal-lawyeradvice-paidadvice').html('');
	$('.btn-modal-pay-advice').removeAttr('data-attr-id');
	var div_for_attachment = '';
	$.ajax({
		url: base_url+'/client/advice/show/'+hashid,
		type: 'GET',
		dataType: 'json',
		success: function (result) {
    		$('#modal-show-advice').modal();
			$('#modal-lawyeradvice-lawyer-name').html('<b>'+result.advices.lawyer.name+'</b>');
			$('#modal-lawyeradvice-price').html('Price: '+result.advices.format_price+' AED');
			$('#modal-lawyeradvice-lawyer-avatar').removeClass('hideme');
			if (result.advices.lawyer.logo == '') {
				$('#modal-lawyeradvice-lawyer-avatar').html('<img src="http://lawsheroes.com//library/image/user-gray.png" class="img-circle height-70 width-100p">');
			} else {
				$('#modal-lawyeradvice-lawyer-avatar').html('<img src="http://lawsheroes.com/'+result.advices.lawyer.logo+'" class="img-circle height-70 width-100p">');
			}
			$('.btn-modal-pay-advice').attr('data-attr-id', hashid);
			if (result.advices.status_paid == 1) {
				$('.modal-lawyeradvice-paidadvice').html(result.advices.description);
				$('.modal-lawyeradvice-paidadvice').removeClass('hideme');
				$('.modal-lawyeradvice-unpaidadvice').addClass('hideme');


				div_for_attachment = '<div class="box-footer">'+
										'<ul class="mailbox-attachments clearfix">';

				$.each(result.advices.advice_attachments, function( index, value ) {
					var fileattachment = value.attachment;
					var fileformat = "";
					fileformat = fileattachment.substr(-4);
					if (fileformat == ".jpg" || fileformat == "jpeg" || fileformat == ".png" || fileformat == ".gif") {
						div_for_attachment += '<li>'+
												'<span class="mailbox-attachment-icon has-img">'+
													'<img src="http://lawsheroes.com/'+value.attachment+'" alt="Attachment" class="img-responsive" style="height: 200px !important; width: 300px !important;">'+
												'</span>'+
												'<div class="mailbox-attachment-info">'+
													'<a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> '+value.filename.substr(0, 12)+'..'+fileformat+'</a>'+
													'<a href="http://lawsheroes.com/'+value.attachment+'" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>'+
												'</div>'+
											   '</li>';
					} else if (fileformat == ".pdf") {
						div_for_attachment += '<li>'+
												'<span class="mailbox-attachment-icon has-img">'+
													'<i class="fa fa-file-pdf-o fa-2x mtb35"></i>'+
												'</span>'+
												'<div class="mailbox-attachment-info">'+
													'<a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> '+value.filename.substr(0, 12)+'..'+fileformat+'</a>'+
													'<a href="http://lawsheroes.com/'+value.attachment+'" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>'+
												'</div>'+
											   '</li>';
					}
				});
						div_for_attachment += '</ul>'+
										'</div>';
				$('.modal-lawyeradvice-addtachment').html(div_for_attachment);
			} else {
				$('.modal-lawyeradvice-paidadvice').html('');
				$('.modal-lawyeradvice-paidadvice').addClass('hideme');
				$('.modal-lawyeradvice-unpaidadvice').removeClass('hideme');
			}
		}
	});
}

function getDocstranslDocumentDetails(hashid) 
{
	$.ajax({
		url: base_url+'/client/doctransl/quotation/getdocument/'+hashid,
		type: 'GET',
		dataType: 'json',
	})
	.done(function(result) {
		if (result.status == 200) {
			if (result.docstranslqoutation.docstransl_qoutation_description.length == 0) {
				
	            swal("Oops", 'Please wait for the provider as they send the translated document', "warning", {
					dangerMode: true,
	                button: "Close",
	            });
			} else {
				$('.modal-details-provider-quoation-name, #modal-details-provider-document-attachment, .quotation_show_if_have_attachment, .modal-details-provider-quoation-name, .modal-details-provider-quoation-avatar, .modal-details-document-quoation-description').html('');
				$('#modal-show-documentdetails').modal();
				$('.modal-details-provider-quoation-name').html(result.docstranslqoutation.provider.name);
				if ($.trim(result.docstranslqoutation.provider.logo).length == '0') {
					$('.modal-details-provider-quoation-avatar').html('<img src="http://lawsheroes.com//library/image/user-gray.png" class="img-circle height-50 width-75p">');
				} else {
					$('.modal-details-provider-quoation-avatar').html('<img src="http://lawsheroes.com/'+result.docstranslqoutation.provider.logo+'" class="img-circle height-50 width-75p">');
				}
				$('#modal-details-document-quoation-description').html(result.docstranslqoutation.docstransl_qoutation_description[0].description);
				var attachments = '';
				$.each(result.docstranslqoutation.docstransl_qoutation_description[0].docstransl_qoutation_file, function(index, val) {
					$('.quotation_show_if_have_attachment').html('<hr><h4><i class="fa fa-paperclip"></i> Attachment</h4>');[0]
					attachments = '<li>'+
									'<span class="mailbox-attachment-icon has-img">'+
										'<i class="fa fa-file-pdf-o fa-2x mtb35"></i>'+
									'</span>'+

									'<div class="mailbox-attachment-info">'+
										'<a href="http://lawsheroes.com'+val.attachment+'" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>'+val.filename.substr(0, 15)+'...'+val.filename.substr(-3)+'</a>'+
										'<span class="mailbox-attachment-size">'+
											'Attachment'+ 
											'<a href="http://lawsheroes.com'+val.attachment+'" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>'+
										'</span>'+
									'</div>'+
								'</li>';
					$('#modal-details-provider-document-attachment').append(attachments);
				});
				$('#div_document_loader').addClass('hideme');
				$('#div_document_details').removeClass('hideme');
			}
		}
	})
	.fail(function() {
		console.log("error");
	});
	return false;
	/*$('#modal-lawyeradvice-lawyer-name, #modal-lawyeradvice-price, #modal-lawyeradvice-lawyer-avatar, .modal-lawyeradvice-paidadvice').html('');
	$('.btn-modal-pay-advice').removeAttr('data-attr-id');
	var div_for_attachment = '';
	$.ajax({
		url: base_url+'/client/advice/show/'+hashid,
		type: 'GET',
		dataType: 'json',
		success: function (result) {
    		$('#modal-show-advice').modal();
			$('#modal-lawyeradvice-lawyer-name').html('<b>'+result.advices.lawyer.name+'</b>');
			$('#modal-lawyeradvice-price').html('Price: '+result.advices.format_price+' AED');
			$('#modal-lawyeradvice-lawyer-avatar').removeClass('hideme');
			if (result.advices.lawyer.logo == '') {
				$('#modal-lawyeradvice-lawyer-avatar').html('<img src="http://lawsheroes.com//library/image/user-gray.png" class="img-circle height-70 width-100p">');
			} else {
				$('#modal-lawyeradvice-lawyer-avatar').html('<img src="http://lawsheroes.com/'+result.advices.lawyer.logo+'" class="img-circle height-70 width-100p">');
			}
			$('.btn-modal-pay-advice').attr('data-attr-id', hashid);
			if (result.advices.status_paid == 1) {
				$('.modal-lawyeradvice-paidadvice').html(result.advices.description);
				$('.modal-lawyeradvice-paidadvice').removeClass('hideme');
				$('.modal-lawyeradvice-unpaidadvice').addClass('hideme');
				div_for_attachment = '<div class="box-footer">'+
										'<ul class="mailbox-attachments clearfix">';
				$.each(result.advices.advice_attachments, function( index, value ) {
					var fileattachment = value.attachment;
					var fileformat = "";
					fileformat = fileattachment.substr(-4);
					if (fileformat == ".jpg" || fileformat == "jpeg" || fileformat == ".png" || fileformat == ".gif") {
						div_for_attachment += '<li>'+
												'<span class="mailbox-attachment-icon has-img">'+
													'<img src="http://lawsheroes.com/'+value.attachment+'" alt="Attachment" class="img-responsive" style="height: 200px !important; width: 300px !important;">'+
												'</span>'+
												'<div class="mailbox-attachment-info">'+
													'<a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> '+value.filename.substr(0, 12)+'..'+fileformat+'</a>'+
													'<a href="http://lawsheroes.com/'+value.attachment+'" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>'+
												'</div>'+
											   '</li>';
					} else if (fileformat == ".pdf") {
						div_for_attachment += '<li>'+
												'<span class="mailbox-attachment-icon has-img">'+
													'<i class="fa fa-file-pdf-o fa-2x mtb35"></i>'+
												'</span>'+
												'<div class="mailbox-attachment-info">'+
													'<a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> '+value.filename.substr(0, 12)+'..'+fileformat+'</a>'+
													'<a href="http://lawsheroes.com/'+value.attachment+'" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>'+
												'</div>'+
											   '</li>';
					}
				});
						div_for_attachment += '</ul>'+
										'</div>';
				$('.modal-lawyeradvice-addtachment').html(div_for_attachment);
			} else {
				$('.modal-lawyeradvice-paidadvice').html('');
				$('.modal-lawyeradvice-paidadvice').addClass('hideme');
				$('.modal-lawyeradvice-unpaidadvice').removeClass('hideme');
			}
		}
	});*/
}


$(document).on('click', '.swal-button--confirm', function () {
    var button_value = $(this).html();
    if (button_value == 'OK') {
        window.location.reload();
    }
});

function generate_key () 
{
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 10; i++)
	text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
} 


	
function reload_page (timer) 
{
	setTimeout(function(){ 
	window.location.reload();
	}, timer);
}

function isValidEmailAddress (emailAddress) 
{
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

/***********************************************************************/
/**						START: AJAX FUNCTIONS						  **/
/***********************************************************************/

function doAjaxProcess(method, form_id, datas, form_url) 
{
	// console.log(datas.length);return false;
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		data: datas,
		success: function (result) {
			if (result.status == 400 || result.status == 401 || result.status == 404 || 
				result.status == 406 || result.status == 1010) {
				swalWarning ("Oops", result.error, "warning", "Close");
				return false;
			} else if (result.status == 202) {
				$('#login_form').attr('action', 'post_login.php').removeAttr('id').submit();
				return false;
			} else if (result.status == 200) {
                    swalWarning ("Completed", result.message, "success", "OK");
	        } else {
                swalWarning ("Done", result.message, "success", "Done");
			}
		}
	});
}
function doAjaxProcessModule(method, form_id, datas, form_url, module) 
{
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		data: datas,
		success: function (result) {
			if (result.status == 401 || result.status == 404) {
	            swal("Oops!", result.error, "warning", {
					dangerMode: true,
	                button: "Close",
	            });
				return false;
			} else if (result.status == 202) {
				$('#login_form').attr('action', 'post_login.php').removeAttr('id').submit();
				return false;
			} else if (result.status == 200) {
                // swal("Completed!", result.message, "success");
                if (module == 'client_registration') {
                	alert('asd');
                	return false;
                }
                $('#'+form_id).removeAttr('id');
                $('.'+form_id).submit();
                return false;
	        } else {

                swal("Done", result.message, "success");
				// swal({
				// 	title : "Congratulations!",
				// 	text : result.message,
				// 	icon : "success", 
				// 	buttons: "Done",
				// })
			}
		}
	});
	return false
}



function doAjaxProcessFormFields(method, form_url, form_id, formfields_id, form_fields, session_storage)
{
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		data: {
			'form_id' : form_id,
			'formfields_id' : formfields_id, 
			'form_fields' : form_fields, 
			'session_storage' : session_storage 
		},
		success: function (result) {
			if (result.status == 204 || result.status == 205 || result.status == 209 || result.status == 400 || result.status == 401 || result.status == 422 || result.status == 501 || result.status == 600) {
	            swal("Oops!", result.message, "warning", {
					dangerMode: true,
	                button: "Close",
	            });
				return false;
			} else if (result.status == 202) {
				$('#login_form').attr('action', 'post_login.php').removeAttr('id').submit();
				return false;
	        } else {
                swal("Done", result.message, "success");
				// swal({
				// 	title : "Congratulations!",
				// 	text : result.message,
				// 	icon : "success", 
				// 	buttons: "Done",
				// })
			}
		}
	});
}

function doAjaxProcessBasic (method, datas, form_url)  
{
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		data: datas,
		success: function (result) {
			if (result.status == 204 || result.status == 205 || result.status == 209 || result.status == 400 || result.status == 401 || result.status == 422 || result.status == 501 || result.status == 600) {
				if (page_lang == 'ar') {
		            swal("تحذير!", result.message, "warning", {
						dangerMode: true,
		                button: "Close",
		            });
				} else {
		            swal("Oops!", result.message, "warning", {
						dangerMode: true,
		                button: "Close",
		            });
				}
				return false;
			} else if (result.status == 202) {
				$('#login_form').attr('action', 'post_login.php').removeAttr('id').submit();
				return false;
	        } else {
	        	if (page_lang == 'ar') {
		        		
					swal({
						title : "أحسنت!",
						text : result.message,
						icon : "success", 
					});
	        	} else {
					swal({
						title : "Done!",
						text : result.message,
						icon : "success", 
					});
	        	}
			}
		}
	});
}


function validate_field (input_name) 
{
	var field = $('#'+input_name);
	if (field.val().trim() == '') {
		var field_name = field.attr('data-attr');

		swal({
			title :"Oops!", 
			text: ""+field_name+" is required.",
			icon : "warning", 
			dangerMode: true,
			buttons: ["Cancel", "Close"],
		});
		field.focus();
		return false;
	}
	return true;
}

function copyHtmlToClipBoard(propertyId) {
	/* Get the text field */
	var copyText = document.getElementById(propertyId);
	console.log(copyText.innerHTML);
	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */
  
	/* Copy the text inside the text field */
	document.execCommand("copy");
  
	/* Alert the copied text */
	
	alert("Copied the text: " + copyText.value);
}

function copyInputToClipBoard(propertyId) {
	/* Get the text field */
	var copyText = document.getElementById(propertyId);
	console.log(copyText.value);
  
	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */
  
	/* Copy the text inside the text field */
	document.execCommand("copy");
  
	/* Alert the copied text */
	// alert("Copied the text: " + copyText.value);
	var tooltip = document.getElementById('tooltip_button_clipboard_'+propertyId);
	// tooltip.innerHTML = "Copied: " + copyText.value;
	tooltip.innerHTML = '<span class="text-green"><i class="fas fa-copy"></i> Copied!</span>';
	
}


function getDropdownOptionsStatic(form_url, method, elementId) 
{
	$('#'+elementId).html('');
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		success: function (result) 
		{
			if (result.status == 200) 
			{
                $.each(result.model, function( index, value ) {
					$('#'+elementId).append('<option value="'+value+'">'+value+'</option>');
                });
			}
		}
	});
}

function getDropdownOptionsTitleId(form_url, method, elementId) 
{
	$('#'+elementId).html('');
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		success: function (result)
		{
			if (result.status == 200) 
			{
                $.each(result.model, function( index, value ) {
					$('#'+elementId).append('<option value="'+value.id+'">'+value.title+'</option>');
                });
			}
		}
	});
}

function getDetails(module, what, hashid, form_url, method) 
{
	$.ajax({
		url: form_url,
		type: method,
		dataType: 'json',
		data: {
			'hashid' : hashid,
			'what' : what
		},
		success: function (result) 
		{
			if (module == 'services') {
				$('#service_id').val(result.hashid);
				$('#services-service_name').val(result.service.service_name);
				$('#services-service_description').val(result.service.service_description);
			} else if (module == 'servicetype') {
				$('#servicetypes-servicetype_id').val(result.hashid);
				$('#servicetypes-service_id').val(result.servicetype.service_id);
				$('#servicetypes-servicetype_name').val(result.servicetype.servicetype_name);
			} else if (module == 'formgetservicetype') {
				$('#form-servicetype_id option').remove();
				$('#form-servicetype_id').html('<option value="">Please Select</option>');
				$.each(result.servicetype, function(index, val) {
					$('#form-servicetype_id').append('<option value="'+val.servicetype_id+'">'+val.servicetype_name+'</option>');
				});
			} else if (module == 'kiosk_getservices') {
				$('#servicetype_id option').remove();
				$('#servicetype_id').html('<option value="">Please Select</option>');
				if (result.status == 400) {
		            swal("Oops!", result.message, "warning", {
						dangerMode: true,
		                button: "Close",
		            });
					return false;
		        } else {
					$.each(result.service, function(index, val) {
						$('#servicetype_id').append('<option value="'+val.servicetype_id+'">'+val.servicetype_name+'</option>');
					});
				}
			} else if (module == 'kiosk_getservicessubtype') {
				$('#sersubtype_id option').remove();
				$('#sersubtype_id').html('<option value="">Please Select</option>');
				if (result.status == 400) {
		            swal("Oops!", result.message, "warning", {
						dangerMode: true,
		                button: "Close",
		            });
					return false;
		        } else {
					$.each(result.servicetype, function(index, val) {
						$('#sersubtype_id').append('<option value="'+val.sersubtype_id+'">'+val.sersubtype_name+'</option>');
					});
				}
			}
			console.log(result);
		}
	});
}


function datatableinfodynamic (datatable_number) 
{
	var default_previous_class = 'btn btn-default btn-sm ';
	var default_next_class = 'btn btn-default btn-sm ';

	var test = $('#page-table-list-'+datatable_number+'_info').html();

	var previous_class = $('#page-table-list-'+datatable_number+'_previous').attr('class');
	var next_class = $('#page-table-list-'+datatable_number+'_next').attr('class');
	var slice_previouse_class = previous_class.slice(-8);
	var slice_next_class = next_class.slice(-8);
	default_previous_class += previous_class;
	default_next_class += next_class;
	$('.btn-list-previous-'+datatable_number+'').removeClass('btn btn-default btn-sm disabled');
	$('.btn-list-previous-'+datatable_number+'').addClass(default_previous_class);
	if (slice_previouse_class == 'disabled') {
		$('.btn-list-previous-'+datatable_number+'').prop('disabled', true);
	} else {
		$('.btn-list-previous-'+datatable_number+'').prop('disabled', false);
	}
	$('.btn-list-next-'+datatable_number+'').removeClass('btn btn-default btn-sm disabled');
	$('.btn-list-next-'+datatable_number+'').addClass(default_next_class);
	if (slice_next_class == 'disabled') {
		$('.btn-list-next-'+datatable_number+'').prop('disabled', true);
	} else {
		$('.btn-list-next-'+datatable_number+'').prop('disabled', false);
	}
	// console.log(default_previous_class);
	$('.total_records-'+datatable_number+'').html(test);
}


function translator () 
{
	var lang = $('#select_language').val();
	$.ajax({
		url: base_url+'/setlanguage/'+lang,
		type: 'GET',
		dataType: 'json',
		success: function (result) {
			if (result.status == 200) {
				window.location.href = base_url;
			}
		}
	});
}

function translator2 () 
{
	var lang = $('#select_language').val();
	$.ajax({
		url: base_url+'/setlanguage/'+lang,
		type: 'GET',
		dataType: 'json',
		success: function (result) {
			if (result.status == 200) {
				window.location.href = base_url2;
			}
		}
	});
}

function translator3 () 
{
	var lang = $('#select_language2').val();
	$.ajax({
		url: base_url+'/setlanguage/'+lang,
		type: 'GET',
		dataType: 'json',
		success: function (result) {
			if (result.status == 200) {
				window.location.href = base_url2;
			}
		}
	});
}


function dynamicFineUploader(data_number) {

   	localStorage.clear();
   	var locally_stored_value = [];
   	var base_url = $('body').attr('data-url');
    var galleryUploader = new qq.FineUploader({
        element: document.getElementById("fine-uploader-gallery"+data_number),
        template: 'qq-template-gallery',
        request: {
            endpoint: base_url+'/api/upload/getadviceattachmenttemp'
        },
        thumbnails: {
            placeholders: {
                waitingPath: '{{ url("/library/plugins/fine-uploader/fine-uploader/placeholders/waiting-generic.png") }}',
                notAvailablePath: '{{ url("/library/plugins/fine-uploader/fine-uploader/placeholders/not_available-generic.png") }}'
            }
        },
        validation: {
     		itemLimit: 5,
            allowedExtensions: ['jpeg', 'jpg', 'png', 'pdf'],
            // sizeLimit: 51200 // 50 kB = 50 * 1024 bytes
        },
	    callbacks: {
	        onError: function(id, name, errorReason, xhrOrXdr) {
	            // alert(qq.format("Error on file number {} - {}.  Reason: {}", id, name, errorReason));
	        },
	        onComplete: function(id, name, responseJSON, xhrOrXdr) {
	            // console.log(id);
	            // console.log(responseJSON);
	            // console.log(responseJSON.uploaded_file);
   				// localStorage.setItem(id, responseJSON.uploaded_file);	
				var uploaded_file = { id: responseJSON.uploaded_file };

				locally_stored_value.push(uploaded_file);

				localStorage.setItem("lawsheroes_stored_value"+data_number, JSON.stringify(locally_stored_value));

				var stored = JSON.parse(localStorage.getItem("lawsheroes_stored_value"+data_number));
				$('#object_uploaded_file'+data_number).val(JSON.stringify(stored));
	        },
	    }
    });
}

function doAjaxConfirmProcessing (method, form_id, datas, form_url)  {
	swal({
		title: "Are you sure?",
		text: "Once deleted, you will not be able to recover this data!",
		icon: "warning",
		// buttons: true,
		buttons: ["No", "Yes"],
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			doAjaxProcess(method, form_id, datas, form_url);
			// swal("Poof! Your imaginary file has been deleted!", {
			// 	icon: "success",
			// });
		}
	});
}

function swalWarning (header, message, icon, confirmButton) {
    // swal({
    //     title : "Opps!",
    //     text : "Device Type is required",
    //     icon : "warning", 
    //     buttons: "Close",
    // })
    swal({ title : header, text : message, icon : icon,  buttons: confirmButton });
    
    // swal({
    //     title : "Congratulations!",
    //     text : result.message,
    //     icon : "success", 
    //     buttons: "Done",
    // })
}

function initPayPalButton(valueAmount) {
	// function initPayPalButton(valueAmount, valueItemTotal, valueShipping) {
	paypal.Buttons({
		style: {
			shape: 'rect',
			color: 'gold',
			layout: 'vertical',
			label: 'paypal',
			
		},


        createOrder: function(data, actions) {
			// var orderId = $('#selectedForApproveOrderId').val();
			// var form_url = base_url + '/api/orders/'+orderId+'/paymentsuccess';
			// doAjaxProcess('GET', '', {}, form_url); 
			return actions.order.create({
			  	purchase_units: [{"amount":{"currency_code":"USD","value":valueAmount}}]
			});
		},
		// createOrder: function(data, actions) {
		// 	return actions.order.create({
		// 		purchase_units: [
		// 			{
		// 				"description" : "TronicsPay Payment",
		// 				"amount" : {
		// 					"currency_code" : "USD",
		// 					"value" : 51, // valueAmount, 
		// 					"breakdown" : { 
		// 						"item_total" : {
		// 							"currency_code" : "USD",
		// 							"value" : 1 // valueItemTotal,
		// 						},
		// 						"shipping" : {
		// 							"currency_code" : "USD",
		// 							"value" : 50 // valueShipping, // 50
		// 						},
		// 						"tax_total" : {
		// 							"currency_code" : "USD", 
		// 							"value" : 0
		// 						}
		// 					}
		// 				}
		// 			}
		// 		]
		// 	});
		// },

		onApprove: function(data, actions) {
			return actions.order.capture().then(function(details) {
				var orderId = $('#selectedForApproveOrderId').val();
				var form_url = base_url + '/api/orders/'+orderId+'/paymentsuccess';
				doAjaxProcess('GET', '', {}, form_url); 
			});
		},

		onError: function(err) {
		console.log(err);
		}
	}).render('#paypal-button-container');
}

function percent(amount, offer) 
{
	goodPrice = parseFloat($('#good').val());
	fairPrice = parseFloat($('#fair').val());
	poorPrice = parseFloat($('#poor').val());
	amount = parseFloat(amount);
	if(offer == 'good'){
		return amount - (goodPrice / 100 * amount);
	}
	if(offer == 'fair'){
		return amount - (fairPrice / 100 * amount);
	}
	if(offer == 'poor'){
		return amount - (poorPrice / 100 * amount);
	}
}

function OpenPreloader (classProperty) 
{
	$('.'+classProperty+'').html('<div class="overlay dark"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
}

function OpenPreloaderModal (classProperty) 
{
	$('.'+classProperty+'').html('<div class="overlay dark" style="ertical-align: middle; text-align: center; padding-top: 40%;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
}

function ClosePreloader (classProperty) 
{
	$('.'+classProperty+'').html('');
}
// function modalTrackShipping (shippingTracker) 
// {
// 	$('#modal-show-tracker').modal();
// 	// var myFrame = $("#iframe-order-tracker").contents().find('body');
// 	$("#iframe-order-tracker").attr("src", 'https://google.com');
//     // $("#iframe-order-tracker").attr('src', 'https://www.qries.com');;
// 	// var $('#iframe-order-trackers').attr('src', shippingTracker);
// 	// var url = $("#iframe-order-tracker").attr ('src');
// 	// $('#iframe-order-trackers').load(shippingTracker);
// // 	$('#iframe-order-tracker').attr('src', '');
// // 	// $('#iframe-order-tracker').attr('src', shippingTracker);
// // 	$('#iframe-order-tracker').attr('src', 'https://google.com');
// // 	// shippingTracker
// // //  onClick="modalTrackShipping('{{ $data['order']['shipping_tracker'] }}')"
// }