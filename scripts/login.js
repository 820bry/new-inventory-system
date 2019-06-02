window.onload = function() {
    ;
}

function onRegisterLinkPressed() {
    $(".login-content").removeClass("show");
    setTimeout(function() {
        $(".register-content").addClass("show");
    }, 750);
}

function onLoginLinkPressed() {
    $(".register-content").removeClass("show");
    setTimeout(function() {
        $(".login-content").addClass("show");
    }, 750);
}