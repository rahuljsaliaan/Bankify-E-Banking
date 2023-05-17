'use strict';

$(document).ready(function () {
  // Attach a submit event handler to the form
  $('#registerForm').submit(function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get the form data
    var formData = $(this).serialize();

    // Send the AJAX request to the PHP script
    $.ajax({
      url: 'process_signup.php',
      type: 'POST',
      data: formData,
      success: function (response) {
        if (response !== '"success"') {
          $('#errorMessage').text(response);
          return;
        }
        Swal.fire({
          title: 'Success...!',
          text: `Successfully registered with CookBook`,
          icon: 'success',
          confirmButtonText: 'ok',
        }).then(result => {
          if (result.isConfirmed) {
            window.location.href = 'index.php';
          }
        });
      },
      error: function (xhr, status, error) {
        // Handle the registration error
      },
    });
  });
});
