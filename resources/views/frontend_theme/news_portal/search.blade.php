@extends('frontend_theme.news_portal.front_layout.app')

@section('styles')
<style>
.topnav {
  background-color: #d72924;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

/* #exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
} */

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
  color: red;
}

#exTab1 ul
{
    list-style-type: none;
  margin-right: 20px;
  padding: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
</style>
@endsection

@section('content')

<section id="content">
    <div class="content-wrap">


        <div class="container clearfix">

            
            


            <div class="row">
                <div class="col-lg-8 bottommargin">

                    <div class="row col-mb-50">


                        <div class="body-position-2" style="margin-top: 20px;">
                            <div class="col-12" style="margin-bottom: 20px;">

                                <div class="fancy-title title-border">
                                    <h3>Search Result..</h3>
                                </div>

                                <div class="row posts-md col-mb-30">
                                    @foreach ($search_news as $post)
                                    <div class="entry col-sm-6 col-xl-4">
                                        <div class="grid-inner">
                                            <div class="entry-image">
                                                <a href="{{route('news.details',$post->slug)}}"><img src="{{asset('uploads/postphoto/'.$post->image)}}" alt="Image"></a>
                                            </div>
                                            <div class="entry-title title-xs nott">
                                                <h3><a href="{{route('news.details',$post->slug)}}">{{$post->title}}</a></h3>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-calendar3"></i> {{$post->created_at->diffForHumans()}}</li>
                                                    <li></i>@foreach ($post->categories as $category)
                                                        <a href="{{route('categories.all',$category->parent->slug)}}">
                                                        {{$category->parent->name}} </a>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="entry-content">
                                                <p>{!!Str::limit($post->body, 100)!!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12" style="margin-top: 10px; margin-left: 50px;">
                                <img height="90" width="720" src="{{asset('assets/frontend/images/banner2.jpg')}}" alt="Ad">
                            </div>
                        </div>




                    </div>

                </div>

                @include('frontend_theme.news_portal.front_layout.vertical.sidebar')

            </div>

        </div>
    </div>
</section><!-- #content end -->

@endsection()

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    <script>
        function loadMoreData(page)
        {
            $.ajax({
                url: '?page=' +page,
                type: 'get',
                beforeSend: function()
                {
                    $(".ajax-load").show();
                }
            })
            .done(function(data){
                if(data.html == " ")
                {
                    $('.ajax-load').html('No More News Found');
                    return;
                }
                $('.ajax-load').hide();
                $('#more_news').append(data.html);
            })
            // .fail(function(jqXHR,ajaxOptions,throwError){
            //     alert("server naspd");
            // })
        }

        var page = 1;
        // function load_more_news()
        //         {
        //             page++;
        //             loadMoreData(page);
        //         }
        $(window).scroll(function(){
            var nav = $('#footer');

            if($(window).scrollTop() + $(window).height() == $(document).height())
            {
                page++;
                loadMoreData(page);
            }
        })
    </script>

    {{-- <script>
        $(document).ready(function(){

    fetchnews();

    function fetchnews()
    {
    //  var cat_id = document.getElementById("category_id").value;
    //  alert(cat_id);
    var urll = '{{ route('fetchnews',$category->id) }}';
    //urll = urll.replace(':id', data);
    $.ajax({
        type: "GET",
        url: urll,
        dtaType: "json",
        success: function(response)
        {

            $('#news_body').html('');
            // $.each(response.news[0], function(key, item){


                $('#news_body').html(response.news);
            //  });
        }
    });
    }
});
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.tab:first-child').addClass('active');
            $(".tab-pane:first-child").addClass("active");
        $(".tab").click(function () {
            $(".tab").removeClass("active");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).addClass("active");
        });
        });
    </script>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>


@endsection
