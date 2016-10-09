
@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div id="myCarousel" class="carousel slide">
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    @foreach($videos as $key=>$video)
                        @if($key == 0)
                            <li data-target="#myCarousel" data-slide-to=$key class="active"></li>
                        @else
                            <li data-target="#myCarousel" data-slide-to=$key></li>
                        @endif
                    @endforeach
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    @foreach($banners as $key=>$video)
                        @if($key == 0)
                            <div class="item active">
                                @else
                                    <div class="item">
                                        @endif
                                        <img src="{{$video->imagePath()}}" dynsrc="{{$video->videoPath()}}">
                                        {{--<a href="{{$video->videoPath()}}">点击此处来播放视频文件</a>--}}
                                        <div class="carousel-caption" style="background-color:#000000;opacity: 0.5;left:0%;right:0%;bottom:0px;">
                                            <p>
                                                {{$video->description}}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                            <!-- 轮播（Carousel）导航 -->
                            <a class="carousel-control left" href="#myCarousel"
                               data-slide="prev">&lsaquo;</a>
                            <a class="carousel-control right" href="#myCarousel"
                               data-slide="next">&rsaquo;</a>
                </div>
            </div>

            @foreach($videos as $key=>$bucket)
                <div class="row">
                    <div class="col-md-12 col-xs-12 " style="padding-left: 0px;padding-right: 0px;
">
                        <div style="background-color: #fd8bbb"><h3> {{$bucket['bucket']->description}}</h3> </div>
                    </div>
                </div>

                <div class="row">
                @foreach($bucket['videos'] as $video)

                <div class="col-md-6 col-xs-6">
                <div class="panel">
                <div style=" margin:0px auto;cursor:pointer" onclick="goFullscreen('player{{$video->id}}')">
                    <a href="{{ url('/videoDetail/')}}/{{$video->id}}"><img  src="{{asset('images/play.png')}}" border="0"></a>
                {{--<img style="position:absolute;margin:auto; width:75px; height:75px;left:0;top:0;bottom:0;right:0; " src="{{asset('images/play.png')}}">--}}
                <p style="position: absolute;background-color:#ffffff; width:40px">热播</p>
                <div style="background-color:#000000;opacity:0.5; height:25px;"><p style="color:#ffffff">{{$video->description}}</p></div>
                </div>
                </div>

                </div>

                @endforeach
                </div>

            @endforeach

        </div>

    </div>

@endsection