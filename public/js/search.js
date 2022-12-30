const searchUl = document.getElementsByClassName('searchDrop')[0]

let searchDivProjects = document.getElementById("divResultProjects");
let searchDivUsers = document.getElementById("divResultUsers");
let searchDivTasks = document.getElementById("divResultTasks");

let searchBar = document.getElementById("searchbar")
searchBar.addEventListener('keyup', searchRequest);

function searchRequest(event){
    let search = searchBar.value.trim()
    sendAjaxRequest('post', '/api/search', {search:search} , searchHandler);
}

function searchHandler(){
    searchDivProjects.innerHTML = '';
    searchDivUsers.innerHTML = '';
    let response = JSON.parse(this.responseText);
    let projects = response['projects'];
    let users = response['users'];
    let tasks = response['tasks'];

    if((projects.length > 0) || (users.length > 0)){
        searchUl.classList.add('show');
    }else{
        searchUl.classList.remove('show');
    }

    if(projects.length > 0){
        for(let i = 0; i < projects.length; i++){
            projectInject(projects[i]);
        }
    }

    if(users.length > 0){
        for(let i = 0; i < users.length; i++){
            userInject(users[i]);
        }
    }

    if(tasks.length > 0){
        for(let i = 0; i < tasks.length; i++){
            taskInject(tasks[i]);
        }
    }
    
    
}

function taskInject(task){
    let a = document.createElement('a');
    a.href = "/task/" + task.name
    a.innerHTML = `
    <article><h3>${task.name}</h3></article>`
    searchDivTasks.append(a);
}



function userInject(user){
    let a = document.createElement('a');
    a.href = "/profile/" + user.username
    a.innerHTML = `
    <article><h3>${user.username}</h3></article>`
    searchDivUsers.append(a);
}

function projectInject(project){
    let a = document.createElement('a');
    a.href = "/project/" + project.id
    a.innerHTML = `
    <article><h3>${project.name}</h3></article>`
    searchDivProjects.append(a);
}
