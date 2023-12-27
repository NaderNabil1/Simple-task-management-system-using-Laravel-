<li class="lvl1 @if(Route::current()->getName() == 'home') active @endif"><a href="{{ url('/') }}">Home</a></li>
<li class="lvl1 @if(Route::current()->getName() == 'categories') active @endif"><a href="{{ Route('categories') }}">Collections</a></li>
{{-- @foreach($menuCategories as $menuCategory)
<li class="lvl1 @if($menuCategory->subs->Count() > 0) parent dropdown @endif">
    <a href="{{ Route('subcategories', $menuCategory->slug) }}">{{ $menuCategory->title }} @if($menuCategory->subs->Count() > 0) <i class="an an-angle-down"></i> @endif</a>
    @if($menuCategory->subs->Count() > 0)
    <ul class="dropdown">
        @foreach($menuCategory->subs as $menuCategory->sub)
        <li><a href="{{ Route('products', $menuCategory->sub->slug) }}" class="site-nav">{{ $menuCategory->sub->title }}</a></li>
        @endforeach
    </ul>
    @endif
</li>
@endforeach --}}
<li class="lvl1  @if(Route::current()->getName() == 'blog' || Route::current()->getName() == 'show-blog') active @endif"><a href="{{ Route('blog') }}">Blog</a></li>
<li class="lvl1  @if(Route::current()->getName() == 'events' || Route::current()->getName() == 'show-event') active @endif"><a href="{{ Route('events') }}">Events</a></li>
