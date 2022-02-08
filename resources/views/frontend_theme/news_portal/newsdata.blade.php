
@foreach ($data as $catdata)
@foreach ($catdata as $cat)
<div class="posts-md">
    <div class="entry row mb-5">
        <div class="col-md-3">
            <div class="entry-image">
                <a href="#"><img src="{{asset('uploads/postphoto/'.$cat->image)}}" alt="Image"></a>
            </div>
        </div>
        <div class="col-md-9 mt-3 mt-md-0">
            <div class="entry-title title-sm nott">
                <h3><a href="blog-single.html">{{$cat->title}}</a></h3>
            </div>
            <div class="entry-meta">
                <ul>
                    <li><i class="icon-calendar3"></i>{{$cat->created_at}}</li>
                    <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 21</a></li>
                    <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                </ul>
            </div>
            <div class="entry-content">
                <p class="mb-0"></p>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach

