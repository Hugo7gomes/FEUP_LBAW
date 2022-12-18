let favoriteButton = document.getElementsByClassName('favoriteButton')[0];
favoriteButton.addEventListener('click',sendProjectFavoriteRequest);

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
  

