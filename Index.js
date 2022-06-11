const themeBtn = document.getElementById("theme");
const logo = document.getElementById("logo");
const headerImg = document.getElementById("headerImg");

function getCurrentTheme(){
    let theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? "dark" : "light";
    localStorage.getItem('EasyMoney.theme') ? theme = localStorage.getItem('EasyMoney.theme') : null;
    return theme;
}

function loadTheme(theme){
    const root = document.querySelector(':root');
    try {
        if(theme === "light"){
            themeBtn.innerHTML = "Dark Mode";
            logo.src = "/images/svgviewer-output (1) (1).svg";
            headerImg.src = "images/svgviewer-output.svg";
        }
        else{
            themeBtn.innerHTML = "Light Mode";
            logo.src = "images/White logo.svg";
            headerImg.src = "images/header dark.svg";
        }
    } catch (error) {  
    }
    
    root.setAttribute('color-scheme' , `${theme}`)
}

themeBtn.addEventListener('click' , () => {
    let theme = getCurrentTheme();
    if(theme === "light"){
        theme = "dark";
    }
    else{
        theme = "light";
    }

    localStorage.setItem('EasyMoney.theme' , `${theme}`)
    loadTheme(theme);
})

window.addEventListener('DOMContentLoaded' , () => {
    loadTheme(getCurrentTheme());
})