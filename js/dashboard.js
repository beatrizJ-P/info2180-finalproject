url = "../includes/process-dashboard-filtering.php"
console.log("dashboard js loaded");
console.log("logged in as user id: " + document.getElementById("user-id").value);
// Add your dashboard-specific JavaScript code here
document.getElementById("fltr_btn_all").addEventListener("click", applyAllFilter);
document.getElementById("fltr_btn_sales").addEventListener("click", applySalesFilter);
document.getElementById("fltr_btn_support").addEventListener("click", applySupportFilter);
document.getElementById("fltr_btn_assigned").addEventListener("click", applyAssignedFilter);
function applyAllFilter(event) {
    const filter = document.getElementById("fltr_btn_all").textContent;
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
    const filter = document.getElementById("fltr_btn_sales").textContent;
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
    const filter = document.getElementById("fltr_btn_support").textContent;
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
    const filter = document.getElementById("fltr_btn_assigned").textContent;
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
