let coordinatorButtons = document.getElementsByClassName("dropCoordinatorButton");
[].forEach.call(coordinatorButtons, function(btton) {
    btton.addEventListener('click', openDropDown);
});


function openDropDown(event){
    let buttonI = event.target;
    let buttonDrop = buttonI.parentElement;
    let divDrop = buttonDrop.nextElementSibling;
    divDrop.classList.toggle("show");
}

let removeMemberButtons = document.getElementsByClassName("removeMember");
[].forEach.call(removeMemberButtons, function(btton) {
    btton.addEventListener('click', removeMemberRequest);
});

function removeMemberRequest(event){
    let button = event.target;
    let div = button.parentElement.parentElement;
    let username = div.firstElementChild.innerText;
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
    let div = button.parentElement.parentElement;
    let username = div.firstElementChild.innerText;
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf('=') + 1);
    sendAjaxRequest('get', 'api/project/upgradeMember', {id:id, username:username} , upgradeMemberHandler);
}

function upgradeMemberHandler(){
    console.log(this.responseText);
}

