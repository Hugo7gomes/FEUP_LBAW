const searchUl = document.getElementsByClassName('searchDrop')[0]

let searchDivProjects = document.getElementById("divResultProjects");
let searchDivUsers = document.getElementById("divResultUsers");
let searchDivTasks = document.getElementById("divResultTasks");

let searchBar = document.getElementById("searchbar")
searchBar.addEventListener('keyup', searchRequest);

function searchRequest(event) {

    let search = searchBar.value.trim()
    if (search != '') {
        searchUl.classList.add('show');
    } else {
        searchUl.classList.remove('show');
    }

    let url = window.location.href;
    let projectId = url.split('/')[4];
    sendAjaxRequest('post', '/api/search', { projectId: projectId, search: search }, searchHandler);
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

    if (tasks.length > 0) {
        for (let i = 0; i < tasks.length; i++) {
            taskInject(tasks[i]);
        }
    }else {
        injectNotFound('Tasks');
    }
}

function injectNotFound(s) {
    let article = document.createElement('article');
    article.innerHTML = `
    <span><h3>${s} not found</h3><span>`
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
