const taskButtons = document.getElementsByClassName('taskLink');
var taskId;
var projectId;
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
    sendAjaxRequest('post', '../api/project/'+projectId+'/task/'+taskId+'/addComment', {task_id: taskId, comment:comment}, addCommentHandler);
}

function addCommentHandler(){
    var divComments = document.getElementById('divComments');
    if(divComments == null){
        var sectionComments = document.getElementById('sectionComments');
        sectionComments.innerHTML = `
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="card text-dark" id = "divComments">
                        <h4 class="mb-0">Comments</h4>
                    </div>
                </div>
            </div>
        </div>`
        divComments = document.getElementById('divComments');
    }
    let divNewComment = document.createElement('div');
    divNewComment.classList = "card-body p-4"
    divNewComment.innerHTML = JSON.parse(this.responseText);
    divComments.append(divNewComment);
}



