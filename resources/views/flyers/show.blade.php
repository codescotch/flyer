@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>{!! $flyer->street !!}</h1>
            <h2>{{ $flyer->price }}</h2>


            <hr>

            <div class="description">
                {{-- output line breaks --}}
                {{-- ***NOTE: curly braces escapes output, the one below does not and should be used with html chars (can't even write it in the comment ha!) --}}
                {!! nl2br($flyer->description) !!}
            </div>
        </div>
        <div class="col-md-8 gallery">
            {{-- chunk is a cool trick for eloquent results --}}
            {{-- gives you an array of items, where each array contains 4 photos --}}
            @foreach($flyer->photos->chunk(4) as $set)
                {{-- everything resets within a row div (i.e. divisble by 12) --}}
                <div class="row">
                    @foreach($set as $photo)
                        {{-- if you want 4 on a page, 12 / 4 = col-md-3 --}}
                        <div class="col-md-3 gallery__image">

                            {{-- this is the standard way to do deletes --}}
                            {{--<form method="POST" action="/photos/{{ $photo->id }}" class="">--}}
                                {{--{!! csrf_field() !!}--}}
                                {{--<input type="hidden" name="_method" value="DELETE">--}}
                                {{--<button type="submit">X</button>--}}
                            {{--</form>--}}

                            {{-- simple helper function (app/helpers.php) so we don't have to write a form every time --}}
                            {{-- can use this for any model or method (e.g. users) --}}
                            {{-- 2nd arg would be $photo object, except we overrode the name conveation (flyer_photos) --}}
                            {{-- the laravel html helpers package has link_to (would need diff name) --}}
                            {!! link_to('Delete', "/photos/{$photo->id}", 'DELETE') !!}

                            {{-- added data attrible for lightbox --}}
                            {{-- PhotoSwipe is a nice full featured plugin if you need more features...but really, just research! --}}
                            <a href="/{{ $photo->path }}" data-lity>
                                <img src="/{{ $photo->thumbnail_path }}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{-- doing it this way so we can reuse the code to compare user to ANY model (not just flyers) --}}
            {{-- $user is available since created ComposerServiceProvider --}}
            @if($user && $user->owns($flyer))
                <hr>
                {{-- when you upload a photo it immediately makes a post request to the action (doesn't wait for a submit) --}}
                <form id="addPhotosForm"
                      {{-- could make this even simpler by creating a helper function e.g. add_photo_path($flyer) --}}
                      action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}"
                      method="POST"
                      class="dropzone">
                    {!! csrf_field() !!}
                </form>
                {{-- form before using named route --}}
                {{--<form id="addPhotosForm" action="/{{ $flyer->zip }}/{{ $flyer->street }}/photos" method="POST" class="dropzone">--}}
            @endif

        </div>
    </div>

@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script>
        {{-- references form id --}}
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp'
        };
    </script>
@stop