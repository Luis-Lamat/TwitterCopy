// sample user definition
var sample_users = [{
    'email': 'admin@lab.com',
    'password': '12345'
},{
    'email': 'luis@lab.com',
    'password': '12345'
}]; 

/**
 * main_function
 * 
 * Main function definition
 */
var main_function = function() {
    var class_name = document.getElementsByTagName('body')[0].className;

    switch(class_name) {
        case "login":
            $('#form').on('submit', authenticate_user);
            break;
        case "register":
            $('#form').on('submit', register_user);
            break;
    };  
};

/**
 * register_user
 * 
 * Method to register a user in the app, redirects to home. 
 * @param event, the form submit event.
 */
function register_user (event){
    event.preventDefault();
    var fields = [$('#username'), $('#email'), $('#password'), 
                  $('#password_confirmation')];
    if (!validate_fields(fields)){ return 0; }; // early exit
    alert("LOL");
};

/**
 * authenticate_user
 * 
 * Method to authenticate a user in the app, redirects to home. 
 * @param event, the form submit event.
 */
function authenticate_user (event) {
    event.preventDefault();
    var fields = [$('#email'), $('#password')];
    if (!validate_fields(fields)){ return 0; }; // early exit
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


/**
 * validate_fields
 * 
 * Method to validate if even one field of a field array is empty. 
 * @param field_array
 */
function validate_fields (field_array) {
    for (var i = field_array.length - 1; i >= 0; i--) {
        if (field_array[i].val() == "") {
            swal("Empty Fields", "Some fields were left empty, please try again.", "error");
            return false;
        }
    };
    return true;
};

// Main function binding call
$(document).on('ready', main_function);
