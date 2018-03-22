pages = []

window.onload = setup();

window.onhashchange = function() {
    get("login", function(){
        isLoggedIn(function(success){
            if(success){
                window.location.replace("/cm740/coursework/#/home");
            }else{
                render("login");
            }
        })
    })
    get("home", function(){
        isLoggedIn(function(success){
            if(success){
                render("home")
            }else{
                window.location.replace("/cm740/coursework/#/login");
            }
        })
    })
    get("logout", function(){
        window.location.replace("/cm740/coursework/logout.php");
    })
    error(function(){
        isLoggedIn(function(success){
            if(success){
                window.location.replace("/cm740/coursework/#/home");
            }else{
                window.location.replace("/cm740/coursework/#/login");
            }
        })
        
    })
}

document.getElementById("submit_login").onclick = function(event){
    event.preventDefault();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log("success");
            window.location.replace("/cm740/coursework/");
        }
    };
    xhttp.open("POST", "/cm740/coursework/login.php", true);
    xhttp.send(formData);

}

function setup(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            new_pages = JSON.parse(this.response)
            new_pages.forEach(page => {
                pages.push(page.slice(0, page.length - 4))
            });
            window.onhashchange();
        }
    };
    xhttp.open("POST", "/cm740/coursework/js_setup.php", true);
    xhttp.send();
}

function render(page){
    if(pages.includes(page)){
        document.getElementById(page).style.removeProperty("display");
        pages.forEach(paper => {
            if(paper != page){
                document.getElementById(paper).style.setProperty("display", "none");
            }
        });
    }
}

function get(page, func){
    url = "#/"+page
    if(window.location.hash == url){
        func()
    }
}

function error(func){
    pages.forEach(page => {
        part_url = window.location.hash.slice(2)
        if(!pages.includes(part_url)){
            func()
        }
    })
}

function isLoggedIn(callback){
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/cm740/coursework/is_logged_in.php", true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(JSON.parse(this.response)){
                console.log("logged");
                callback(true);
            }else{
                callback(false);
            }
        }
    };
}