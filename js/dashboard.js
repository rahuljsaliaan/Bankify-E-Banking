"use strict";

const labelWelcome = document.querySelector(".welcome");
const labelDate = document.querySelector(".date");
const labelBalance = document.querySelector(".balance__value");
const labelSumIn = document.querySelector(".summary__value--in");
const labelSumOut = document.querySelector(".summary__value--out");
const labelSumInterest = document.querySelector(".summary__value--interest");
const labelTimer = document.querySelector(".timer");

const containerApp = document.querySelector(".app");
const containerMovements = document.querySelector(".movements");

const btnTransfer = document.querySelector(".form__btn--transfer");
const btnLoan = document.querySelector(".form__btn--loan");
const btnClose = document.querySelector(".form__btn--close");
const btnSort = document.querySelector(".btn--sort");

const inputTransferTo = document.querySelector(".form__input--to");
const inputTransferAmount = document.querySelector(".form__input--amount");
const inputLoanAmount = document.querySelector(".form__input--loan-amount");
const inputCloseUsername = document.querySelector(".form__input--user");
const inputClosePin = document.querySelector(".form__input--pin");

// * Get account details
let account = {};

const fetchDetails = function () {
  $(document).ready(function () {
    $.ajax({
      type: "POST",
      url: "get_info.php",
      success: function (response) {
        if (response) {
          account = { ...response };
          console.log(account);
        } else {
        }
      },
      error: function () {},
    });
  });
};

fetchDetails();

// * Display movements
const displayMovements = function (acc, sort = false) {
  containerMovements.innerHTML = "";

  const moves = sort
    ? acc.movements.slice().sort((a, b) => a - b)
    : acc.movements;

  moves.forEach(function (mov, i) {
    const type = mov > 0 ? "deposit" : "withdrawal";

    // calculate movements date
    const date = new Date(acc.movementsDates[i]);
    const displayDate = formatDate(date, currentAccount.locale);

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

    containerMovements.insertAdjacentHTML("afterbegin", html);
  });
};

// * Display Balance
const calcDisplayBalance = function (acc) {
  acc.balance = acc.movements.reduce((acc, mov) => acc + mov, 0).toFixed(2);
  labelBalance.textContent = `${formatCurrency(
    acc.balance,
    acc.locale,
    acc.currency
  )}`;
};

// * Display Summary
const calcDisplaySummary = function (acc) {
  const incomes = acc.movements
    .filter((mov) => mov > 0)
    .reduce((acc, mov) => acc + mov, 0);
  labelSumIn.textContent = `${formatCurrency(
    incomes,
    acc.locale,
    acc.currency
  )}`;

  const out = Math.abs(
    acc.movements.filter((mov) => mov < 0).reduce((acc, mov) => acc + mov, 0)
  );
  labelSumOut.textContent = `${formatCurrency(out, acc.locale, acc.currency)}`;

  const interest = acc.movements
    .filter((mov) => mov > 0)
    .map((deposit) => (deposit * acc.interestRate) / 100)
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
