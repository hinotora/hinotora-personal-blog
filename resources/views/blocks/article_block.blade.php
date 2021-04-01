<div class="card text-center mb-5">
    <div class="card-header">
        <h5 class="card-title text-left font-weight-normal my-0">{{ $item->title }}</h5>
    </div>
    <div class="card-body">
        <p class="card-text text-left my-0">{{ $item->description }}</p>
    </div>
    <div class="img-container">
        <img src="{{ $item->preview }}" alt="Logo">
    </div>
    <div class="card-footer d-flex">
        <div class="flex-fill text-left d-flex">
            <p class="my-auto mr-3"><i class="far fa-calendar-alt mr-1"></i> {{ $item->created_at }}</p>
            <p class="my-auto mr-3"><i class="fas fa-eye mr-1"></i> {{ $item->views }}</p>
            <p class="my-auto mr-3"><i class="fas fa-user-edit mr-1"></i> {{ $item->user->name }}</p>
            <a href="{{ route('page-category-detail', $item->category->slug) }}" class="my-auto mr-3">
                <i class="fas fa-tags mr-1"></i>{{ $item->category->name }}
            </a>
        </div>
        <div class="flex-fill text-right">
            <a href="{{ route('page-article-detail', $item->slug) }}" class="btn btn-primary">Read more</a>
        </div>
    </div>
</div>
