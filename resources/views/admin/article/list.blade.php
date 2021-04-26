@extends('admin._base')

@section('title') Articles @endsection

@section('content')
    <div class="d-flex flex-row mb-3">
        <form class="input-group w-25" action="{{ route('page-admin-article-list') }}" method="GET">
            <input type="text" name="q" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        <div class="ml-auto">
            <a class="btn btn-success btn-new-article" href="{{ route('page-admin-article-new') }}">Create new article</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endisset

    @if(session('fail'))
        <div class="alert alert-danger" role="alert">
            {{ session('fail') }}
        </div>
    @endisset

    <div class="dropdown-divider mb-3"></div>
    @forelse($articles as $item)
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
                <a class="btn btn-info mb-1" target="_blank" href="{{ route('page-article-detail', $item->slug) }}">Preview</a>
                <a class="btn btn-primary mb-1" href="{{ route('page-admin-article-update', $item->ID) }}">Update</a>
                <button class="btn btn-danger mt-auto article-delete" data-value="{{ $item->ID }}" data-toggle="modal" data-target="#delete-modal">Delete</button>
            </div>
        </div>
    @empty
        @include('blocks.empty')
    @endforelse

    <!-- Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="Confirm delete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this article?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Actually, no</button>
                    <a class="btn btn-danger delete-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    {{ $articles->links('blocks.paginator') }}
@endsection
@section('javascripts')
    <script>
        $(document).ready(function () {
            $('.article-delete').click(function () {
                let article_id = $(this).attr('data-value');
                let link = "/admin/articles/delete/"+article_id;

                $('.delete-confirm').attr("href", link);
            });
        });
    </script>
@endsection
