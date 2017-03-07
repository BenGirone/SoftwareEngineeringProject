/**
* This is a function that checks if two password input fields are identical.
* @pre  - there are two password input fields with the Id 'password' and 'password2'
*       - there is a text span with the Id 'passwordError'
* @post - the text of the errorBox is set to the appropriate value
* @return none
*/
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