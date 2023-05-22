'use strict';

// DOM Elements
const currencyInput = document.querySelector('#currency');
const localeInput = document.querySelector('#locale');
const rotInput = document.querySelector('#rot');

// Asynchronous Fetch
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

// Manipulate input data based on location and input details
// Step 1: Get the user's location using Geolocation API
navigator.geolocation.getCurrentPosition(success, error);

function success(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;

  // Step 2: Convert coordinates to location using a geocoding API
  const geocodingApiUrl = `https://api.geocodingapi.com/convert?lat=${latitude}&lon=${longitude}`;

  fetch(geocodingApiUrl)
    .then(response => response.json())
    .then(data => {
      // Step 3: Determine the country from the geocoded location
      const country = data.results[0].address_components.find(component =>
        component.types.includes('country')
      ).short_name;

      // Step 4: Get the currency code using a currency API
      const currencyApiUrl = `https://api.currencyapi.com/v1/countries/${country}`;

      fetch(currencyApiUrl)
        .then(response => response.json())
        .then(currencyData => {
          const currencyCode = currencyData.currency.code;

          // Step 5: Display the currency code
          console.log(
            `The currency code for your location is: ${currencyCode}`
          );
        })
        .catch(error => {
          console.error('Error fetching currency data:', error);
        });
    })
    .catch(error => {
      console.error('Error fetching geocoded location:', error);
    });
}

function error() {
  console.error('Unable to retrieve your location.');
}
