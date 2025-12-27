document.addEventListener("DOMContentLoaded", function() {
    
    const form = document.querySelector("form");
    const loginError = document.getElementById("loginError");

    form.addEventListener("submit", function(e) {
        e.preventDefault()
        
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        fetch("../includes/loginConfig.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body:`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            loginError.innerText = data.message;
            if (data.status === "success") {
                window.location.href = "../pages/dashboard.php";
            }
        })
        .catch(error => console.error("Error:", error));
    });

});