@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style>
    body {
        background-image: url("{{ asset('img/logo.png') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
    }

    .overlay {
        background-color: rgba(0, 0, 0, 0.7);
        min-height: 80vh;
        border-radius: 10px;
        padding: 30px;
    }
</style>


    </div>

</div>

@endsection