@extends('layouts.app')

@section('adhead')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endsection

@section('body')
    <div class="flex justify-center">
        <div class="w-8/12 p-6 rounded-lg bg-white">
        <h2 class="text-xl pb-4">Bejegyzés szerkesztése</h2>
        <form action="{{ route('edit', $post->id) }}" method="post">
            @csrf
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
            <div class="mb-4">
                <input type="text" name="title" id="title" value="{{ $post->title }}" placeholder="Figyelemfelkeltő cím" class="w-full p-4 mb-4 border-2 border-grey-700">
                    <select id="tags" name="tags[]" data-placeholder="Select an option" multiple="multiple" class="w-full p-4 border-2 border-grey-700">
                        <option value="DEVLOG">DEVLOG</option>
                        <option value="PHP">PHP</option>
                        <option value="LARAVEL">LARAVEL</option>
                        @if ( count($itags) )
                        @foreach ($itags as $option_tag)
                        <option value="{{ $option_tag }}">{{ $option_tag }}</option>
                        @endforeach
                        @endif
                    </select>
            </div>
            <p>
                Tagek: {{ $post->tags }}. Ha meg akarod tartani ezeket a tageket, válaszd ki őket ismét!
            </p>
            
            <textarea name="body" id="body" cols="30" rows="10" placeholder="Hosszas tartalom" class="w-full p-4 border-2 border-grey-700">{{ $post->body }}</textarea>
            <input  type="submit" value="Hozzáadás" class="p-2 border-2 border-blue-500">
        </form>
        </div>
    </div>
    <script>
        $(document).ready(
            function () {
                $('#tags').select2({tags: true});
            }
        );
    </script>
@endsection