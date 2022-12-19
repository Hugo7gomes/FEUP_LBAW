@extends('layouts.app')

@section('content')
<main>
    <div class="container mb-5">
        <div class="row my-4">
            <div class="input-group">
            <input id="search" name="query" type="text" class="form-control" placeholder="Search" id = "searchbar"
                    aria-label="search" aria-describedby="button-search">
            <button class="btn btn-outline-secondary" type="button" id="button-search-projects"><i
                class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="accordion" id="accordionSearch">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                    Projects
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                    <div class="accordion-body" id="projectsSearch"></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection