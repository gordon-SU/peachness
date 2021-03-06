@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">编辑视频</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>编辑失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <form action="{{ url('admin/video/'.$video->id.'') }}" method="POST">
                            {{--{{ method_field('PUT') }}--}}
                            {{--{!! csrf_field() !!}--}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="_method" type="hidden" value="PUT">
                            <img  style="width: 150px; height: 150px;" src = "{{asset('uploads/'.$video->imgurl)}}">
                            <input name="file" type="file" />
                            <br>
                            <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题" value="{{ $video->title }}">
                            <br>
                            <input type="text" name="videourl" class="form-control" required="required" placeholder="请输入标题" value="{{ $video->videourl }}">
                            <br>
                            <textarea name="description" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $video->description }}</textarea>
                            <br>
                            <button class="btn btn-lg btn-info">更新视频</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection