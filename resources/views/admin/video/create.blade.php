@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">新增一个视频 {{-- {{phpinfo()}} --}}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                </div>
                <form action="{{ url('admin/video') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="image" type="file" value="选择图片">封面</input>
                    <br>
                    <input name="video" type="file" value="选择视频">视频</input>
                    <br>
                    <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题">
                    <br>
                    <textarea name="description" rows="10" class="form-control" required="required" placeholder="请输入内容"></textarea>
                    <br>
                    <select name="bucket">
                       @foreach($buckets as $bucket)
                            <option value="{{$bucket->name}}">{{$bucket->description}}</option>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn btn-lg btn-info">新增视频</button>
                    {{--<input type="submit" value="新增视频"/>--}}

                </form>
            </div>
        </div>
    </div>
</div>

@endsection