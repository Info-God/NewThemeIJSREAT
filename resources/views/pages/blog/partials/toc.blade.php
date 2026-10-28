{{-- "On this page" links built from the article's h2 headings (App\Support\ArticleHtml). --}}
<ol class="toc-list">
    @foreach ($toc as $item)
        <li><a href="#{{ $item['id'] }}">{{ $item['text'] }}</a></li>
    @endforeach
</ol>
