@extends('layouts.app')

@section('content')

<h1>Selling Your Home?</h1>

<hr>

<div class="row">
    <div class="col-md-6">
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
        <form enctype="multipart/form-data" method="POST" action="/public/flyers">
            @include('flyers.form')
        </form>
    </div>
</div>

@stop