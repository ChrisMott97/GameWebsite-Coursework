pages = []

window.onload = setup();

window.onhashchange = function() {
    get("login", function(){
        render("login");
    })
    get("home", function(){
        render("home")
    })
    error(function(){
        window.location.replace("/cm740/coursework/#/login");
    })
}

document.getElementById("submit_login").onclick = function(event){
    event.preventDefault();
    window.location.replace("/cm740/coursework/#/home");
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