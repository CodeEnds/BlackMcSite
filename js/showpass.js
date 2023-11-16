function showPass() {
    let authpassword = document.getElementById("authpassword");
    if(authpassword.getAttribute("type") == "password"){
        authpassword.setAttribute("type", "text");
    } else {
        authpassword.setAttribute("type", "password");
    }

}
