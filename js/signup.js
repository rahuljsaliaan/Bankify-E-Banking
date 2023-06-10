'use strict';

// DOM Elements
const registerForm = document.querySelector('#registerForm');
const firstName = document.querySelector('#firstName');
const lastName = document.querySelector('#lastName');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirmPassword');
const currencyInput = document.querySelector('#currency');
const localeInput = document.querySelector('#locale');
const rotInput = document.querySelector('#rot');
const initBalanceInput = document.querySelector('#initialBalance');

// Calculate ROI
const calcInterestRate = function (initialDeposit) {
  let interestRate;

  if (initialDeposit < 1000) {
    interestRate = 0.5; // 0.5% interest rate for deposits less than 1000
  } else if (initialDeposit < 5000) {
    interestRate = 1.0; // 1% interest rate for deposits between 1000 and 5000
  } else {
    interestRate = 1.5; // 1.5% interest rate for deposits greater than or equal to 5000
  }

  return interestRate;
};

// Get your location details
const getLocation = function () {
  return new Promise((resolve, reject) => {
    window.navigator.geolocation.getCurrentPosition(resolve, reject);
  });
};

// Get your browser language
const getLocale = function () {
  return new Promise((resolve, reject) => {
    const locale = window.navigator.language;

    if (!locale) reject('Locale not found...!');

    resolve(locale);
  });
};

// Fetch details from server
const fetchData = async function (url) {
  const response = await fetch(url);

  if (!response.ok) throw new Error('Could not find your location...!');

  const data = await response.json();

  return data;
};

// input Data
const inputData = function (data) {
  currencyInput.value = data.currencyCode;
  localeInput.value = data.locale;

  initBalanceInput.addEventListener('change', function () {
    rotInput.value = calcInterestRate(this.value);
  });
};

// getLocation details
const getLocationDetails = async function () {
  try {
    const {
      coords: { latitude: lat, longitude: lng },
    } = await getLocation();

    const { country } = await fetchData(
      `https://geocode.xyz/${lat},${lng}?geoit=json&auth=192202336363313369000x56715`
    );

    const countryDetails = await fetchData(
      `https://restcountries.com/v3.1/name/${country}`
    );

    const currencyCode = Object.keys(countryDetails.at(0).currencies);
    const locale = await getLocale();

    inputData({ currencyCode, locale });
  } catch (error) {
    alert(error.message);
  }
};

getLocationDetails();

// Test input
const testInput = function (inputTestCase) {
  if (inputTestCase.inputField.value === '') {
    Swal.fire({
      title: `Empty "${inputTestCase.inputType}"`,
      text: `Please fill in all the fields`,
      icon: 'error',
      confirmButtonText: 'OK',
    });

    return false;
  }

  const isValid = inputTestCase.regex.test(inputTestCase.inputField.value);

  if (!isValid) {
    Swal.fire({
      title: `Invalid "${inputTestCase.inputType}"`,
      text: `Please enter a valid "${inputTestCase.inputType}"`,
      icon: 'error',
      confirmButtonText: 'OK',
    });

    inputTestCase.inputField.value = '';
    inputTestCase.inputField.focus();

    return false;
  }

  return true;
};

// Test passwords match
const testPasswordMatch = function (password, confirmPassword) {
  if (password.value !== confirmPassword.value) {
    Swal.fire({
      title: `Passwords do not match`,
      text: `Please check the passwords`,
      icon: 'error',
      confirmButtonText: 'OK',
    });

    password.value = confirmPassword.value = '';
    password.blur();
    confirmPassword.blur();

    return false;
  }

  return true;
};

// Validate form
const validateForm = function (formData) {
  let isValid = false;

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const nameRegex = /^[A-Za-z]+$/;
  const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
  const amountRegex = /^\d+(\.\d{1,2})?$/;

  const inputTestCases = [
    { regex: nameRegex, inputField: firstName, inputType: 'First Name' },
    { regex: nameRegex, inputField: lastName, inputType: 'Last Name' },
    { regex: emailRegex, inputField: email, inputType: 'Email' },
    {
      regex: amountRegex,
      inputField: initBalanceInput,
      inputType: 'Initial Balance',
    },
    { regex: passwordRegex, inputField: password, inputType: 'Password' },
    {
      regex: passwordRegex,
      inputField: confirmPassword,
      inputType: 'Confirm Password',
    },
  ];

  for (const inputTestCase of inputTestCases) {
    isValid = testInput(inputTestCase);

    if (!isValid) break;
  }

  isValid = testPasswordMatch(password, confirmPassword);

  return isValid;
};

// Registration process
$(document).ready(function () {
  // Attach a submit event handler to the form
  $('#registerForm').submit(function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get the form data
    var formData = $(this).serialize();

    const isValid = validateForm();

    if (!isValid) return;
    return;

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
