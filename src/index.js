const active = document.querySelectorAll(".x-button");
const input = document.querySelector("#form__input");
const button = document.querySelector("#check__button");
console.log(active);

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

// function validateData() {
//     if(input.value = "" || ) {
//
//     }
// }


