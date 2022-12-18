let board = document.getElementById('boardProjectButton');
let edit  = document.getElementById('editProjectButton');
let teamMembers = document.getElementById('teamMembersProjectButton');
if (window.location.href.indexOf("members") > -1) {
    teamMembers.classList = 'nav-link active'
}else if(window.location.href.indexOf("edit") > -1){
    edit.classList = 'nav-link active'
}else{
    board.classList = 'nav-link active'
}