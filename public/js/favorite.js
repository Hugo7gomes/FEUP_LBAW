let favoriteButton = document.getElementsByClassName('favoriteButton')[0];
favoriteButton.addEventListener('click',sendProjectFavoriteRequest);

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}
  
function sendAjaxRequest(method, url, data, handler) {
let request = new XMLHttpRequest();

request.open(method, url, true);
request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
request.addEventListener('load', handler);
request.send(encodeForAjax(data));
}

function sendProjectFavoriteRequest() {
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf('/') + 1);
    if(favoriteButton.innerText == 'FAVORITE'){
      sendAjaxRequest('post', '/api/project/favorite/create', {id:id} , projectFavoriteHandler);
    }else if(favoriteButton.innerText == 'REMOVE FAVORITE'){
      sendAjaxRequest('post', '/api/project/favorite/delete', {id:id} , projectRemoveFavoriteHandler);
    }
  }
  
  function projectFavoriteHandler() {
    favoriteButton.innerText = 'REMOVE FAVORITE';
    favoriteButton.classList = "btn btn-outline-danger favoriteButton Button"
  }
  
  function projectRemoveFavoriteHandler() {
    favoriteButton.innerText = 'FAVORITE';
    favoriteButton.classList = "btn btn-outline-dark favoriteButton Button"
  }
  

