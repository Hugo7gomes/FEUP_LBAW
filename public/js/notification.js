var button = document.getElementById('notificationButton')
var div = document.getElementsByClassName('notifications')[0]

button.addEventListener('click',openNotifications)

function openNotifications(event){
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }

}
