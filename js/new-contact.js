url = "../includes/process-new-contact.php"
console.log("new contact js loaded");
document.getElementById("create-contact-btn").addEventListener("click", submitContact);

function submitContact() {
    console.log("submit contact called");
    const title = document.getElementById("title").value.trim();
    const firstName = document.getElementById("firstname").value.trim();
    const lastName = document.getElementById("lastname").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("telephone").value.trim();
    const company = document.getElementById("company").value.trim();
    const type = document.getElementById("type").value.trim();
    const assignedTo = document.getElementById("assigned_to").value.trim();
    const userId = document.getElementById("user-id").value;
    console.log("User ID:", userId);
    if (!title || !firstName || !lastName || !email || !phone || !company || !type || !assignedTo) {
        window.alert("Please enter valid contact information.");
        return;
    }
    if(firstName.length > 32 || lastName.length > 32){
        window.alert("First and last name cannot exceed 32 characters.");
        return;
    }
    console.log(title, firstName, lastName, email, phone, company, type, assignedTo);
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("result").innerHTML=this.responseText;
        }   
        else {
           document.getElementById("result").innerHTML="we got an Error: " + this.status;
        }
    };
    newXhttp.send("title="+encodeURIComponent(title)+"&firstname="+encodeURIComponent(firstName)+"&lastname="+encodeURIComponent(lastName)+"&email="+encodeURIComponent(email)+"&phone="+encodeURIComponent(phone)+"&company="+encodeURIComponent(company)+"&type="+encodeURIComponent(type)+"&assigned_to="+encodeURIComponent(assignedTo)+"&user_id="+encodeURIComponent(userId));
    //console.log(firstName, lastName, email, phone, address, city, state, zip);
}