@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
                <h2>Hey! {{ Auth::check() ? Auth::user()->name : "Guest" }}.</h2>
                <h2>Welcome to Department of Computer Science - ACERC</h2>
                <p>This Project is Under Development
                    <a class="btn btn-primary btn-sm"a target="_blank" href="https://github.com/kinnngg-lenz/csacerc" role="button">View Source</a>
                </p>
            </div>
        </div>

        <div class="well">
            {!!  Markdown::string("# ACERC CS Dept Website (Under Construction)

This website is being developed as an unofficial website for CS Dept of ACERC.

## Features List:
* [x] Image Gallery
* [x] Upcoming Events
* [x] News & Happening of College
* [ ] Technology News
* [x] Alumini
* [ ] Quote of the Day
* [ ] _Brain Teasers_
* [ ] Computer Tricks
* [ ] _Joke of the Day_
* [ ] Newsletter Subscription
* [ ] _Discuss Area_
* [x] Signup & Login
* [x] Question anyone , anything anonymously (We respect your privacy).
* [ ] Online Notes for all Subjects , Semesters with downloadable pdf version.


## Packages Required:
* Laravel Framework
* laravelcollective/html
* guzzlehttp/guzzle
* Intervension Image
* Image Gallery
* RSS
* NewsLetter
* Admin Panel
* Weather API
* News API
* Discuss Forum
* mccool/laravel-auto-presenter
* spatie/laravel-newsletter
* doctrine/dbal

## Contributing

Thank you for considering contributing to the project! The contribution can be make by forking the repo.

## Security Vulnerabilities

If you discover a security vulnerability within this Repo, please send an e-mail to Zishan Ansari at zishanansari1337@gmail.com. All security vulnerabilities will be promptly addressed.

### License

This project is a open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
") !!}
        </div>
    </div>
</div>
@endsection
