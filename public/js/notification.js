
let deleteNotButtons = document.querySelectorAll('.deleteNot');
[].forEach.call(deleteNotButtons, function (deleteButton) {
  deleteButton.addEventListener('click', sendNotDeleteRequest);
});

let ul = document.querySelector('.not');
ul.addEventListener('click', function (event) {
  event.stopPropagation();
});

function sendNotDeleteRequest(event) {
  var button = event.target;
  let divId = button.closest('.divNot').id;
  id = divId.split('k')[1];
  sendAjaxRequest('post', '/api/notification/delete', { id: id }, removeNotificationHandler);
}

function removeNotificationHandler() {
  let notification = JSON.parse(this.responseText);
  let divNotification = document.getElementById('task' + notification.id);
  let row = divNotification.parentElement;
  let li = row.parentElement;
  row.remove();
  let newRow = document.createElement('div');
  newRow.innerHTML = `<div class="col" style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <span class="text">Notifications empty</span>
          </li>
        </ul>
      </div>
`
  newRow.classList.add('row');
  if (li.innerHTML.trim() == "") {
    li.append(newRow);
  }
}



