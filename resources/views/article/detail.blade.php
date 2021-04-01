@extends('_base')

@section('title') {{ $article->title }} @endsection

@section('header-title') {{ $article->title }} @endsection
@section('header-desc') {{ $article->description }} @endsection
@section('header-image') {{ $article->preview }} @endsection

@section('content')
    <article>
        <h2 class="font-weight-normal mb-5">{{ $article->title }}</h2>

        {!! html_entity_decode($article->content) !!}


    </article>
@endsection
