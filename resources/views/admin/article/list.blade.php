@extends('admin._base')

@section('title') Articles @endsection

@section('content')
    <div class="d-flex flex-row border rounded mb-3">
        <form class="input-group w-25" action="{{ route('page-admin-article-list') }}" method="GET">
            <input type="text" name="q" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        <div class="ml-auto">
            <a class="btn btn-success btn-new-article" href="#">Create new article</a>
        </div>
    </div>
    <div class="dropdown-divider mb-3"></div>
    @foreach($articles as $item)
        <div class="d-flex border rounded mb-3">
            <div class="article-img mr-3">
                <img class="rounded-left" src="{{ $item->preview }}" alt="{{ $item->preview }}">
            </div>
            <div class="flex-fill mr-3">
                <h5 class="card-title">
                    <span class="badge badge-primary">Views: {{ $item->views }}</span>
                    @if($item->published)
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-danger">Not Published</span>
                    @endif
                    {{ $item->title }}
                </h5>
                <p class="card-text text-wrap">{{ $item->description }}</p>
                <p class="card-text">Category: <span class="badge badge-secondary">{{ $item->category->name }}</span></p>
                <p class="card-text">Created at: <span class="badge badge-secondary">{{ $item->created_at }}</span></p>
                <p class="card-text">Author: <span class="badge badge-secondary">{{ $item->user->name }}</span></p>
            </div>
            <div class="d-flex flex-column p-2">
                <a class="btn btn-info mb-1" href="#">Preview</a>
                <a class="btn btn-primary mb-1" href="#">Update</a>
                <button class="btn btn-danger mt-auto" data-toggle="article-delete" data-value="{{ $item->ID }}">Delete</button>
            </div>
        </div>
    @endforeach

    {{ $articles->links('blocks.paginator') }}
@endsection
