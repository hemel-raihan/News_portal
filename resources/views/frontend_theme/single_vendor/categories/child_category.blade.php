

<li><a href="{{route('shops',$child_category->slug)}}">{{ $childCategory->name }}</a>
    <ul>
        @if ($child_category->categories)
            @foreach ($child_category->categories as $childCategory)
                @include('frontend_theme.single_vendor.categories.child_category', ['child_category' => $childCategory])
            @endforeach
        @endif
    </ul>
</li>
