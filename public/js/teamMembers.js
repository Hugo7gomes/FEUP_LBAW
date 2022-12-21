function addEventListeners() {

    let removeMemberButtons = document.getElementsByClassName("removeMember");
    [].forEach.call(removeMemberButtons, function(btton) {
        btton.addEventListener('click', removeMemberRequest);
    });

    let upgradeMemberButtons = document.getElementsByClassName("upgradeMember");
    [].forEach.call(upgradeMemberButtons, function(btton) {
        btton.addEventListener('click', upgradeMemberRequest);
    });

}

function removeMemberRequest(event){
    let button = event.target;
    let div = button.parentElement.parentElement;
    let a = div.firstElementChild.firstElementChild.nextElementSibling;
    let username = a.innerText;
    let url = window.location.href;
    let id = url.split('/')[4]

    sendAjaxRequest('post', '/api/project/'+id+'/removeMember', {username:username} , removeMemberHandler);
}

function removeMemberHandler(){
    location.reload();
}

function upgradeMemberRequest(event){
    let button = event.target;
    let div = button.parentElement.parentElement;
    let a = div.firstElementChild.firstElementChild.nextElementSibling;
    let username = a.innerText;
    let url = window.location.href;
    let id = url.split('/')[4]
    sendAjaxRequest('post', '/api/project/'+id+'/upgradeMember', {username:username} , upgradeMemberHandler);
}

function upgradeMemberHandler(){
    location.reload();
}

addEventListeners();

