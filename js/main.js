 
// Global variable definition
var post_content = $('#post-content');
var post_btn = $('#post-btn');

/**
 * main_function
 * 
 * Main function definition
 */
 var main_function = function() {
    // post_content.on('focus', expand_post_form);
    // post_content.on('blur', retract_post_form);
    post_content.on('input', enable_post_btn);
    post_btn.on('click', create_post);
};

function expand_post_form () {
};

function retract_post_form () {
};

/**
 * create_post
 * 
 * Method to create a post on the DB and in the front-end. 
 * @param event, the form post submit event.
 */
function create_post (event) {
    event.preventDefault();
    var post_text = post_content.val();

    if (post_text.length > 0){

        // insert into DB
        $.ajax({
            method: "POST",
            url: "../posts_controller.php",
            dataType: "json",
            data: { 
                action: "create_post",
                content: post_text
            },
            success: function(data){
                var new_post_wrap = $('.new-posts');
                var empty_post = $('.empty.post-card');

                // cloning the empty divs and prepending
                var new_empty_post = empty_post.clone();
                new_post_wrap.prepend(new_empty_post); 

                empty_post.removeClass('empty');
                empty_post.find('.post-creator')[0].innerHTML = data.author;
                empty_post.find('.post-content')[0].innerHTML = post_text;
                empty_post.find('.post-footer')[0].innerHTML = "Posted on " + data.created_at;
                empty_post.show();
                clear_post_fields();
            },
            error: function (msg) {
                swal("Incorrect email or password", "Please try again.", "error");
            }
        });
    };

};

/**
 * clear_post_fields
 * 
 * Method to claer the post input fields and disable the post btn if needed. 
 */
function clear_post_fields () {
    post_content.val("");
    enable_post_btn();
};

/**
 * enable_post_btn
 * 
 * Method to enable the post btn if valid input. 
 */
function enable_post_btn () {
    post_btn[0].disabled = (post_content.val().length == 0);
};

// Main function binding call
$(document).on('ready', main_function);
