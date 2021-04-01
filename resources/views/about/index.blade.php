@extends('_base')

@section('title') About me @endsection

@section('header-title') About me @endsection
@section('header-desc') Private (Actually no) information about me @endsection
@section('header-image') {{ config('blog.preview.about') }} @endsection

@section('content')
    <h3 class="font-weight-normal mb-3">About Page</h3>
@endsection
