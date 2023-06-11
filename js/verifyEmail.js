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
  if (!validateEmail(email.value)) {
    e.preventDefault();
    return;
  }
});
