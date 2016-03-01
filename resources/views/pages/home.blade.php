@extends('layouts.app')

@section('content')

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Project Flyer</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            @if($loggedIn)
                <a href="{{ route('flyers.create') }}" class="btn btn-primary" role="button">Create A Flyer</a>
            @else
                <a href="{{ url('/register') }}" class="btn btn-primary" role="button">Sign Up To Create A Flyer</a>
            @endif
        </div>
    </div>

@endsection
