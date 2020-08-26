const input = document.querySelector("#form__input");
const button = document.querySelector("#check__button");
let x = 0;
let y = 0;
let r = 0;
// button.disabled = true;

function showTime() {
    let today = new Date();
    let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

    document.getElementById("timezone").innerHTML = `${date}, ${time}`;
    setTimeout(showTime, 1000);
}

showTime();

input.addEventListener('keyup', () => {
    input.value <= -3 || input.value >= 5 || !/^[0-9 | . | -]+$/i.test(input.value)
        ? input.style.border = "2px solid red"
        : input.style.border = "1px solid rgb(197 194 194)";
});

function takeX(number){
    console.log(number);
    let btn = document.getElementById("hidden");
    btn.value = number;
    x = number;
}

function getSelectedValue(){
    let btn = document.getElementById("hiddenR");
    let selector = document.getElementById("form__selector");
    let selectedValue = selector.options[selector.selectedIndex].value;
    btn.value = selectedValue;
    r = selectedValue;
}

function validateData() {
    console.log(button.disabled)
    input.value = "" || input.value <= -3 || input.value >= 5 || !/^[0-9 | . | -]+$/i.test(input.value)
        ? button.disabled = true
        : button.disabled = false;
}

setInterval(validateData,100);


