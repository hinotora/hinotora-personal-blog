@extends('_base')

@section('title') All articles @endsection

@section('header-title') All Articles @endsection
@section('header-desc') List of all articles @endsection
@section('header-image') {{ config('blog.preview.article') }} @endsection

@section('content')

    @foreach($articles as $item)
        @include('blocks.article_block', $item)
    @endforeach

    {{ $articles->links('blocks.paginator') }}

@endsection

