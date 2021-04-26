@extends('_base')

@section('title') All articles @endsection

@section('header-title') All Articles @endsection
@section('header-desc') List of all articles @endsection
@section('header-image') {{ config('blog.preview') }} @endsection

@section('content')

    @forelse($articles as $item)
        @include('blocks.article_block', $item)
    @empty
        @include('blocks.empty')
    @endforelse

    {{ $articles->links('blocks.paginator') }}

@endsection

