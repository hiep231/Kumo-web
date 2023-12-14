const button = document.querySelector('.name-page');
const leftside = document.querySelector('.left-side');
const rightside = document.querySelector('.rightside');

function myFunction() {
    if (leftside.classList.contains('left-side') && rightside.classList.contains('rightside')) {
        leftside.classList.remove('left-side');
        leftside.classList.add('left-side-short');
        rightside.classList.remove('rightside');
        rightside.classList.add('rightside_max');
        button.classList.remove('name-page');
        button.classList.add('name-page-max');
    } else {
        leftside.classList.remove('left-side-short');
        leftside.classList.add('left-side');
        rightside.classList.remove('rightside_max');
        rightside.classList.add('rightside');
        button.classList.remove('name-page-max');
        button.classList.add('name-page');
    }
}
document.getElementById("preloader").style.display = "flex";

window.addEventListener("load", function () {
    document.getElementById("preloader").style.display = "none";
});
