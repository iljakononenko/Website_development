function switch_authentification() {

    var sign_up = document.querySelector(".signup");
    var log_in = document.querySelector(".login");

    if (sign_up.classList.contains("invisible") === true) {
        sign_up.classList.remove("invisible");
    } else {
        x.classList.add("invisible");
    }

}

function set_login() {

    var sign_up = document.querySelector(".signup");
    var log_in = document.querySelector(".login");

    sign_up.classList.add("invisible");
    log_in.classList.remove("invisible");

}

function set_signup() {

    var sign_up = document.querySelector(".signup");
    var log_in = document.querySelector(".login");

    sign_up.classList.remove("invisible");
    log_in.classList.add("invisible");

}