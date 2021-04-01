<h3 class="font-weight-normal mb-3">Top 5 Articles</h3>
<aside class="card">
    <ul class="list-group list-group-flush">
        @foreach($aside_articles as $item)
            <li class="list-group-item"><span class="badge badge-info mr-1">{{ $item->views }} views</span><a href="{{ route('page-article-detail', $item->slug) }}">{{ $item->title }}</a></li>
        @endforeach
    </ul>
    <a href="{{ route('page-article-list') }}" class="bg-light text-dark p-3 text-center">
        All articles
    </a>
</aside>
