@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
                <h2>Hey! {{ Auth::check() ? Auth::user()->name : "Guest" }}.</h2>
                <h2>Welcome to Department of Computer Science - ACERC</h2>
                <p>This Project is Under Development
                    <a class="btn btn-primary btn-sm" target="_blank" href="https://github.com/kinnngg-lenz/csacerc" role="button">View Source</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
