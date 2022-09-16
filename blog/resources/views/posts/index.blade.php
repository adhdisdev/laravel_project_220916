@extends('layouts.app')

@section('body')
<h1 class="text-lg p-4">Bejegyzések</h1>
<hr>
<div class="lg:w-8/12 md:w-6/12 sm:w-10/12 mx-auto p-4 m-2 rounded-lg bg-white">
    <h3>Szűrő</h3>
    <form action="{{ route('home') }}" method="get">
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
                    {{-- <label><input type="checkbox" name="matchall" id="matchall">Teljes egyezés</label> --}}
                    <br>
                    <input class="p-2 m-2 border-2 border-blue-500 rounded-lg" type="submit" value="Keresés">
    </form>
</div>
    @if( $posts->count() )
    @foreach ($posts as $post)
    <div class="lg:w-8/12 md:w-6/12 sm:w-10/12 mx-auto p-4 m-2 rounded-lg bg-white">
        <a href="{{ route('show', $post->id) }}">{{$post->title}}</a>
        <form action="{{ route('destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Törlés">
        </form>
    </div>
    @endforeach
    @else
    <div class="lg:w-8/12 md:w-6/12 sm:w-10/12 mx-auto p-6 rounded-lg bg-white">
        Nincsenek bejegyzések.
    </div>
    @endif

    <div class="mx-auto w-8/12">
        {{ $posts->links() }}
    </div>
    <script>
        $(document).ready(
            function () {
                $('#tags').select2({tags: true});
            }
        );
    </script>
@endsection