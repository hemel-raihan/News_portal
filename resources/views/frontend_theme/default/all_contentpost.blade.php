@extends('frontend_theme.default.front_layout.index')


@section('clg', '| '.$title->name)



@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/jquery.dataTables.min.css')}}" />

<style>
/* *,
*::before,
*::after {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
} */

/* body {
  font-family: "Quicksand", sans-serif;
  display: grid;
  place-items: center;
  height: 100vh;
  background: #7f7fd5;
  background: linear-gradient(to right, #91eae4, #86a8e7, #7f7fd5);
} */

.containerrr {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  max-width: 1200px;
  margin-block: 2rem;
  gap: 2rem;
}

img {
  max-width: 100%;
  display: block;
  object-fit: cover;
}

.card {
  display: flex;
  flex-direction: column;
  width: clamp(20rem, calc(20rem + 2vw), 22rem);
  overflow: hidden;
  box-shadow: 0 .1rem 1rem rgba(0, 0, 0, 0.1);
  border-radius: 1em;
  background: #ECE9E6;
background: linear-gradient(to right, #FFFFFF, #ECE9E6);

}



.card__body {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: .5rem;
}


.tag {
  align-self: flex-start;
  padding: .25em .75em;
  border-radius: 1em;
  font-size: .75rem;
}

.tag + .tag {
  margin-left: .5em;
}

.tag-blue {
  background: #56CCF2;
background: linear-gradient(to bottom, #2F80ED, #56CCF2);
  color: #fafafa;
}

.tag-brown {
  background: #D1913C;
background: linear-gradient(to bottom, #FFD194, #D1913C);
  color: #fafafa;
}

.tag-red {
  background: #cb2d3e;
background: linear-gradient(to bottom, #ef473a, #cb2d3e);
  color: #fafafa;
}

.card__body h4 {
  font-size: 1.5rem;
  text-transform: capitalize;
}

.card__footer {
  display: flex;
  padding: 1rem;
  margin-top: auto;
}

.user {
  display: flex;
  gap: .5rem;
}

.user__image {
  border-radius: 50%;
}

.user__info > small {
  color: #666;
}
</style>

@endsection



@section('frontscripts')

{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
<script src="{{ asset('frontend/js/jquery.dataTables.min.js') }}"></script>
{{-- print --}}
<script type="text/javascript">
    function print_content() {
        var html_content = $("#printable_area").html();

        newwindow = window.open();
        newdocument = newwindow.document;
        newdocument.write(html_content);
        newdocument.close();

        newwindow.print();

        return false;
    }
</script>

@endsection

@section('bodycontent')
<div class="accessibilityDesign" id="accessibilityDesign" title="লিখার রঙ ও সাইজ পরিবর্তন করুন">
    <div class="textSize">
        <span>Text size</span>
        <span title="Small font" class="font-small" onclick="fontSize(12)">A</span>
        <span title="Medium font" class="font-medium" onclick="fontSize(20)">A</span>
        <span title="Large font" class="font-large" onclick="fontSize(25)">A</span>
    </div>
    <div class="textBg">
        <span>Color</span>
        <span title="Bancground white text black" class="color-1" onclick="fontBgColor('fff','000')">C</span>
        <span title="Bancground blue text black" class="color-2" onclick="fontBgColor('cfe5fc','21205f')">C</span>
        <span title="Bancground black text yellow" class="color-3" onclick="fontBgColor('2f2f2f','ffff00')">C</span>
        <span title="Bancground grey text blue" class="color-4" onclick="fontBgColor('f7f3d6','000066')">C</span>
    </div>
</div>

<script>
    function fontSize(size) {
        var Size = size;
        $("#left-content").css({ "font-size": Size + "px" });
        $("#left-content div").css({ "font-size": Size + "px" });
        $("#left-content p").css({ "font-size": Size + "px" });
        $("#left-content a").css({ "font-size": Size + "px" });
        $("#left-content h1").css({ "font-size": Size + "px" });
        $("#left-content h2").css({ "font-size": Size + "px" });
        $("#left-content h3").css({ "font-size": Size + "px" });
        $("#left-content h4").css({ "font-size": Size + "px" });
        $("#left-content h5").css({ "font-size": Size + "px" });
        $("#left-content h6").css({ "font-size": Size + "px" });
        $("#left-content span").css({ "font-size": Size + "px" });
    }
    function fontBgColor(bgColor, fontColor) {
        var FontColor = fontColor;
        var BgColor = bgColor;
        $("#left-content").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content div").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content a").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content p").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content span").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h1").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h2").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h3").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h4").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h5").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
        $("#left-content h6").css({ "background-color": "#" + BgColor, color: "#" + FontColor });
    }
</script>
<div class="{{Request::is('all-teachers-info') ? 'sixteen' : 'twelve'}} columns" id="left-content">
    <div id="div-view-pagination-moedu_office_order">
        <div style="float: right;" id="print_btn_div"><img src="{{ asset('frontend/images/print_btn.png') }}" style="cursor: pointer;" onclick="print_content();" width="24" title="প্রিন্ট" /></div>
        <div id="printable_area">


            @isset($teamcategoryposts)
            <div class="containerrr">
                @foreach ($teamcategoryposts as $key => $teamcategorypost)
                <div class="card">
                  <div class="card__header">
                    <img src="{{asset('uploads/teamphoto/'.$teamcategorypost->image)}}" alt="card__image" class="card__image" width="600">
                  </div>
                  <div class="card__body">
                    <a href="{{route('team.details',$teamcategorypost->id)}}"> <h4>{{$teamcategorypost->name}}</h4></a>
                    <span class="tag tag-blue">{{$teamcategorypost->designation}}</span>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi perferendis molestiae non nemo doloribus. Doloremque, nihil! At ea atque quidem!</p> --}}
                  </div>
                  {{-- <div class="card__footer">
                    <div class="user">
                      <img src="https://i.pravatar.cc/40?img=1" alt="user__image" class="user__image">
                      <div class="user__info">
                        <h5>Jane Doe</h5>
                        <small>2h ago</small>
                      </div>
                    </div>
                  </div> --}}
                </div>
                @endforeach
              </div>
            @else

            <hr />
            <table class="bordered" id="example">
                <thead>
                    <tr>
                        <th width="10%">ক্রমিক</th>
                        <th width="60%">শিরোনাম</th>
                        <th width="20%">প্রকাশের তারিখ</th>
                        <th width="10%">ডাউনলোড</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contentcategoryposts as $key=>$contentcategorypost)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <a href="{{route('content.details',$contentcategorypost->id)}}">{{ \Illuminate\Support\Str::limit($contentcategorypost->title, 80, $end='...') }}</a>
                        </td>
                        <td>{{ $contentcategorypost->created_at->format('Y-m-d') }}</td>

                        <td>
                            <div>
                                <a href="{{ asset('uploads/contentfiles/'.$contentcategorypost->files) }}" title="Maternity Leave 696.pdf">
                                    <img src="{{ asset('frontend/images/pdf2.png') }}" style="height: 20px; width: auto;" alt="Maternity Leave 696.pdf" class="file-icon" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br />

            @endisset()







            <style>
                #example_length {
                    display: none;
                }
                #example_filter {
                    margin-bottom: 15px;
                }
            </style>
            <script>
                $(document).ready(function () {
                    $("#example").dataTable({
                        ordering: false,
                    });
                });
            </script>
        </div>
    </div>

    <div id="share-buttons" style="clear: both;">
        <br />
        <p>
            <b>Share with :</b>
        </p>

        <!-- Facebook -->
        <a
            href="#" target="_blank"
        >
            <img src="{{ asset('frontend/images/facebook.png') }} " alt="Facebook " />
        </a>
        <a
            href="#"
            target="_blank"
        >
            <img src="{{ asset('frontend/images/twitter.png') }}" alt="Facebook" />
        </a>
    </div>
</div>
@endsection
