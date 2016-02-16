 
// Global variable definition
var post_content = $('#post-content');
var post_btn = $('#post-btn');

// Main function definition
var main_function = function() {
    post_content.on('focus', expand_post_form);
    post_content.on('blur', retract_post_form);
    post_content.on('input', enable_post_btn);
    post_btn.on('click', create_post);
};

function expand_post_form () {
};

function retract_post_form () {
};

function enable_post_btn () {
    post_btn[0].disabled = (post_content.val().length == 0);
};

function create_post (event) {
    event.preventDefault();
    var post_text = post_content.val();

    if (post_text.length > 0){
        var new_post_wrap = $('.new-posts');
        var empty_post = $('.empty.post-card');

        // cloning the empty divs and prepending
        var new_empty_post = empty_post.clone();
        new_post_wrap.prepend(new_empty_post); 

        empty_post.removeClass('empty');
        empty_post.find('.post-creator')[0].innerHTML = "Luis Lamadrid";
        empty_post.find('.post-content')[0].innerHTML = post_text;
        empty_post.find('.post-footer')[0].innerHTML = "Posted today";
        empty_post.show();
        clear_post_fields();
    };

};

function clear_post_fields () {
    post_content.val("");
    enable_post_btn();
};

// Main function binding call
$(document).on('ready', main_function);
