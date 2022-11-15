<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
</head>
<body>
  <header>
    <div>
      <img src =  "" onclick = "window.location=''">
    </div>
    <div class="searchbar"> </div>
    <button class="fa-regular fa-bell"></button>
    <button class="fa-solid fa-user"></button>
    <!--<button class="fa-regular fa-user"</button>-->
  </header>
  <div id="profileBoard">
    <div id="userProfile">
      <h2>{{ $user['name'] }}</h2>
      <h3>{{ $user['username'] }}</h3>
    </div>
    <div id="userInfo">
      <form id="userInf">
        <h4>Name</h4>
        <input type="text" placeholder= "{{ $user['name'] }}" id="userName">
        <h4>Username</h4>
        <input type="text" placeholder= "{{ $user['username'] }}" id="userUsername">
        <h4>Email</h4>
        <input type="text" placeholder= "{{ $user['email'] }}" id="userEmail">
        <h4>Phone number</h4>
        <input type="tel" placeholder= "{{ $user['phone_number'] }}" id="userPhone">
      </form>
    </div>
    <section id="userProjects">
      <h2>My projects</h2>
      @foreach ($projects as $project)
      <h3>{{ $project['name']}}</h3>
      @endforeach
    </section>
  </div>
  
</body>
</html> 