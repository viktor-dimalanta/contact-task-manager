@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <!-- Add other profile information here -->
    </div>
@endsection
