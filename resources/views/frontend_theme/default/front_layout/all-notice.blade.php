@extends('frontend_theme.default.front_layout.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/jquery.dataTables.min.css')}}" />
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
<div class="twelve columns" id="left-content">
    <div id="div-view-pagination-moedu_office_order">
        <div style="float: right;" id="print_btn_div"><img src="{{ asset('frontend/images/print_btn.png') }}" style="cursor: pointer;" onclick="print_content();" width="24" title="প্রিন্ট" /></div>
        <div id="printable_area">

            <h3>Notice</h3>
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
                    @foreach($notices as $key=>$notice)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <a href="{{ route('notice.details',$notice->id) }}">{{ \Illuminate\Support\Str::limit($notice->title, 80, $end='...') }}</a>
                        </td>
                        <td>{{ $notice->created_at->format('Y-m-d') }}</td>

                        <td>
                            <div>
                                <a href="{{ asset('uploads/files/'.$notice->files) }}" title="Maternity Leave 696.pdf">
                                    <img src="{{ asset('frontend/images/pdf2.png') }}" style="height: 20px; width: auto;" alt="Maternity Leave 696.pdf" class="file-icon" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
            <p>
                আ্কাইভ <a class="archive" href="#"><u>ক্লিক করুন</u> </a>
            </p>
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
