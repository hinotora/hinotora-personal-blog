@extends('admin._base')

@section('title') Categories @endsection

@section('content')
    <div class="d-flex flex-row">
        <div class="flex-fill">
            <h3 class="font-weight-normal mb-3">Category list</h3>
        </div>
        <div class="ml-auto">
            <a class="btn btn-success btn-new-article" href="{{ route('page-admin-category-new') }}">Create new category</a>
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
        <div class="d-flex border rounded mb-3">
            <div class="article-img mr-3">
                <img class="rounded-left" src="{{ $item->preview }}" alt="{{ $item->preview }}">
            </div>
            <div class="flex-fill mr-3">
                <h5 class="card-title">
                    {{ $item->name }}
                </h5>
                <p class="card-text text-wrap">{{ $item->description }}</p>
            </div>
            <div class="d-flex flex-column p-2">
                <a class="btn btn-primary mb-1" href="{{ route('page-admin-category-update', $item->ID) }}">Update</a>
                <button class="btn btn-danger mt-auto category-delete" data-value="{{ $item->ID }}" data-toggle="modal" data-target="#delete-modal">Delete</button>
            </div>
        </div>
    @endforeach

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
                    Are you sure want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Actually, no</button>
                    <a class="btn btn-danger delete-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        $(document).ready(function () {
            $('.category-delete').click(function () {
                let category_id = $(this).attr('data-value');
                let link = "{{ route('action-admin-category-delete') }}/"+category_id;

                $('.delete-confirm').attr("href", link);
            });
        });
    </script>
@endsection
