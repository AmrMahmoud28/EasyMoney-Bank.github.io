const dashboardBtn = document.querySelector("#dashboardBtn");
const historyBtn = document.querySelector("#historyBtn");
const depositBtn = document.querySelector("#depositBtn");
const withdrawBtn = document.querySelector("#withdrawBtn");
const showAll = document.querySelector("#showAll");

const dashboard = document.querySelector("#dashboard");
const dashboard1 = document.querySelector("#dashboard1");

const history = document.querySelector("#history");
const deposit = document.querySelector("#deposit");
const withdraw = document.querySelector("#withdraw");

dashboardBtn.addEventListener('click', () => {
    dashboardBtn.classList.add('active');
    dashboard.style.display = "block";
    dashboard1.style.display = "block";

    historyBtn.classList.remove('active');
    history.style.display = "none";

    depositBtn.classList.remove('active');
    deposit.style.display = "none";

    withdrawBtn.classList.remove('active');
    withdraw.style.display = "none";
});

function getHistory(){
    dashboardBtn.classList.remove('active');
    dashboard.style.display = "none";
    dashboard1.style.display = "none";

    historyBtn.classList.add('active');
    history.style.display = "block";

    depositBtn.classList.remove('active');
    deposit.style.display = "none";

    withdrawBtn.classList.remove('active');
    withdraw.style.display = "none";
}

historyBtn.addEventListener('click', getHistory);
showAll.addEventListener('click', getHistory);

depositBtn.addEventListener('click', () => {
    dashboardBtn.classList.remove('active');
    dashboard.style.display = "none";
    dashboard1.style.display = "none";

    historyBtn.classList.remove('active');
    history.style.display = "none";

    depositBtn.classList.add('active');
    deposit.style.display = "block";

    withdrawBtn.classList.remove('active');
    withdraw.style.display = "none";
});

withdrawBtn.addEventListener('click', () => {
    dashboardBtn.classList.remove('active');
    dashboard.style.display = "none";
    dashboard1.style.display = "none";

    historyBtn.classList.remove('active');
    history.style.display = "none";

    depositBtn.classList.remove('active');
    deposit.style.display = "none";

    withdrawBtn.classList.add('active');
    withdraw.style.display = "block";
});

// =======================================================================

const depositAmountBtns = document.querySelectorAll(".depositAmountBtn");
const depositField = document.querySelector("#depositField");
const depositSubmit = document.querySelector(".depositSubmit");

depositAmountBtns.forEach(depositAmountBtn => {
    depositAmountBtn.addEventListener('click', () => {
        let amount = depositAmountBtn.textContent.substring(1);
        depositField.value = amount;
    })
});

// =======================================================================

const withdrawAmountBtns = document.querySelectorAll(".withdrawAmountBtn");
const withdrawField = document.querySelector("#withdrawField");
const withdrawSubmit = document.querySelector(".withdrawSubmit");

withdrawAmountBtns.forEach(withdrawAmountBtn => {
    withdrawAmountBtn.addEventListener('click', () => {
        let amount = withdrawAmountBtn.textContent.substring(1);
        withdrawField.value = amount;
    })
});