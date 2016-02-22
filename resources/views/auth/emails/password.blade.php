@extends('layouts.email')
@section('styles')
    <style>
        p
        {
            word-break: break-all;
            word-break: break-word;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <p class="word-wrap">
            Your password reset link is: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
        </p>

        <div class="col-md-12 text-center">
        <a class="btn btn-lg btn-primary" href="{{ $link }}">Reset your Password</a>
        </div>
    </div>
@endsection