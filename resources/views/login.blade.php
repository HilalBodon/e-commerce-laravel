@extends('layout')
@section('title', 'login')
@section('content')

<div>
    <form id="loginForm" action="{{ route('login.post') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</div>

@php
    $jsRoutes = [
        'loginPost' => route('login.post'),
        'home' => route('home'),
    ];
@endphp

<script>
    const routes = @json($jsRoutes);
</script>
<script src="{{ asset('../js/login.js')}}"></script>

@endsection 

