'use strict';

const labelWelcome = document.querySelector('.welcome');
const labelDate = document.querySelector('.date');
const labelBalance = document.querySelector('.balance__value');
const labelSumIn = document.querySelector('.summary__value--in');
const labelSumOut = document.querySelector('.summary__value--out');
const labelSumInterest = document.querySelector('.summary__value--interest');
const labelTimer = document.querySelector('.timer');

const containerApp = document.querySelector('.app');
const containerMovements = document.querySelector('.movements');

const btnTransfer = document.querySelector('.form__btn--transfer');
const btnLoan = document.querySelector('.form__btn--loan');
const btnClose = document.querySelector('.form__btn--close');
const btnSort = document.querySelector('.btn--sort');

const inputTransferTo = document.querySelector('.form__input--to');
const inputTransferAmount = document.querySelector('.form__input--amount');
const inputLoanAmount = document.querySelector('.form__input--loan-amount');
const inputCloseUsername = document.querySelector('.form__input--user');
const inputClosePin = document.querySelector('.form__input--pin');

const btnLogout = document.querySelector('.logout-btn');

// * Account Global variable
let account = {};

//---------------------------------------General Functions---------------------------------------

// * Sort Movements
let sorted = false;
btnSort.addEventListener('click', function (e) {
  e.preventDefault();
  displayMovements(account, !sorted);
  sorted = !sorted;
});

// * Format Date
const formatDate = function (date, locale, time = false) {
  const day = `${date.getDate()}`.padStart(2, 0);
  const month = `${date.getMonth() + 1}`.padStart(2, 0);
  const year = date.getFullYear();

  if (time === false) {
    const daysPassed = Math.round((new Date() - date) / (1000 * 60 * 60 * 24));
    switch (daysPassed) {
      case 0:
        return 'Today';
      case 1:
        return 'Yesterday';
      case 2:
      case 3:
      case 4:
      case 5:
      case 6:
      case 7:
        return `${daysPassed} days ago`;
      default:
        return Intl.DateTimeFormat(locale).format(date);
    }
  } else {
    return Intl.DateTimeFormat(locale, {
      day: 'numeric',
      month: 'numeric',
      year: 'numeric',
      hour: 'numeric',
      minute: 'numeric',
    }).format(date);
  }
};

const formatCurrency = function (value, locale, currency) {
  return new Intl.NumberFormat(locale, {
    style: 'currency',
    currency: currency,
  }).format(value);
};

//---------------------------------------Modules---------------------------------------
// * Display movements
const displayMovements = function (acc, sort = false) {
  containerMovements.innerHTML = '';

  const moves = sort
    ? acc.movements.slice().sort((a, b) => a - b)
    : acc.movements;

  if (moves) {
    moves.forEach(function (mov, i) {
      const type = mov > 0 ? 'deposit' : 'withdrawal';

      // calculate movements date
      const date = new Date(acc.movementsDates[i]);
      const displayDate = formatDate(date, account.locale);

      const html = `
      <div class="movements__row">
        <div class="movements__type movements__type--${type}">${
        i + 1
      } ${type}</div>
        <div class="movements__date">${displayDate}</div>
        <div class="movements__value">${formatCurrency(
          mov,
          acc.locale,
          acc.currency
        )}</div>
      </div>
    `;

      containerMovements.insertAdjacentHTML('afterbegin', html);
    });
  }
};

// * Display Balance
const calcDisplayBalance = function (acc) {
  if (acc.movements) {
    acc.balance = acc.movements.reduce((acc, mov) => acc + Number(mov), 0);
    labelBalance.textContent = `${formatCurrency(
      acc.balance,
      acc.locale,
      acc.currency
    )}`;
  }
};

// * Display Summary
const calcDisplaySummary = function (acc) {
  if (!acc.movements) return;

  const incomes = acc.movements
    .filter(mov => mov > 0)
    .reduce((acc, mov) => acc + Number(mov), 0);
  labelSumIn.textContent = `${formatCurrency(
    incomes,
    acc.locale,
    acc.currency
  )}`;

  const out = Math.abs(
    acc.movements
      .filter(mov => mov < 0)
      .reduce((acc, mov) => acc + Number(mov), 0)
  );
  labelSumOut.textContent = `${formatCurrency(out, acc.locale, acc.currency)}`;

  const interest = acc.movements
    .filter(mov => mov > 0)
    .map(deposit => (deposit * acc.interestRate) / 100)
    .filter((int, i, arr) => {
      // console.log(arr);
      return int >= 1;
    })
    .reduce((acc, int) => acc + int, 0);
  labelSumInterest.textContent = `${formatCurrency(
    interest,
    acc.locale,
    acc.currency
  )}`;
};

// * Update UI
const updateUI = function (acc) {
  // Display movements
  displayMovements(acc);

  // Display balance
  calcDisplayBalance(acc);

  // Display summary
  calcDisplaySummary(acc);
};

// * Logout Timer
const setLogoutTimer = function () {
  // Set time
  let time = 10 * 60;

  // Timer Function
  const timer = function () {
    const min = String(Math.trunc(time / 60)).padStart(2, 0);
    const sec = String(time % 60).padStart(2, 0);

    // Logout Message Toast
    if (time <= 5) {
      if (time === 5) {
        Swal.fire({
          title: 'Logging Out...!',
          text: `You will Be logged out in ${time}`,
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEnterKey: false,
          allowEscapeKey: false,
          timer: '5000',
        });
      }
      document.querySelector(
        '.swal2-html-container'
      ).textContent = `You will Be logged out in ${time}`;
    }

    labelTimer.textContent = `${min}: ${sec}`;
    // when 0 seconds remaining, stop timer and logout

    if (time === 0) {
      window.location.href = 'logout.php';
    }

    // Decrement Time
    time--;
  };

  timer();
  // Set time Interval
  const timerInterval = setInterval(timer, 1000);
  return timerInterval;
};

// * process success with message
const processSuccess = function (timerInterval, messageObj) {
  // Set Logout Timer
  timerInterval && clearInterval(timerInterval);
  timerInterval = setLogoutTimer();

  // success message
  Swal.fire(messageObj);

  // async reload
  fetchDetails();
};

//---------------------------------------Asynchronous Fetch---------------------------------------
// * Fetch User Details and Movements
let timerInterval;
const fetchDetails = function () {
  $(document).ready(function () {
    $.ajax({
      type: 'POST',
      url: 'get_info.php',
      success: function (response) {
        if (response !== 'FAILED') {
          account = { ...response, balance: 0 };

          // welcome message
          labelWelcome.textContent = `Welcome back, ${account.owner}`;

          // current date and time
          setInterval(function () {
            labelDate.textContent = formatDate(
              new Date(),
              account.locale,
              true
            );
          }, 1000);

          // Set Logout Timer
          timerInterval && clearInterval(timerInterval);
          timerInterval = setLogoutTimer();

          // update UI
          updateUI(account);
        } else {
          setTimeout(function () {
            window.location.href = 'logout.php';
          }, 2000);
        }
      },
      error: function () {},
    });
  });
};

fetchDetails();

//--------------------------------------- Event handlers and ajax---------------------------------------
// * Transfer Amount
btnTransfer.addEventListener('click', function (e) {
  e.preventDefault();
  const amount = +inputTransferAmount.value;
  const receiverAcc = inputTransferTo.value;
  inputTransferAmount.value = inputTransferTo.value = '';
  if (
    amount > 0 &&
    account.balance >= amount &&
    receiverAcc?.username !== account.username
  ) {
    // Doing the transfer
    $(document).ready(function () {
      $.ajax({
        type: 'POST',
        url: 'process_transfer.php',
        data: {
          receiverAcc,
          amount,
        },
        success: function (response) {
          console.log(response);
          if (response.status === 'success') {
            processSuccess(timerInterval, {
              title: 'Success...!',
              text: `Amount of ${formatCurrency(
                amount,
                account.locale,
                account.currency
              )} Transferred to '${receiverAcc}'s' account Successfully`,
              icon: 'success',
              confirmButtonText: 'OK',
            });
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
  } else {
    Swal.fire({
      title: "Couldn't Transfer Amount...!",
      text: 'Please Check the input details',
      icon: 'error',
      confirmButtonText: 'OK',
    });
  }
});

// * Loan Request
btnLoan.addEventListener('click', function (e) {
  e.preventDefault();

  const amount = Math.floor(inputLoanAmount.value);
  if (
    account.movements &&
    amount > 0 &&
    account.movements.some(mov => mov >= amount * 0.1)
  ) {
    $(document).ready(function () {
      $.ajax({
        type: 'POST',
        url: 'process_loan.php',
        data: {
          amount: amount,
        },
        success: function (response) {
          if (response.status === 'success') {
            // Fetch user Details
            processSuccess(timerInterval, {
              title: 'Success...!',
              text: `Loan Amount of ${formatCurrency(
                amount,
                account.locale,
                account.currency
              )} Successfully sanctioned`,
              icon: 'success',
              confirmButtonText: 'OK',
            });
          } else {
            Swal.fire({
              title: 'Something Went Wrong...!',
              text: response.message,
              icon: 'error',
              confirmButtonText: 'OK',
            });
          }
        },
        error: function () {},
      });
    });
  } else {
    Swal.fire({
      title: 'Loan Not Sanctioned...!',
      text: `You are not eligible for loan of ${formatCurrency(
        amount,
        account.locale,
        account.currency
      )}`,
      icon: 'error',
      confirmButtonText: 'OK',
    });
  }
  inputLoanAmount.value = '';
});

// * Close Account
btnClose.addEventListener('click', function (e) {
  e.preventDefault();

  const userPassword = inputClosePin.value;

  if (inputCloseUsername.value === account.username && userPassword) {
    Swal.fire({
      title: 'Delete Account...?',
      text: `Are you sure you want to delete account '${account.owner}'`,
      icon: 'warning',
      confirmButtonText: 'OK',
      cancelButtonText: 'Cancel',
      showCancelButton: true,
    }).then(function (button) {
      if (button.isConfirmed) {
        $(document).ready(function () {
          $.ajax({
            type: 'POST',
            url: 'close_account.php',
            data: {
              email: account.username,
              password: userPassword,
            },
            success: function (response) {
              console.log(response.status);
              if (response.status === 'success') {
                processSuccess(timerInterval, {
                  title: 'Success...!',
                  text: `Your account '${account.username}' has been successfully closed...!'`,
                  icon: 'success',
                  confirmButtonText: 'OK',
                });
              } else {
                Swal.fire({
                  title: "Couldn't Close Account...",
                  text: response.message,
                  icon: 'error',
                  confirmButtonText: 'OK',
                });
              }
            },
            error: function () {},
          });
        });
      }
    });
  } else {
    Swal.fire({
      title: "Couldn't Close Account...!",
      text: 'Please Check the user credentials',
      icon: 'error',
      confirmButtonText: 'OK',
    });
  }

  inputCloseUsername.value = inputClosePin.value = '';
});

// * Logout
// Log out
btnLogout.addEventListener('click', function () {
  Swal.fire({
    title: 'Logout...!',
    text: 'Are you sure you want to log out ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
  }).then(result => {
    if (result.isConfirmed) {
      window.location.href = 'logout.php';
    }
  });
});
