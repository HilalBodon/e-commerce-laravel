@extends('layout')
@section('title','registration')
@section('content')

<div>
    <input type="email" id="login" placeholder="email"><br>
    <input type="password" id="password" placeholder="password"><br>
    <input type="password" id="verify-password" placeholder="Verify password"><br>
    <input type="text" id="full-name" placeholder="Full Name"><br>
    <input type="text" id="full-name" placeholder="Phone Number"><br>
    <button type="submit">login</button>
</div>


    @endsection