var div = document.getElementById('createTask')
var button = document.getElementsByClassName('addTask')[0]

button.addEventListener('click',openTaskCreate)

function openTaskCreate(event){
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }

}
