jQuery("#c_contact_form").validate({
  rules: {
    // cud_message: "required",
    // cud_captcha: "required",
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
    // cud_captcha: "Please enter captcha code"

  },


  submitHandler: function (form) {

    jQuery(".btn-ringcon").show();
    jQuery(".btn-processcon").prop('disabled', true);
    jQuery(".btn-processcon").val('disabled');

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
        if (result) {

          jQuery('#c_contact_form').trigger("reset");
          jQuery("#c_contact_form").removeClass('invalidForm');
          jQuery('.contactsuccess').addClass('success text-success').removeClass('text-danger').css('display', 'flex').html('Email send successfully.');
          jQuery(".btn-ringcon").hide();
          jQuery(".btn-processcon").prop('disabled', false);

          jQuery(".code").html(data);


        }
        else {
          jQuery("#c_contact_form").addClass('invalidForm');
          if (!obj.captcha_match) {

            jQuery('.contactsuccess').addClass('error text-danger').removeClass('text-success').css('display', 'flex').html('captcha not match');
            jQuery(".btn-ringcon").hide();
            jQuery(".btn-processcon").prop('disabled', false);

          } else {
            jQuery('#c_contact_form').trigger("reset");
            jQuery('.contactsuccess').addClass('error text-danger').css('display', 'flex').html('Email not Send.');
            jQuery("#c_contact_form").removeClass('invalidForm');
            jQuery(".btn-ringcon").hide();
            jQuery(".btn-processcon").prop('disabled', false);
            // jQuery('.contactsuccess').addClass('error  text-danger').css('display', 'flex').html('Error');
          }
          // jQuery('#c_contact_form').trigger("reset");
          // jQuery("#c_contact_form").removeClass('invalidForm');

        }
      },
      fail: function (err) {
        jQuery(".btn-ringcon").hide();
        jQuery(".btn-processcon").prop('disabled', false);
        alert("There was an error: " + err);
      }
    });

  }
});







// inquery form pop

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

    jQuery(".btn-ringiq").show();
    jQuery(".btn-processiq").prop('disabled', true);
    jQuery(".btn-processiq").val('disabled');

    var data = new FormData();
    var form_data = jQuery('#cc-quickInquiry').serializeArray();
    console.log(form_data);

    jQuery.ajax({
      url: customAjax.ajaxurl,
      type: 'post',
      data: form_data,
      success: function (result) {


        var obj = JSON.parse(result);
        console.log(obj);
        if (result) {
          jQuery('#cc-quickInquiry').trigger("reset");
          jQuery("#cc-quickInquiry").removeClass('invalidForm');
          jQuery('.i_success').addClass('success text-success').removeClass('text-danger').css('display', 'flex').html('Inquiry send successfully.');
          jQuery(".btn-ringiq").hide();
          jQuery(".btn-processiq").prop('disabled', false);
          jQuery(".code").html(data);
        }
        else {
          jQuery("#cc-quickInquiry").addClass('invalidForm');
          jQuery('.i_success').addClass('error text-danger').css('display', 'flex').html('Inquiry not Send.');
          jQuery(".btn-ringiq").hide();
          jQuery(".btn-processiq").prop('disabled', false);
        }
      },
      fail: function (err) {
        jQuery(".btn-ringiq").hide();
        jQuery(".btn-processiq").prop('disabled', false);
        alert("There was an error: " + err);
      }
    });

  }
});



