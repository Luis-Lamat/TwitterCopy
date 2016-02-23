
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
    
    $.ajax({
        method: "POST",
        url: "../server.php",
        data: { 
            action: "Register",
            username: fields[0].val(),
            email: fields[1].val(), 
            password: fields[1].val(),
            password_confirmation: fields[2].val()
        },
        success: function(data){
            window.location.assign('homepage.php');
        },
        error: function (msg) {
            swal("Email or username already exists", "Please choose another.", "error");
        }
    });

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

    // ajax DB validation
    $.ajax({
        method: "POST",
        url: "../server.php",
        data: { 
            action: "Login", 
            email: fields[0].val(), 
            password: fields[1].val() 
        },
        success: function(data){
            window.location.assign('homepage.php');
        },
        error: function (msg) {
            swal("Incorrect email or password", "Please try again.", "error");
        }
    });
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
