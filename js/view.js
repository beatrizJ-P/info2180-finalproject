url="../includes/process-change-type.php"
console.log("view js loaded");
const form = document.getElementById("add-note-form");
form.addEventListener("submit", function (event) {
    event.preventDefault();
    url="../includes/process-add-note.php"
    console.log("Form submission prevented");
    const noteContent = form.elements['add'].value.trim();
    const contactId = document.getElementById("contact-id").value;
    const userId = document.getElementById("user-id").value;
    console.log("Note Content:", noteContent);
    console.log("Contact ID:", contactId);
    console.log("User ID:", userId);
    if (!noteContent) {
        window.alert("Please enter a note before submitting.");
        return;
    }
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.querySelector("#fetch-notes").innerHTML=this.responseText;
           form.reset();
        }   
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("note="+encodeURIComponent(noteContent)+"&contact_id="+encodeURIComponent(contactId)+"&user_id="+encodeURIComponent(userId));

  });
document.getElementById("switch").addEventListener("click", changeType);
document.getElementById("assign").addEventListener("click", assignContact);

function assignContact() {
    url="../includes/process-assign-self.php"
    console.log("assign contact called");
    const id=document.getElementById("contact-id").value;
    const userId = document.getElementById("user-id").value;
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
            //console.log("Contact assigned successfully "+this.responseText);
            document.getElementById("assign").innerHTML=this.responseText;
            setTimeout(() => {
            document.getElementById("assign").innerHTML = "<i class ='fas fa-hand-paper'></i> Assign to Me";
            }, 3000);
            
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("contact_id="+encodeURIComponent(id)+"&user_id="+encodeURIComponent(userId));
}

function changeType() {
    console.log("change type called");
    const type = document.getElementById("switch").textContent;
    const id=document.getElementById("contact-id").value;
    if(type.includes("Support")){
        const newXhttp = new XMLHttpRequest();
        newXhttp.open("POST", url, true);
        newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("switch").innerHTML= '<i class="fas fa-exchange"></i>' + this.responseText;
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("type=Support&contact_id="+encodeURIComponent(id));
    }else if(type.includes("Sales")){
        const newXhttp = new XMLHttpRequest();
        newXhttp.open("POST", url, true);
        newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("switch").innerHTML= '<i class="fas fa-exchange"></i>' + this.responseText;
        }
        else {
            window.alert("we got an Error: " + this.status);
        }
        };
        newXhttp.send("type=Sales&contact_id="+encodeURIComponent(id));
    }
}