jQuery("#cc-quickInquiry").validate({
	rules: {

		c_name: {
			required: true,
		},
		c_email: {
			required: true,

		},
		c_sub: {
			required: true,

		},
		c_msg: {
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
		c_sub: {
			required: "Please enter your Subject"
		},
		c_msg: {
			required: "Please enter your message"
		},


	},


	submitHandler: function (form) {

		var data = new FormData();
		var form_data = jQuery('#c_contact_form').serializeArray();
		console.log(form_data);

		jQuery.ajax({
			url: customAjax.ajaxurl,
			type: 'post',
			data: form_data,
			success: function (result) {

				var obj = JSON.parse(result);
				console.log(obj);
				if (obj.result && obj.email && obj.captcha_match) {

					jQuery('#c_contact_form').trigger("reset");
					jQuery("#c_contact_form").removeClass('invalidForm');
					jQuery('.contactsuccess').addClass('success text-success').removeClass('text-danger').css('display', 'flex').html('Email send successfully.');
					jQuery(".code").html(data);
					refreshCaptcha();

				}
				else {
					jQuery("#c_contact_form").addClass('invalidForm');
					if (!obj.captcha_match) {

						jQuery('.contactsuccess').addClass('error text-danger').removeClass('text-success').css('display', 'flex').html('captcha not match');
					} else {
						jQuery('#c_contact_form').trigger("reset");
						jQuery('.contactsuccess').addClass('error text-danger').css('display', 'flex').html('Email not Send.');
						jQuery("#cc-quickInquiry").removeClass('invalidForm');

					}


				}
			},
			fail: function (err) {

				alert("There was an error: " + err);
			}
		});

	}
});