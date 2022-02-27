
    {{-- <div class="entry col-md-4" > --}}
        <div class="grid-inner row g-0" style="background: #eff3f4; padding-top: 10px;">
            <div class="col-md-3">
                <div class="entry-image-2">
                    <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" width="300" alt="Image"></a>
                </div>
            </div>
            <div class="col ps-3">
                <div class="entry-title">
                    <h4><a href="{{route('news.details',$post->slug)}}">{!!Str::limit($post->title, 50)!!}</a></h4>
                </div>
                <div class="entry-meta">
                    <ul>
                        <li><i class="icon-calendar3"></i> {{ $post->created_at->format('j-F-Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    {{-- </div> --}}

