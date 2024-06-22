jQuery("#c_Inquiry_form").validate({
	rules: {

		c_name: {
			required: true,
		},
		c_email: {
			required: true,

		},
		c_phone: {
			required: true,

		},
		c_applying: {
			required: true,

		},
		c_upload: {
			required: true,

		},

	},
	// Specify validation error messages
	messages: {
		c_name: {
			required: "Please enter your name",
		},
		c_email: {
			required: "Please enter a valid email address"
		},
		c_phone: {
			required: "Please enter your phone number "
		},
		c_applying: {
			required: "Please enter Applying for "
		},
		c_upload: {
			required: "Please upload your file"
		},


	},


	submitHandler: function (form) {

		jQuery(".btn-ring").show();
		jQuery(".btn-process").prop('disabled', true);
		jQuery(".btn-process").val('disabled');

		var data = new FormData(jQuery('#c_Inquiry_form')[0]);
		// var file_data = jQuery("#c_upload").prop("files")[0];
		// data.append("file", file_data);
		// console.log(data);

		// var data = new FormData();
		// var form_data = jQuery('#cud-contact-form').serializeArray();
		// console.log(form_data);

		jQuery.ajax({
			url: customAjax.ajaxurl,
			type: 'post',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			//data: data,
			success: function (result) {

				var obj = JSON.parse(result);
				console.log(obj);
				if (result) {
					jQuery('#c_Inquiry_form').trigger("reset");
					jQuery("#c_Inquiry_form").removeClass('invalidForm');
					jQuery('.i_Inqu_form').addClass('success text-success').removeClass('text-danger').css('display', 'flex').html('Inquiry  send successfully.');
					jQuery(".code").html(data);

					// // jQuery('#c_Inquiry_form').trigger("reset");
					// jQuery("#c_Inquiry_form").removeClass('invalidForm');
					// jQuery('.contactsuccess').addClass('success text-success').removeClass('text-danger').css('display', 'flex').html('Email send successfully.');
					// jQuery(".code").html(data);
					// refreshCaptcha();

				}
				else {
					jQuery("#c_Inquiry_form").addClass('invalidForm');
					if (!obj.captcha_match) {

						jQuery('.i_Inqu_form').addClass('error text-danger').removeClass('text-success').css('display', 'flex').html('captcha not match');
					} else {
						jQuery('#c_Inquiry_form').trigger("reset");
						jQuery('.i_Inqu_form').addClass('error text-danger').css('display', 'flex').html('Email not Send.');
						jQuery("#c_Inquiry_form").removeClass('invalidForm');
						// jQuery('.contactsuccess').addClass('error  text-danger').css('display', 'flex').html('Error');
					}
					// jQuery('#c_Inquiry_form').trigger("reset");
					// jQuery("#c_Inquiry_form").removeClass('invalidForm');

				}
				jQuery(".btn-ring").hide();
				jQuery(".btn-process").prop('disabled', false);
			},
			fail: function (err) {
				jQuery(".btn-ring").hide();
				jQuery(".btn-process").prop('disabled', false);
				alert("There was an error: " + err);
			}
		});

	}
});