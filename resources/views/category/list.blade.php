@extends('_base')

@section('title') All categories @endsection

@section('header-title') All categories @endsection
@section('header-desc')  @endsection
@section('header-image') {{ config('blog.section.category') }} @endsection

@section('content')
    <h3 class="font-weight-normal mb-3">All categories</h3>
    <div class="mb-5">
        @forelse($categories as $item)
            <a class="text-decoration-none category-container" href="{{ route('page-category-detail', $item->slug) }}">
                <div class="bg-image p-2 text-center shadow-1-strong rounded mb-2 text-white" style="background-image: url('{{ $item->preview }}');">
                    <h3 class="mb-3 mt-1 h3">{{ $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                </div>
            </a>
        @empty
            @include('blocks.empty')
        @endforelse
    </div>
@endsection

