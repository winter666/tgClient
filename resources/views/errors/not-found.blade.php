@extends('landing.index')

@section('css-links')
    <style>
        .page-not-found {
            height: 80vh;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    @include('landing.parts.nav')
    <div class="page-not-found">
        <h1>Page not found or unavailable</h1>
    </div>
@endsection
