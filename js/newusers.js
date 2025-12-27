url ="../includes/process_new_user.php"
console.log("whats up chat?");
document.getElementById("btn-submit").addEventListener("click", submitUser);
//document.getElementById("daniel-add-new-user-btn").addEventListener("click", );

function submitUser() {
    console.log("submit user called");
    const firstName = document.getElementById("firstname").value.trim();
    const lastName = document.getElementById("lastname").value.trim();
    const email = document.getElementById("email").value.trim();
    
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;
    if (!firstName || !lastName || !email) {
        window.alert("Please enter valid user information.");
        return;
    }
    if(firstName.length > 32 || lastName.length > 32){
        window.alert("First and last name cannot exceed 32 characters.");
        return;
    }
    if(!password){
        window.alert("Password is a required field.");
        return;
    }
    if(password.length < 8){
        window.alert("Password must be at least 8 characters long.");
        return;
    }
    const hasNumber = /\d/.test(password);
    const hasUppercase = /[A-Z]/.test(password);
    const hasLetter = /[a-zA-Z]/.test(password);

    if (!hasNumber || !hasUppercase || !hasLetter) {
    console.log("Password is invalid");
    window.alert("Password must contain at least one letter, one uppercase letter, and one number.");
    return;
    } else {
    console.log("Password is valid");
    
    const newXhttp = new XMLHttpRequest();
    newXhttp.open("POST", url, true);
    newXhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    newXhttp.onload = function checkStatus() {
        if (this.status === 200) {
           document.getElementById("result").innerHTML=this.responseText;
        }   
        else {
            window.alert("we got an Error: " + this.status);
        }
    };
    newXhttp.send("firstname="+encodeURIComponent(firstName)+"&lastname="+encodeURIComponent(lastName)+"&email="+encodeURIComponent(email)+"&password="+encodeURIComponent(password)+"&role="+encodeURIComponent(role));
    //console.log(firstName, lastName, email, password, role);
    }
}