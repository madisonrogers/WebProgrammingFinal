
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

	// Login Form
	//----------------------------------------------
	// Validation
  $("#login-form").validate({
  	rules: {
      lg_username: "required",
  	  lg_password: "required",
    },
  	errorClass: "form-invalid"
  });
  
	// Form Submission
  $("#login-form").submit(function() {
  	remove_loading($(this));
		
		if(options['useAJAX'] == true)
		{
			// Dummy AJAX request (Replace this with your AJAX code)
		  // If you don't want to use AJAX, remove this
  	  login_submit_form($(this));
		
		  // Cancel the normal submission.
		  // If you don't want to use AJAX, remove this
  	  return false;
		}
  });
	
	// Register Form
	//----------------------------------------------
	// Validation
  $("#register-form").validate({
  	rules: {
      reg_username: "required",
  	  reg_password: {
  			required: true,
  			minlength: 5
  		},
   		reg_password_confirm: {
  			required: true,
  			minlength: 5,
  			equalTo: "#register-form [name=reg_password]"
  		},
  		reg_email: {
  	    required: true,
  			email: true
  		},
  		reg_agree: "required",
    },
	  errorClass: "form-invalid",
	  errorPlacement: function( label, element ) {
	    if( element.attr( "type" ) === "checkbox" || element.attr( "type" ) === "radio" ) {
    		element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
	    }
			else {
  	  	label.insertAfter( element ); // standard behaviour
  	  }
    }
  });

  // Form Submission
  $("#register-form").submit(function(e) {

  	//alert($("#register-form").valid());
  	e.preventDefault();
  	//var isValid = $("#register-form").valid();

  	remove_loading($(this));

  	
	//console.log('submitted')
		if(options['useAJAX'] == true)
		{
		//console.log(this);
			// Dummy AJAX request (Replace this with your AJAX code)
		  // If you don't want to use AJAX, remove this
  	  	register_submit_form($(this));
		
		  // Cancel the normal submission.
		  // If you don't want to use AJAX, remove this
  	  return false;
		}
	
  });

	// Forgot Password Form
	//----------------------------------------------
	// Validation
  $("#forgot-password-form").validate({
  	rules: {
      fp_email: "required",
    },
  	errorClass: "form-invalid"
  });
  
	// Form Submission
  $("#forgot-password-form").submit(function() {
  	remove_loading($(this));
	
		if(options['useAJAX'] == true)
		{
			// Dummy AJAX request (Replace this with your AJAX code)
		  // If you don't want to use AJAX, remove this
  	  forgot_submit_form($(this));
		
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

  function email_err($form)
  {
    $form.find('[type=submit]').addClass('error').html(options['btn-error']);
    $form.find('.login-form-main-message').addClass('show error').html('email does not exist');
  }

  function reset_password_sent($form)
  {
    $form.find('[type=submit]').addClass('success').html(options['btn-success']);
    $form.find('.login-form-main-message').addClass('show success').html("An email has been sent to reset your password.");
  }
	// Dummy Submit Form (Remove this)
	//----------------------------------------------
	// This is just a dummy form submission. You should use your AJAX function or remove this function if you are not using AJAX.
	// This is just a dummy form submission. You should use your AJAX function or remove this function if you are not using AJAX.
  function register_submit_form($form)
  {
  	if($form.valid())
  	{
  		form_loading($form);
  		// Serialize the form data.
		var formData = $($form).serialize();
    var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));
		//console.log(formData);
    	$.ajax({
    	type: "POST",
    	url: "register_submit.php",
    	data: formData,
    	success: function(data){
    	//alert(data);
  		setTimeout(function() {
  			activate_email($form);
  		}, 2000);
      //console.log("Path: " + loc);
      //console.log("dir: " + dir);
      setTimeout(function(){
        window.location.href = dir + "/index.php";
      }, 5000);
      },
      error: function (data) {
        //var msg = '';
        //console.log(data);
          //alert('user exists!' + data);
        setTimeout(function() {
        user_exists_flash($form);
      }, 2000);
    	}
      });
  	}
  }

  function login_submit_form($form)
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
      url: "authenticate.php",
      data: formData,
      success: function(data){
      //alert(data);
      setTimeout(function() {
        form_success($form);
      }, 2000);
      //console.log("Path: " + loc);
      //console.log("dir: " + dir);
        //window.location.href = dir + "/index.php";
        console.log(document.cookie);
        window.location.href = dir + "/allarticles.php";
      },
      error: function (data) {
       // var msg = '';
        console.log(data);
          //alert('user exists!' + data);
        setTimeout(function() {
        form_failed($form);
      }, 2000);
      }
      });
    }
  }

  function forgot_submit_form($form)
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
      url: "forgot_submit.php",
      data: formData,
      success: function(data){
      //alert(data);
      setTimeout(function() {
        reset_password_sent($form);
      }, 2000);
      //console.log("Path: " + loc);
      //console.log("dir: " + dir);
        //window.location.href = dir + "/index.php";
        //console.log(document.cookie);
        setTimeout(function(){
        window.location.href = dir + "/index.php";
        }, 4000)
      },
      error: function (data) {
       // var msg = '';
        console.log(data);
          //alert('user exists!' + data);
        setTimeout(function() {
        email_err($form);
      }, 500);
      }
      });
    }
  }
  