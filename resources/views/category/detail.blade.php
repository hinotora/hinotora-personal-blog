@extends('_base')

@section('title') {{ $category_meta->name }} @endsection

@section('header-title') {{ $category_meta->name }} @endsection
@section('header-desc') All {{ $category_meta->name }} articles @endsection
@section('header-image') {{ $category_meta->preview }} @endsection

@section('content')
    @forelse($articles as $item)
        @include('blocks.article_block', $item)
    @empty
        @include('blocks.empty')
    @endforelse


    {{ $articles->links('blocks.paginator') }}

@endsection

