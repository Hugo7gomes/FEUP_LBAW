@auth
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title> About </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <header>
      @include('partials.header')
      @yield('header')
    </header>
    <main>
        <h1>About Workfluido</h1>
        <p>In a world where teamwork has become crucial to combat the constant adversities that have arisen such as remote work, the need for a project management tool has emerged. So, we decided to create Workfluido.</p>
        <p>Workfluido is a web application to help teams plan and manage their projects in a simple and efficient way. Our goal is to make project management less of a chore for teams of all sizes and industries. With Workfluido, users can easily organize their workflow by forming teams, assigning tasks, and discussing topics with their team members.</p>
        <p>Our user-friendly interface and robust features make Workfluido the perfect tool for teams looking to streamline their project management process. Some of our key features include:</p>
        <ul>
            <li>Create Projects</li>
            <li>Manage a project team</li>
            <li>Create tasks</li>
            <li>Assign tasks to team members</li>
            <li>Comment on the tasks performed by the team</li>
        </ul>
        <p>Whether you're a small startup, a large corporation, or an individual looking to manage a team project, Workfluido has something to offer. Try it out today and see how it can help your team work more efficiently and effectively.</p>
    </main>
  <footer class="footer container" id = "footerEnd">
    @include('partials.footer')
    @yield('footer') 
  </footer>
  </body>
</html>
@endauth
@guest
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title> About </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    </head>
    <body>
        <header id = "header_about">
          <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" alt="LBAW logo" id= "logo_unauthenticated"></a>
          <div id="headerInfo">
              <div id="faqs"><a href="{{ route('faq') }}">FAQ</a></div>
              <div id="contacts"><a href="{{ route('contact') }}">Contacts</a></div>
          </div>
        </header>
        <main>
          <div class="aboutText">
            <h1>About Workfluido</h1>
            <p>In a world where teamwork has become crucial to combat the constant adversities that have arisen such as remote work, the need for a project management tool has emerged. So, we decided to create Workfluido.</p>
            <p>Workfluido is a web application to help teams plan and manage their projects in a simple and efficient way. Our goal is to make project management less of a chore for teams of all sizes and industries. With Workfluido, users can easily organize their workflow by forming teams, assigning tasks, and discussing topics with their team members.</p>
            <p>Our user-friendly interface and robust features make Workfluido the perfect tool for teams looking to streamline their project management process. Some of our key features include:</p>
            <ul>
                <li>Create Projects</li>
                <li>Manage a project team</li>
                <li>Create tasks</li>
                <li>Assign tasks to team members</li>
                <li>Comment on the tasks performed by the team</li>
            </ul>
            <p>Whether you're a small startup, a large corporation, or an individual looking to manage a team project, Workfluido has something to offer. Try it out today and see how it can help your team work more efficiently and effectively.</p>
          </div>
        </main>
    </body>
@endguest
