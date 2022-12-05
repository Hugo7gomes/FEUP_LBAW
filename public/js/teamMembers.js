let coordinatorButtons = document.getElementsByClassName("dropCButton");
[].forEach.call(coordinatorButtons, function(btton) {
    btton.addEventListener('click', openDropDown);
});


function openDropDown(event){
    let buttonI = event.target;
    let buttonDrop = buttonI.parentElement;
    let divDrop = buttonDrop.nextElementSibling;
    if(divDrop.style.display == "none"){
        divDrop.style.display = "block"
    }else{
        divDrop.style.display = "none"
    }
}

let removeMemberButtons = document.getElementsByClassName("removeMember");
[].forEach.call(removeMemberButtons, function(btton) {
    btton.addEventListener('click', removeMemberRequest);
});

function removeMemberRequest(event){
    let button = event.target;
    let div = button.parentElement.parentElement.parentElement;
    let img = div.firstElementChild;
    let username = img.nextElementSibling.innerText;
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf('=') + 1);


    sendAjaxRequest('post', '/api/project/removeMember', {id:id, username:username} , removeMemberHandler);
}

function removeMemberHandler(){
    location.reload();
}

let upgradeMemberButtons = document.getElementsByClassName("upgradeMember");
[].forEach.call(upgradeMemberButtons, function(btton) {
    btton.addEventListener('click', upgradeMemberRequest);
});

function upgradeMemberRequest(event){
    let button = event.target;
    let div = button.parentElement.parentElement.parentElement;
    let img = div.firstElementChild;
    let username = img.nextElementSibling.innerText;
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf('=') + 1);
    console.log(username)
    console.log(id)
    sendAjaxRequest('post', '/api/project/upgradeMember', {id:id, username:username} , upgradeMemberHandler);
}

function upgradeMemberHandler(){
    location.reload();
}
