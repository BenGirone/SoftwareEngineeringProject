
function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password2").value;
    var errorBox = document.getElementById("passwordError");

    if (password != confirmPassword)
    {    
    	errorBox.innerHTML = 'Passwords Do Not Match';
    }
    else
    {
        errorBox.innerHTML = '<br />';
    }
}