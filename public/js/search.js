const projectsDiv = document.getElementById('projectsSearch')
const searchDiv = document.getElementById('searchDiv')

let searchBar = document.getElementById("searchbar")
searchBar.addEventListener('keyup', searchRequest);

/* function */
function searchRequest(event){
    projectsDiv.innerHTML = ""
    let search = searchBar.value.trim()
    sendAjaxRequest('get', '/api/search', {search:search} , searchHandler);
}

function searchHandler(){
    projects = this.responseText.projects;
    projectsDiv.innerHTML = projects
  
    
}

function addProjects(projects){
    
    for (var i = 0; i < projects.length; i++) {
        projectsDiv.append(createProject(projects[i]));
    }
    
}

function createProject(project){
    let projectSearch = document.createElement('div');
    projectSearch.classList.add('projectSearch');
    projectSearch.innerHTML = `
        <div class="col-lg"><a href="project/${project.id}"><span>${project.name}</span></a><div>
    `

    return projectSearch;
}

function createTask(task){
    let taskSearch = document.createElement('div');
    taskSearch.classList.add('taskSearch');
    taskSearch.innerHTML = `
        <a href="task/edit?taskId=${task.id}&projectId=${task.id_project}"><span>${task.name}</span></a>
    `

    return taskSearch;
}

function addTasks(tasks){
    for (var i = 0; i < tasks.length; i++) {
        tasksDiv.append(createTask(tasks[i]));
    }
}