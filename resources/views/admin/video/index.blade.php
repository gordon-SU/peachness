@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">视频管理</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                    @endif

                    <a href="{{ url('admin/video/create') }}" class="btn btn-lg btn-primary">新增</a>

                        @foreach ($videos as $video)
                            <hr>
                            <div class="article">
                                <h4>{{ $video->title }}</h4>
                                <div class="content">
                                    <p>
                                        {{ $video->description }}
                                    </p>
                                    <img  style="width: 150px; height: 150px;" src="{{ asset('uploads/'.$video->imgurl)}}">
                                    <video width="320" height="240" controls="controls">
                                        <source src="{{$video->videoPath()}}" type="video/mp4" />
                                        <source src="movie.ogg" type="video/ogg" />
                                        <source src="movie.webm" type="video/webm" />
                                        <object data="movie.mp4" width="320" height="240">
                                            <embed src="movie.swf" width="320" height="240" />
                                        </object>
                                    </video>
                                </div >
                            </div>
                            <a href="{{ url('admin/video/'.$video->id.'/edit') }}" class="btn btn-success">编辑</a>
                            <form action="{{ url('admin/video/'.$video->id) }}" method="POST" style="display: inline;">
                                {{--{{ method_field('DELETE') }}--}}
                                {{--{{ csrf_field() }}--}}
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
