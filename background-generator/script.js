var css = document.querySelector("h3");
var color1 = document.querySelector(".color1"); //color 1 is a class
var color2 = document.querySelector(".color2");
var text = document.querySelector(".div");
var body = document.getElementById("gradient");



function setGradient() {
    body.style.background = "linear-gradient(to right, " + color1.value + ", " +color2.value + ")";
    showText();
}

function showText() {
    css.textContent = body.style.background + ";";
    css.textContent.classList.toogle(".div");
}


color1.addEventListener("input", setGradient);
color2.addEventListener("input", setGradient);