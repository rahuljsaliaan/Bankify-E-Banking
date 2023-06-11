'use strict';

const email = document.querySelector('#email');
const verifyBtn = document.querySelector('.verify-btn');
const validateEmailForm = document.querySelector('#validateEmailForm');

const validateEmail = function (emailInput) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailRegex.test(emailInput)) {
    Swal.fire({
      title: `Invalid "Email"`,
      text: `Please enter a valid "Email"`,
      icon: 'error',
      confirmButtonText: 'OK',
    });

    emailInput.value = '';
    emailInput.focus();

    return false;
  }

  return true;
};

email.addEventListener('input', function () {
  verifyBtn.setAttribute('disabled', 'true');
  if (this.value.length > 0) verifyBtn.removeAttribute('disabled');
});

validateEmailForm.addEventListener('submit', function (e) {
  e.preventDefault();
  if (!validateEmail(email.value)) {
    return;
  }

  $.ajax({
    type: 'POST',
    url: 'process_email_verification.php',
    data: {
      email: email.value,
    },
    success: function (response) {
      if (response.status === 'success') {
        window.location.href = 'verifyOTP.php';
      } else {
        Swal.fire({
          title: 'Something Went Wrong...!',
          text: response.message,
          icon: 'error',
          confirmButtonText: 'OK',
        });
      }
    },
    error: function () {
      console.log('Error');
    },
  });
});
