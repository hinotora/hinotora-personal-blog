@extends('admin._base')

@section('title') Articles @endsection

@section('content')

    <form action="{{ route('action-admin-article-new') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex">
            <div class="flex-fill">
                <h3 class="font-weight-normal mb-3">New article</h3>
            </div>
            <div class="flex-fill text-right">
                <button type="submit" name="mode" value="0" class="btn btn-info mr-1">Save as draft</button>
                <button type="submit" name="mode" value="1" class="btn btn-success">Save and publish</button>
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

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
            </div>
            <input type="text" name="title" class="form-control" placeholder="This is best article in the world" maxlength="150">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Category</span>
            </div>
            <select class="custom-select" name="category">
                @foreach($categories as $category)
                    <option value="{{ $category->ID }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="3" maxlength="250" placeholder="Description" name="description"></textarea>
        </div>

        <div class="custom-file">
            <label class="custom-file-label" for="preview">Choose preview image</label>
            <input type="file" name="preview" class="custom-file-input" id="preview">
        </div>

        <div class="my-3 preview_image mx-auto">
            <img id="preview_image" src="https://place-hold.it/700x200" alt="preview image">
        </div>

        <div class="form-group mt-2">
            <label for="wysiwyg"> Article body </label>
            <textarea name="body" id="wysiwyg" rows="10"></textarea>
        </div>
    </form>

@endsection

@section('javascripts')
    <script>
        $(document).ready(function() {
            $('textarea#wysiwyg').summernote({
                height: '500px'
            });
        });
    </script>
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
