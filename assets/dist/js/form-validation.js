// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='add_user']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      username: "required",
       password: "required",
        email: "required",
        'roles[]': { required: true, minlength: 1 },
      
    },
    // Specify validation error messages
    messages: {
      username: "Please enter the user name",
      password: "Please enter the password",
       email: "Please enter the email",
       'roles[]': "Please enter the role",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});

// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='add_role']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      role: "required",
      
    },
    // Specify validation error messages
    messages: {
      role: "Please enter the role"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
$(function() {
    // Initialize form validation on the registration form.
    $("form[name='add_points']").validate({
        rules: {
            values: {
                required: true,
                range: [1, 100]
            }
        },
        // Specify validation error messages
        messages: {
            values: "Please enter the Value"
        },

        submitHandler: function(form) {
            form.submit();
        }
    });

    $("#selected_role").on('change', function(e) {

        var selected = $(this).val();
        if(selected == ""){
            return;
        }
        var url = window.location.href;
        var to = url.lastIndexOf('/') + 1;

        x = url.substring(0, to);
        if (x.indexOf('add_points') != -1)
            window.location.href = x + selected;
        else
            window.location.href = x + 'add_points/' + selected;
    })
});
