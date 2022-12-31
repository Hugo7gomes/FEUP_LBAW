@if(!is_null($user))
    @extends('layouts.app')
    @section('About')
    @section('content')

    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
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
    @endsection
@else
<!DOCTYPE html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> 
        <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href = "{{route('/')}}"><img src="{{ URL::to('/images/LBAWlogo.png') }}" class= "logo"></a>
            <div id="headerInfo">
                <div id="faqs"><a href="{{ route('faq') }}">FAQ</a></div>
                <div id="contacts"><a href="{{ route('contacts') }}">Contacts</a></div>
            </div>
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
    </body>
@endif
