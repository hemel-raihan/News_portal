
@foreach($sub_category->childs as $key => $sub)
<ul class="mzr-links">

    <li><a href="{{route('page',$sub->slug)}}">{{$sub->title}}</a>

    @if($item->childs->count()>0)
        @include('frontend_theme.default.front_layout.vertical.child', ['sub_category' => $sub])
    @endif

</li>

</ul>
@endforeach
