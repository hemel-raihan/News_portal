            @php
            $data = [];
            @endphp
            @foreach($single_category->childrenRecursive as $key => $subcat)
            @foreach ($subcat->posts()->paginate(1) as $news)
            @if ($news->status == 1)
            @php
            $data[] = $news;
            @endphp
            @endif
            @endforeach
            @endforeach


            @foreach ($data as $news)
            <div class="posts-md">
                <div class="entry row mb-5">
                    <div class="col-md-3">
                        <div class="entry-image">
                            <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$news->image)}}" alt="Image"></a>
                        </div>
                    </div>
                    <div class="col-md-9 mt-3 mt-md-0">
                        <div class="entry-title title-sm nott">
                            <h3><a href="{{route('news.details',$post->slug)}}">{{$news->title}}</a></h3>
                        </div>
                        <div class="entry-meta">
                            <ul>
                                <li><i class="icon-calendar3"></i> {{ $news->created_at->format('j-F-Y') }}</li>
                                <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 21</a></li>
                                <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                            </ul>
                        </div>
                        <div class="entry-content">
                            <p class="mb-0">{!!Str::limit($news->body, 100)!!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
