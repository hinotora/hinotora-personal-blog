@extends('admin._base')

@section('title') Articles @endsection

@section('content')
    <div class="d-flex flex-row">
        <div class="ml-auto">
            <a class="btn btn-success btn-new-article" href="#">Create new category</a>
        </div>
    </div>

    @if(session('success'))
        <div class="dropdown-divider mb-3"></div>
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endisset

    @if(session('fail'))
        <div class="dropdown-divider mb-3"></div>
        <div class="alert alert-danger" role="alert">
            {{ session('fail') }}
        </div>
    @endisset

    <div class="dropdown-divider mb-3"></div>
    @foreach($categories as $item)

    @endforeach
@endsection
@section('javascripts')

@endsection
