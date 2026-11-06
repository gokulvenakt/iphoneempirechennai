$(document).ready(function () {// Wait for the DOM to be ready
$(function() {
	
	 $.validator.addMethod(
            "regex",
            function(value, element, regexp) 
            {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
    );
    
	
	 $("form[name='registration']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            firstname: "required",
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true,
				regex: /^[A-Za-z0-9_]+\@[A-Za-z0-9_]+\.[A-Za-z0-9_]+/,

            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            message: "required"
        },
        // Specify validation error messages
        messages: {
            firstname: "Please enter a firstname",
            email: "Please enter a valid email address",
			phone: {
                required: "Please Enter Your Mobile Number",
                number: "Please enter numbers Only",
            },
            message: "Field is required",
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            console.log('submitHandler is firing!');
             event.preventDefault(); 
            $('#formsubmit-btn').hide();
            $('.loading').show();
            $.ajax({
                url: 'forms/notify.php',
                type: 'POST',
                data: $("form[name='registration']").serialize(),
                success: function(data) {
                    console.log("success");
                    if (data == 'Message sent!') { 
                        $('#Success_popup').modal('show');
						$('#formsubmit-btn').show();
						$('.loading').hide();
                        setTimeout(function() {
                            $('#Success_popup').modal('hide');
                        }, 3000);

                    } else {
                        $('#error_popup').modal('show');
						 $('#formsubmit-btn').show();
						$('.loading').hide();

                        //$('#error_popup').append(data);	

                    }
                },
                error: function(data) {
                     console.log("error");
                    $('#error_popup').modal('show');
					 $('#formsubmit-btn').show();
					$('.loading').hide();

                }
            });
            return false;
        }
		

    });
});
});