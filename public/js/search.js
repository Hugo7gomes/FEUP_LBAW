const searchUl = document.getElementsByClassName('searchDrop')[0]

let searchDivProjects = document.getElementById("divResultProjects");
let searchDivUsers = document.getElementById("divResultUsers");
let searchDivTasks = document.getElementById("divResultTasks");
let h2Tasks = document.getElementsByClassName('tasksFromProjectH2')[0];

let searchBar = document.getElementById("searchbar")
searchBar.addEventListener('keyup', searchRequest);
let isProject = false;
function searchRequest(event) {

    let search = searchBar.value.trim()
    if (search != '') {
        searchUl.classList.remove('hide');
        searchUl.classList.add('show');
    } else {
        searchUl.classList.remove('show');
        searchUl.classList.add('hide');
    }

    let url = window.location.href;
    if(url.indexOf('project') > -1){
        if(url.indexOf('create') > -1){
            sendAjaxRequest('post', '/api/search', { search: search }, searchHandler);
        }else{
            isProject = true;
            let projectId = url.split('/')[4];
            if(projectId.indexOf('?') > -1){
                projectId = projectId.split('?')[0];
            }
            sendAjaxRequest('post', '/api/search', { projectId: projectId, search: search }, searchHandler);
        }
    }else{
        sendAjaxRequest('post', '/api/search', { search: search }, searchHandler);
    }

}

function searchHandler() {
    searchDivProjects.innerHTML = '';
    searchDivUsers.innerHTML = '';
    searchDivTasks.innerHTML = '';
    let response = JSON.parse(this.responseText);
    let projects = response['projects'];
    let users = response['users'];
    let tasks = response['tasks'];

    if (projects.length > 0) {
        for (let i = 0; i < projects.length; i++) {
            projectInject(projects[i]);
        }
    }else {
        injectNotFound('Projects');
    }

    if (users.length > 0) {
        for (let i = 0; i < users.length; i++) {
            userInject(users[i]);
        }
    } else {
        injectNotFound('Users');
    }

    if(isProject){
        
        if (tasks.length > 0) {
            for (let i = 0; i < tasks.length; i++) {
                taskInject(tasks[i]);
            }
        }else {
            injectNotFound('Tasks');
        }
    }else{
        let h2Tasks = document.getElementsByClassName('tasksFromProjectH2')[0];
        if(h2Tasks !== undefined){
            h2Tasks.remove();
        }
        
    }
  
}

function injectNotFound(s) {
    let article = document.createElement('article');
    article.innerHTML = `
    <h3>${s} not found</h3>`
    if (s == 'Projects') {
        searchDivProjects.append(article);
    } else if (s == 'Tasks') {
        searchDivTasks.append(article);
    } else if (s == 'Users') {
        searchDivUsers.append(article);
    }
}

function taskInject(task) {
    let a = document.createElement('a');
    a.href = "/task/" + task.name
    a.innerHTML = `
    <article><h3>${task.name}</h3></article>`
    searchDivTasks.append(a);
}



function userInject(user) {
    let a = document.createElement('a');
    a.href = "/profile/" + user.username
    a.innerHTML = `
    <article><h3>${user.username}</h3></article>`
    searchDivUsers.append(a);
}

function projectInject(project) {
    let a = document.createElement('a');
    a.href = "/project/" + project.id
    a.innerHTML = `
    <article><h3>${project.name}</h3></article>`
    searchDivProjects.append(a);
}
