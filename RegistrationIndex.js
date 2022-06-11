const signinBtn = document.querySelector("#signinBtn");
const signupBtn = document.querySelector("#signupBtn");
const container = document.querySelector(".container");

signupBtn.addEventListener('click', () => {
    container.classList.add('signupMode');
});

signinBtn.addEventListener('click', () => {
    container.classList.remove('signupMode');
});