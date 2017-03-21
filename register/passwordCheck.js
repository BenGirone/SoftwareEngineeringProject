/**
* This is a function that checks if two password input fields are identical.
* @pre  - there are two password input fields with the Id 'password' and 'password2'
*       - there is a text span with the Id 'passwordError'
* @post - the text of the errorBox is set to the appropriate value
* @return none
*/
function checkMatch(ID_1, ID_2, ID_3, ID_4, errorMessage) {
    var password = document.getElementById(ID_1).value;
    var confirmPassword = document.getElementById(ID_2).value;
    var errorBox = document.getElementById(ID_3);
    var submitButton = document.getElementById(ID_4);

    if (password != confirmPassword)
    {    
    	errorBox.innerHTML = errorMessage;
        submitButton.disabled = true;
    }
    else
    {
        errorBox.innerHTML = '<br />';
        submitButton.disabled = false;
    }
}