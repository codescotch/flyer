@extends('layouts.app')

@section('content')

<h1>Selling Your Home?</h1>

<hr>

{{-- note: also have html5 validation in place so this won't trigger for most fields --}}
@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- always set enctype for file uploads -->
<form method="POST" action="{{ url('/flyers/post') }}" enctype="multipart/form-data">
    @include('flyers.form')
</form>

@stop