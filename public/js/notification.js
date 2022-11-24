let buttonNotif = document.getElementById('notificationButton')
let divNotif = document.getElementsByClassName('notifications')[0]
divNotif.style.display = "none";
buttonNotif.addEventListener('click',openNotifications);

function openNotifications(event){
    if (divNotif.style.display == "none") {
        divNotif.style.display = "block";
    } else if(divNotif.style.display == "block"){
        divNotif.style.display = "none";
    }
}

let deleteNotButtons = document.querySelectorAll('.deleteNot');
[].forEach.call(deleteNotButtons, function(deleteButton) {
    deleteButton.addEventListener('click', sendNotDeleteRequest);
});

function sendNotDeleteRequest(event){
    var button = event.target;
    let id = button.closest('div.col').id;
    sendAjaxRequest('post', '/api/notification/delete', {id:id} , removeNotificationHandler);
}

function removeNotificationHandler(){
    let notification = JSON.parse(this.responseText);
    let divNotification = document.getElementById(notification.id);
    divNotification.remove();
}



