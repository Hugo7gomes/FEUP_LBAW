var buttonNotif = document.getElementById('notificationButton')
var divNotif = document.getElementsByClassName('notifications')[0]

buttonNotif.addEventListener('click',openNotifications)

function openNotifications(event){
    if (divNotif.style.display === "none") {
        divNotif.style.display = "block";
    } else {
        divNotif.style.display = "none";
    }

}
