const taskButtons = document.getElementsByClassName('taskLink');
let taskId;
let projectId;
[].forEach.call(taskButtons, function(btton) {
    btton.addEventListener('click', openSideTask);
});
const divOffcanvas = document.getElementsByClassName('offcanvasDiv')[0];

function openSideTask(event){
    taskId = event.target.parentElement.id;
    projectId = getProjectIdFromUrl();
    sendAjaxRequest('get', '../api/project/'+projectId+'/task/'+ taskId, {} ,showTaskHandler);
}

function closeSideTask(event){
    divOffcanvas.innerHTML = ``
    taskId = undefined;
    projectId = undefined;
}

function showTaskHandler(){ 
    divOffcanvas.innerHTML = JSON.parse(this.responseText);
    closeDivButton = document.getElementsByClassName('closeButton')[0];
    closeDivButton.addEventListener('click', closeSideTask);
    const addCommentButton = document.getElementById('commentButton');
    addCommentButton.addEventListener('click', addComment);
}

function addComment(event){
    const inputBox = document.getElementById('inputComment');
    let comment = inputBox.value;
    sendAjaxRequest('get', '../api/project/'+projectId+'/task/'+taskId+'/addComment', {comment:comment}, addCommentHandler);
}

function addCommentHandler(){
    const divComments = document.getElementById('divComments');
    if(divComments != null){
        let divNewComment = document.createElement('div');
        divNewComment.classList = "card-body p-4"
        divNewComment.innerHTML = JSON.parse(this.responseText);
        divComments.append(divNewComment);
    }
}



