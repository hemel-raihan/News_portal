
    <div class="grid-inner">
        <div class="entry-image">
            <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
        </div>
        <div class="entry-title title-xs nott">
            <h3><a href="{{route('news.details',$post->slug)}}">{{$post->title}}</a></h3>
        </div>
        <div class="entry-meta">
            <ul>
                <li><i class="icon-calendar3"></i> {{ $post->created_at->format('j-F-Y') }}</li>
                <li></i>@foreach ($post->categories as $category)
                    <a href="{{route('categories.all',$category->parent->slug)}}">
                    {{$category->parent->name}} </a>
                @endforeach
                </li>
            </ul>
        </div>
        {{-- <div class="entry-content">
            <p>{!!Str::limit($post->body, 100)!!}</p>
        </div> --}}
    </div>
