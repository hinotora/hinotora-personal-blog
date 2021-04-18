@extends('_base')

@section('title') {{ $article->title }} @endsection

@section('header-title') {{ $article->title }} @endsection
@section('header-desc') {{ $article->description }} @endsection
@section('header-image') {{ $article->preview }} @endsection

@section('content')
    <article class="article">
        {!! html_entity_decode($article->content) !!}
    </article>
@endsection
