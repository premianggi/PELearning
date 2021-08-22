<div class="panel panel-info">
    <div class="panel-header list-group-item" style="text-align: center"><b>Popular</b></div>
    <div class="panel-body">
        @foreach ($polulars as $popular)
            <a href="{{ route('forumslug', $popular->slug) }}"
                class="list-group-item"><code>{{ $popular->title }}</code></a>
        @endforeach
    </div>
</div>
