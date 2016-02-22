@extends('layouts.email')
@section('content')
    <div class="container">
        <p>
            Your password reset link is: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
        </p>

        <div class="col-md-12 text-center">
        <a class="btn btn-lg btn-primary" href="{{ $link }}">Reset your Password</a>
        </div>
    </div>
@endsection