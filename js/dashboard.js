url = "../includes/process-dashboard-filtering.php"
console.log("dashboard js loaded");
console.log("logged in as user id: " + document.getElementById("user-id").value);
// Add your dashboard-specific JavaScript code here
document.getElementById("fltr-btn-all").addEventListener("click", applyAllFilter);
document.getElementById("fltr-btn-sales").addEventListener("click", applySalesFilter);
document.getElementById("fltr-btn-support").addEventListener("click", applySupportFilter);
document.getElementById("fltr-btn-assigned").addEventListener("click", applyAssignedFilter);
function applyAllFilter(event) {
    const filter = document.getElementById("fltr-btn-all").textContent;
    console.log("Filter applied: " + filter);
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("results").innerHTML=this.responseText;
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("filter="+encodeURIComponent(filter));
}
function applySalesFilter(event) {
    const filter = document.getElementById("fltr-btn-sales").textContent;
    console.log("Filter applied: " + filter);
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("results").innerHTML=this.responseText;
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("filter="+encodeURIComponent(filter));
}
function applySupportFilter(event) {
    const filter = document.getElementById("fltr-btn-support").textContent;
    console.log("Filter applied: " + filter);
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("results").innerHTML=this.responseText;
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("filter="+encodeURIComponent(filter));
}
function applyAssignedFilter(event) {
    const filter = document.getElementById("fltr-btn-assigned").textContent;
    const id = document.getElementById("user-id").value;
    console.log("Filter applied: " + filter);
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("results").innerHTML=this.responseText;
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("filter="+encodeURIComponent(filter)+"&id="+encodeURIComponent(id));
}

const filterButtons = document.querySelectorAll('#fltr-btn-all, #fltr-btn-assigned, #fltr-btn-sales, #fltr-btn-support');
const slider = document.querySelector('#slider_indicator');

function selectButton(button) {
    filterButtons.forEach(btn => btn.classList.remove('active'));
    filterButtons[button].classList.add('active');

    const selectedButton = filterButtons[button];
    const buttonRight=selectedButton.offsetRight;
    const buttonLeft=selectedButton.offsetLeft;
    const buttonWidth=selectedButton.offsetWidth;

    slider.style.width = buttonWidth + 'px';
    slider.style.left = buttonLeft + 'px';
    slider.style.right = buttonRight + 'px';

    document.addEventListener('DOMContentLoaded', () => {
        if (filterButtons.length > 0) {
            selectButton(0); // Select the first button (All) on page load
        }
    });

}
