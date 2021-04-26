@extends('_base')

@section('title') Main page @endsection

@section('header-title') Hinotora Developer Blog @endsection
@section('header-desc') Nothing personal, just a blog @endsection
@section('header-image') {{ config('blog.preview') }} @endsection

@section('content')

    <h3 class="font-weight-normal mb-3">Recent articles</h3>

    @foreach($articles as $item)
        @include('blocks.article_block', $item)
    @endforeach
@endsection
