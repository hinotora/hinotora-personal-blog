@extends('admin._base')

@section('title') Articles @endsection

@section('content')
    <form action="{{ route('action-admin-category-update', $category->ID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex">
            <div class="flex-fill">
                <h3 class="font-weight-normal mb-3">{{ $category->name }}</h3>
            </div>
            <div class="flex-fill text-right">
                <button type="submit" class="btn btn-info mr-1">Save</button>
            </div>
        </div>

        <div class="dropdown-divider mt-2 mb-3"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="my-3 preview_image mx-auto">
            <img id="preview_image" src="{{ $category->preview }}" alt="preview image">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
            </div>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="Name" maxlength="50">
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="3" maxlength="100" placeholder="Description" name="description">{{ $category->description }}</textarea>
        </div>

        <div class="custom-file">
            <label class="custom-file-label" for="preview">Update preview image</label>
            <input type="file" name="preview" class="custom-file-input" id="preview">
        </div>
    </form>

@endsection

@section('javascripts')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview").change(function () {
            readURL(this);
        });
    </script>
@endsection
