@extends('_base')

@section('title') {{ $category_meta->name }} @endsection

@section('header-title') {{ $category_meta->name }} @endsection
@section('header-desc') All {{ $category_meta->name }} articles @endsection
@section('header-image') {{ $category_meta->preview }} @endsection

@section('content')
    @if($articles->count() > 1)
        @foreach($articles as $item)
            @include('blocks.article_block', $item)
        @endforeach
    @else
        <h2 class="font-weight-normal mt-5 text-center">Not found any articles</h2>
    @endif

    {{ $articles->links('blocks.paginator') }}

@endsection

