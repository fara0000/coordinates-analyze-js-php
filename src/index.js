const active = document.querySelectorAll(".x-button");
const input = document.querySelector("#form__input");
const button = document.querySelector("#check__button");
let x = 0;
let y = 0;
let r = 0;

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

console.log(active);

// for(let i = 0; i < active.length; i++) {
//     active[i].onclick = function () {
//        // let clickedValue = document.querySelector(".x-button").value;
//        let checked = this.getAttribute('data');
//        console.log(checked);
//        return checked;
//     }
// }

function takeX(number){
    console.log(number);
    let btn = document.getElementById("hidden");
    btn.value = number;
    r = number;
}

function getSelectValue(){
    // let btn = document.getElementById("hiddenR");
    // btn.value = number;
    // r = number;
    let btn = document.getElementById("form__selector").value;
    console.log(btn);
}

// function validateData() {
//     if(input.value = "" || ) {
//
//     }
// }


