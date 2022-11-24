const projectsDiv = document.getElementById('projectsSearch')
const tasksDiv = document.getElementById('tasksSearch')
const tasksTitleSearch = document.getElementById('tasksTitleSearch')
const projectsTitleSearch = document.getElementById('projectsTitleSearch')

let searchBar = document.getElementById("searchbar")
searchBar.addEventListener('keyup', searchRequest);

/* function */
function searchRequest(event){
    projectsDiv.innerHTML = ""
    tasksDiv.innerHTML = ""
    let search = searchBar.value.trim()
    sendAjaxRequest('post', '/api/search', {search:search} , searchHandler);
}

function searchHandler(){
    let result = JSON.parse(this.responseText);
    let projects = result.projects
    let tasks = result.tasks
    if(searchBar.value == ""){
        projectsTitleSearch.style.display = "none";
        tasksTitleSearch.style.display = "none";
    }else{
        projectsTitleSearch.style.display = "block";
        tasksTitleSearch.style.display = "block";
    }
    if((projects.length)>0){
        addProjects(projects)
    }
    if((tasks.length)>0){
        addTasks(tasks);
    }
  
    
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
        <a href="project/${project.id}"><span>${project.name}</span></a>
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