let favoriteButton = document.getElementsByClassName('favoriteButton')[0];
function addEventListeners() {
  favoriteButton.addEventListener('click',sendProjectFavoriteRequest);

  let deleteNotButtons = document.querySelectorAll('.deleteNot');
  [].forEach.call(deleteNotButtons, function(deleteButton) {
    deleteButton.addEventListener('click', sendNotDeleteRequest);
  });
}

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

function sendNotDeleteRequest(){
  sendAjaxRequest('post', 'api/notification/delete', {id:id} , removeNotificationHandler);
}

function removeNotificationHandler(){
  let notification = JSON.parse(this.responseText);
  alert(notification);
  //let divNotification = document.getElementById(notification.id);
  //divNotification.remove();
}


function sendProjectFavoriteRequest() {
  let url = window.location.href;
  let id = url.substring(url.lastIndexOf('/') + 1);
  if(favoriteButton.innerText == 'FAVORITE'){
    favoriteButton.innerText = 'REMOVE FAVORITE';
    sendAjaxRequest('post', '/api/project/favorite/create', {id:id} , projectFavoriteHandler);
  }else if(favoriteButton.innerText == 'REMOVE FAVORITE'){
    favoriteButton.innerText = 'FAVORITE';
    sendAjaxRequest('post', '/api/project/favorite/delete', {id:id} , projectRemoveFavoriteHandler);
  }
}

function projectFavoriteHandler() {
}

function projectRemoveFavoriteHandler() {
}

function itemAddedHandler() {
  if (this.status != 200) window.location = '/';
  let item = JSON.parse(this.responseText);

  // Create the new item
  let new_item = createItem(item);

  // Insert the new item
  let card = document.querySelector('article.card[data-id="' + item.card_id + '"]');
  let form = card.querySelector('form.new_item');
  form.previousElementSibling.append(new_item);

  // Reset the new item form
  form.querySelector('[type=text]').value="";
}

function itemDeletedHandler() {
  if (this.status != 200) window.location = '/';
  let item = JSON.parse(this.responseText);
  let element = document.querySelector('li.item[data-id="' + item.id + '"]');
  element.remove();
}

function cardDeletedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);
  let article = document.querySelector('article.card[data-id="'+ card.id + '"]');
  article.remove();
}

function cardAddedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);

  // Create the new card
  let new_card = createCard(card);

  // Reset the new card input
  let form = document.querySelector('article.card form.new_card');
  form.querySelector('[type=text]').value="";

  // Insert the new card
  let article = form.parentElement;
  let section = article.parentElement;
  section.insertBefore(new_card, article);

  // Focus on adding an item to the new card
  new_card.querySelector('[type=text]').focus();
}

function createCard(card) {
  let new_card = document.createElement('article');
  new_card.classList.add('card');
  new_card.setAttribute('data-id', card.id);
  new_card.innerHTML = `

  <header>
    <h2><a href="cards/${card.id}">${card.name}</a></h2>
    <a href="#" class="delete">&#10761;</a>
  </header>
  <ul></ul>
  <form class="new_item">
    <input name="description" type="text">
  </form>`;

  let creator = new_card.querySelector('form.new_item');
  creator.addEventListener('submit', sendCreateItemRequest);

  let deleter = new_card.querySelector('header a.delete');
  deleter.addEventListener('click', sendDeleteCardRequest);

  return new_card;
}

function createItem(item) {
  let new_item = document.createElement('li');
  new_item.classList.add('item');
  new_item.setAttribute('data-id', item.id);
  new_item.innerHTML = `
  <label>
    <input type="checkbox"> <span>${item.description}</span><a href="#" class="delete">&#10761;</a>
  </label>
  `;

  new_item.querySelector('input').addEventListener('change', sendItemUpdateRequest);
  new_item.querySelector('a.delete').addEventListener('click', sendDeleteItemRequest);

  return new_item;
}

addEventListeners();
