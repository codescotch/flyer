@extends('layouts.app')

@section('content')

<h1>Selling Your Home?</h1>

<hr>

<!-- always set enctype for file uploads -->
<form enctype="multipart/form-data" method="POST" action="/flyers">
    @include('flyers.form')
</form>

@stop