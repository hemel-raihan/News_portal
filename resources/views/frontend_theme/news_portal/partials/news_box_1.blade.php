{{-- <div class="posts-md">
    <div class="entry row mb-5">
        <div class="col-md-3">
            <div class="entry-image">
                <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
            </div>
        </div>
        <div class="col-md-9 mt-3 mt-md-0">
            <div class="entry-title title-sm nott">
                <h3><a href="{{route('news.details',$post->slug)}}">{{$post->title}}</a></h3>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> {{ $post->created_at->format('j-F-Y') }}</li>
                    <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 21</a></li>
                    <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                </ul>
            </div>
            <div class="entry-content">
                <p class="mb-0">{!!Str::limit($post->body, 100)!!}</p>
            </div>
        </div>
    </div>
</div> --}}


<div class="entry col-md-6" >
    <div class="grid-inner row g-0" style="background: #eff3f4; padding-top: 10px; padding-bottom: 10px;">
        <div class="col-md-3">
            <div class="entry-image-2">
                <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
            </div>
        </div>
        <div class="col ps-3">
            <div class="entry-title">
                <h4><a href="{{route('news.details',$post->slug)}}">{{$post->title}}</a></h4>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i> {{ $post->created_at->format('j-F-Y') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
