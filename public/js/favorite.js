let favoriteButton = document.getElementsByClassName('favoriteButton')[0];
favoriteButton.addEventListener('click', sendProjectFavoriteRequest);
const ulFavoriteProjects = document.getElementsByClassName('favoriteProjects')[0];

let url = window.location.href;
let projectIdBoard = url.substring(url.lastIndexOf('/') + 1);
if(projectIdBoard.indexOf('?') > -1){
  projectIdBoard = projectIdBoard.split('?')[0];
}

function sendProjectFavoriteRequest() {

  let id = projectIdBoard;
  if (favoriteButton.innerText == 'FAVORITE') {
    sendAjaxRequest('post', '../api/project/'+id+'/favorite/create', {}, projectFavoriteHandler);
  } else if (favoriteButton.innerText == 'REMOVE FAVORITE') {
    sendAjaxRequest('post', '../api/project/'+id+'/favorite/delete', {}, projectRemoveFavoriteHandler);
  }
}

function projectFavoriteHandler() {
  let project = JSON.parse(this.responseText);
  if(project !== null){
    console.log(project);
    let url = window.location.href;
    let projectId = projectIdBoard;
    let li = document.createElement('li');
    li.id = 'proj' + projectId;
    li.innerHTML = `
      <a href="../project/${project.id}" class="nav-link link-dark rounded font-weight-bold">
        ${project.name}
      </a>`
    ulFavoriteProjects.append(li);
    favoriteButton.innerText = 'REMOVE FAVORITE';
    favoriteButton.classList = "btn btn-outline-danger favoriteButton Button"
  }

}

function projectRemoveFavoriteHandler() {
  let url = window.location.href;
  let projectId =projectIdBoard;
  let liProj = document.getElementById('proj' + projectId);
  liProj.remove();
  favoriteButton.innerText = 'FAVORITE';
  favoriteButton.classList = "btn btn-outline-dark favoriteButton Button"
}


