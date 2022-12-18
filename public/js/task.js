const taskButtons = document.getElementsByClassName('taskLink');
[].forEach.call(taskButtons, function(btton) {
    btton.addEventListener('click', openSideTask);
});
const divOffcanvas = document.getElementsByClassName('offcanvasDiv')[0];

function openSideTask(event){
    let taskId = event.target.parentElement.id;
    let url = window.location.href;
    let projectId = url.substring(url.lastIndexOf('/') + 1);
    sendAjaxRequest('get', '../api/project/'+projectId+'/task/'+ taskId, {} ,showTaskHandler);
}

function closeSideTask(event){
    divOffcanvas.innerHTML = ``
}

function showTaskHandler(){ 
    divOffcanvas.innerHTML = JSON.parse(this.responseText);
    closeDivButton = document.getElementsByClassName('closeButton')[0];
    closeDivButton.addEventListener('click', closeSideTask);
}



