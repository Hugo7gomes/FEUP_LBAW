const taskButtons = document.getElementsByClassName('taskLink');
[].forEach.call(taskButtons, function(btton) {
    btton.addEventListener('click', openSideTask);
});
const divOffcanvas = document.getElementsByClassName('offcanvasDiv')[0];

function openSideTask(event){
    let taskId = event.target.parentElement.id;
    let projectId = getProjectIdFromUrl();
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



