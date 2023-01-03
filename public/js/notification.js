
let deleteNotButtons = document.querySelectorAll('.deleteNot');
[].forEach.call(deleteNotButtons, function(deleteButton) {
    deleteButton.addEventListener('click', sendNotDeleteRequest);
});

function sendNotDeleteRequest(event){
    var button = event.target;
    let id = button.closest('.divNot').not-id;
    sendAjaxRequest('post', '/api/notification/delete', {id:id} , removeNotificationHandler);
}

function removeNotificationHandler(){
    let notification = JSON.parse(this.responseText);
    let divNotification = document.querySelector('[not-id=${notification.id}]');
    divNotification.remove();
    
}



