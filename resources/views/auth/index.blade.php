@extends('layouts.app')

@section('content')
<form class="form-signin" action="{{ url('login') }}" method="POST">
    {{ csrf_field() }}

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
@stop

@section('head')
<link rel="stylesheet" href="{{ url('css/signin.css') }}">
@stop
