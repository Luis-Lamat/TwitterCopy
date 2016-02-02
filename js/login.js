// sample user definition
var sample_users = [{
    'email': 'admin@lab.com',
    'password': '12345'
},{
    'email': 'luis@lab.com',
    'password': '12345'
}]; 

// Main function definition
var main_function = function() {
    $('#form').on('submit', authenticate_user);
};

function authenticate_user (event) {
    event.preventDefault();
    var email = $('#email').val();
    var passw = $('#password').val();
    if (!validate_fields(email, passw)){ return 0; };
    var is_valid = 0; // false === 0
    for (var i = sample_users.length - 1; i >= 0 && !is_valid; i--) {
        if (sample_users[i]['email'] == email) {
            is_valid = (sample_users[i]['password'] == passw);
        };
    };

    if (is_valid) {
        window.location.assign('homepage.html');
    } else {
        swal("Incorrect email or password", "Please try again.", "error");
    };
};

function validate_fields (email, password) {
    if (email == "" || password == "") {
        swal("Empty Fields", "Some fields were left empty, please try again.", "error");
        return false;
    };
    return true;
};

// Main function binding call
$(document).on('ready', main_function);
