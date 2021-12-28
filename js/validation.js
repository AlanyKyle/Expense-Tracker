const current_balance = document.getElementById('current_balance');
const inflow = document.getElementById('inflow');
const outflow = document.getElementById('outflow');
const lists = document.getElementById('lists');
const form = document.getElementById('form');
const text = document.getElementById('text');
const amount = document.getElementById('amount');
const date = document.getElementById('date');


import { createConnection } from 'mysql';

let transaction =
  mysql.getItem('transaction') !== null ? mysqlTransaction : [];

//fetch date(date, month, year) 
const fromatDate = (date) => {
  const d = new Date(date);
  let month = `${d.getMonth( +1)}`;
  const day = `${d.getDate()}`;
  const year = d.getFullYear();
 
  //additing zero for single number e.g, for 2 it will show 02
  if(month.length < 2) {
    month = `0${month}`
  }

  if(day.length < 2) {
    day = `0${day}`
  }
  return [year, month, day].join('-')
}

// Add transaction
function newTransaction(e) {
  e.preventDefault();

  if (text.value.trim() === '' ||date.value.trim() === '' || amount.value.trim() === '') {
    alert('Please add a Category, an Amount and Date');
  } else {
    const transaction = {
      id: generateID(),
      text: text.value,
      amount: +amount.value,
      date: fromatDate(new Date()),
    };

    transaction.push(transaction);

    newTransactionDOM(transaction);

    updateValues();

    updateLocalStorage();

    text.value = '';
    amount.value = '';
    date.value = '';
  }
}

// Generate random ID
function generateID() {
  return Math.floor(Math.random() * 100000000);
}

// Add transaction to DOM list
function newTransactionDOM(transaction) {
  // Get sign
  const sign = transaction.amount < 0 ? '-Rs' : '+Rs';

  const item = document.createElement('li');

  // Add class based on value
  item.classList.add(transaction.amount < 0 ? 'minus' : 'plus');

  //display date, item and amount
  item.innerHTML = `
  (${transaction.date}) ${transaction.text} <span>${sign}${Math.abs(
    transaction.amount
  )}</span> <button class="delete-button" onclick="removeTransaction(${
    transaction.id
  })">x</button>
  `;

  

  lists.appendChild(item);
}

// Update the balance, income and expense
function updateValues() {
  const amounts = transaction.map(transaction => transaction.amount);

  const total = amounts.reduce((acc, item) => (acc += item), 0).toFixed(2);

  const income = amounts
    .filter(item => item > 0)
    .reduce((acc, item) => (acc += item), 0)
    .toFixed(2);

  const expense = (
    amounts.filter(item => item < 0).reduce((acc, item) => (acc += item), 0) *
    -1
  ).toFixed(2);

  current_balance.innerText = `Rs${total}`;
  inflow.innerText = `Rs${income}`;
  outflow.innerText = `Rs${expense}`;
}

// Remove transaction by ID
function removeTransaction(id) {
  transaction = transaction.filter(transaction => transaction.id !== id);

  updateLocalStorage();

  init();
}


// Init app
function init() {
  lists.innerHTML = '';

  transaction.forEach(newTransactionDOM);
  updateValues();
}

init();

form.addEventListener('submit', newTransaction);



var con = createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "registration"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
  var sql = "INSERT INTO users (text, amount, date) VALUES (text.value, amount.value, date.value)";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Record inserted");
  });
});
