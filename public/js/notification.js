let buttonNotif = document.getElementById('notificationButton')
let divNotif = document.getElementsByClassName('notifications')[0]

buttonNotif.addEventListener('click',openNotifications)

function openNotifications(event){
    if (divNotif.style.display === "none") {
        divNotif.style.display = "block";
    } else {
        divNotif.style.display = "none";
    }
}

let deleteNotButtons = document.querySelectorAll('.deleteNot');
[].forEach.call(deleteNotButtons, function(deleteButton) {
    deleteButton.addEventListener('click', sendNotDeleteRequest);
});

function sendNotDeleteRequest(event){
    var button = event.target;
    var div = button.parentElement;
    var id = div.id;
    sendAjaxRequest('post', '/api/notification/delete', {id:id} , removeNotificationHandler);
}
  
function removeNotificationHandler(){
    let notification = JSON.parse(this.responseText);
    let divNotification = document.getElementById(notification.id);
    divNotification.remove();
}


function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
  }
  
  function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
  
    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
  }
