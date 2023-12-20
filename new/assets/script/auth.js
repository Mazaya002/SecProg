document.querySelector(".login-button").addEventListener("click", (e) => {
    e.preventDefault();
    let username = document.querySelector('input[type="text"]').value;
    let password = document.querySelector('input[type="password"]').value;

    if (!username || !password) {
        let errorMessage = "";
        if (!username) {
            errorMessage += "Username is empty. ";
        }
        if (!password) {
            errorMessage += "Password is empty. ";
        }
        alert(errorMessage);
        return;
    }

    // For simplicity, this example uses basic if else condition
    // In a real world application, you should use more secure ways like JWT, bcrypt, etc.
    if (username === "admin" && password === "admin") {
        alert('Welcome Admin');
        // Redirect to admin dashboard or any other page based on the user type
    } else if (username === "user" && password === "user") {
        alert('Welcome User');
        // Redirect to user dashboard or any other page based on the user type
    } else {
        alert('Invalid username or password');
    }
});

document.querySelector(".register-button").addEventListener("click", (e) => {
    e.preventDefault();
    let username = document.querySelector('input[type="text"]').value;
    let password = document.querySelector('input[type="password"]').value;

    if (!username || !password) {
        let errorMessage = "";
        if (!username) {
            errorMessage += "Username is empty. ";
        }
        if (!password) {
            errorMessage += "Password is empty. ";
        }
        alert(errorMessage);
        return;
    }

    // Here you can add the code to save the username and password to your database
    alert("User registered successfully");
});