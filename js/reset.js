
    "use strict";
	
	// Options for Message
	//----------------------------------------------
  var options = {
	  'btn-loading': '<i class="fa fa-spinner fa-pulse"></i>',
	  'btn-success': '<i class="fa fa-check"></i>',
	  'btn-error': '<i class="fa fa-remove"></i>',
	  'msg-success': 'All Good! Redirecting...',
	  'msg-error': 'Wrong login credentials!',
	  'useAJAX': true,
  };

	// Forgot Password Form
	//----------------------------------------------
	// Validation
  $("#reset-password-form").validate({
  	rules: {
      fp_email: "required",
    },
  	errorClass: "form-invalid"
  });
  
	// Form Submission
  $("#reset-password-form").submit(function() {
  	remove_loading($(this));
	
		if(options['useAJAX'] == true)
		{
			// Dummy AJAX request (Replace this with your AJAX code)
		  // If you don't want to use AJAX, remove this
  	  reset_submit_form($(this));
		
		  // Cancel the normal submission.
		  // If you don't want to use AJAX, remove this
  	  	return false;
		}
  });

	// Loading
	//----------------------------------------------
  function remove_loading($form)
  {
  	$form.find('[type=submit]').removeClass('error success');
  	$form.find('.login-form-main-message').removeClass('show error success').html('');
  }

  function form_loading($form)
  {
    $form.find('[type=submit]').addClass('clicked').html(options['btn-loading']);
  }
  
  function form_success($form)
  {
	  $form.find('[type=submit]').addClass('success').html(options['btn-success']);
	  $form.find('.login-form-main-message').addClass('show success').html(options['msg-success']);
  }

  function form_failed($form)
  {
  	$form.find('[type=submit]').addClass('error').html(options['btn-error']);
  	$form.find('.login-form-main-message').addClass('show error').html(options['msg-error']);
  }

  function activate_email($form)
  {
    $form.find('[type=submit]').addClass('success').html(options['btn-success']);
    $form.find('.login-form-main-message').addClass('show success').html("Your account has been registered and the activation mail is sent to you email. Click the activation link to activate your account");
  }


  function user_exists_flash($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html('username already exists');
  }

  function email_exists($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html('Email exists.. redirecting');
  }

  function email_err($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html('email does not exist');
  }

	// Dummy Submit Form (Remove this)


  function reset_submit_form($form)
  {
    if($form.valid())
    {
      form_loading($form);
      // Serialize the form data.
    var formData = $($form).serialize();
    var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));
    console.log(formData);
      $.ajax({
      type: "POST",
      url: "validate.php",
      data: formData,
      success: function(data){
     // alert(data);
      setTimeout(function() {
        email_exists($form);
      }, 2000);
      //console.log("Path: " + loc);
      //console.log("dir: " + dir);
        //window.location.href = dir + "/index.php";
        console.log(document.cookie);
        window.location.href = dir + "/reset.php";
      },
      error: function (data) {
       // var msg = '';
        console.log(data);
         // alert('error');
       setTimeout(function() {
        email_err($form);
      }, 500);
      }
      });
    }
  }
  