
const searchDiv = document.getElementById('searchDiv')

let searchBar = document.getElementById("searchbar")
searchBar.addEventListener('keyup', searchRequest);

/* function */
function searchRequest(event){
    searchDiv.innerHTML = "";
    let search = searchBar.value.trim()
    sendAjaxRequest('post', '/api/search', {search:search} , searchHandler);
}

function searchHandler(){
    projects = JSON.parse(this.responseText)['projects'];
    console.log(projects);
    for(let i = 0; i < projects.length; i++){
        projectInject(projects[i]);
    }

    
    
}

function projectInject(project){
    let article = document.createElement('article');
    article.innerHTML = `
    <a href = "project/${project.id}">${project.name}</a>`
    searchDiv.append(article);
}
