@extends('layouts.app')

@section('body')
    @if( $post->count() )
    <div class="lg:w-8/12 md:w-6/12 sm:w-10/12 mx-auto p-4 m-2 rounded-lg bg-white">
        <h1 class="text-lg p-2">{{$post->title}}</h1>
        
        <p class="p-4 bg-gray-100 rounded-lg">{{$post->body}}</p>
        
        <p class="p-2">
            Tagek: {{$post->tags}}
        </p>
        <a href="{{ route('edit', $post->id)}}">Szerkesztés</a>
    </div>
    @else
    <div class="lg:w-8/12 md:w-6/12 sm:w-10/12 mx-auto p-6 rounded-lg bg-white">
        Nincsen ilyen bejegyzés.
    </div>
    @endif
@endsection