// Global variable definition
var post_content = $('#post-content');
var post_btn = $('#post-btn');

/**
 * main_function
 * 
 * Main function definition
 */
 var main_function = function() {
    load_all_posts();
    // post_content.on('focus', expand_post_form);
    // post_content.on('blur', retract_post_form);
    post_content.on('input', enable_post_btn);
    post_btn.on('click', create_post);
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
                load_post(data.id, data.author, post_text, data.created_at);
                clear_post_fields();
            },
            error: function (msg) {
                console.log(msg);
                swal("There was an error", "Check dev console", "error");
            }
        });
    };

};

/**
 * load_all_posts
 * 
 * Method to load all posts from DB to html. 
 */
function load_all_posts () {
    $.ajax({
        method: "GET",
        url: "../posts_controller.php?action=get_all_posts",
        dataType: "json",
        success: function(d){
            for (var i = d.length - 1; i >= 0; i--) {
                // TODO: d[i].id returns the id of the post (for the href)
                load_post(d[i].id,d[i].username, d[i].content, d[i].created_at);
            };
        },
        error: function (msg) {
            console.log("There are no posts in the database.");
        }
    });
}

/**
 * load_post
 * 
 * Method to load a single post to html.
 * @param author, of post
 * @param content, of post
 * @param date, created
 */
function load_post (id, author, content, date) {
    var new_post_wrap = $('.new-posts');
    var empty_post = $('.empty.post-card');

    // cloning the empty divs and prepending
    var new_empty_post = empty_post.clone();
    new_post_wrap.prepend(new_empty_post); 

    empty_post.removeClass('empty');
    var post_creator = empty_post.find('.post-creator')[0];
    post_creator.innerHTML = author;
    post_creator.setAttribute('href', 'profile.php?user_id=' + id);
    empty_post.find('.post-content')[0].innerHTML = content;
    empty_post.find('.post-footer')[0].innerHTML = "Posted on " + date;
    empty_post.show();
}

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
