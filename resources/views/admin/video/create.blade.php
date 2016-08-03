@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">新增一篇文章</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                </div>
                {{--<form method="post" enctype="multipart/form-data" name="upform">--}}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    {{--<table border=0 cellspacing=0 cellpadding=0 align=center width="100%">--}}
                        {{--<tr>--}}
                            {{--<td width=55 height=20 align="center"><input type="hidden" name="MAX_FILE_SIZE" value="2000000">文件： </TD>--}}
                            {{--<td height="16">--}}
                                {{--<input name="file" type="file" />--}}

                                {{--<input type="submit" name="submit" value="Submit" />--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--</table>--}}
                {{--</form>--}}

                <form id="myForm" action="http://112.74.96.226:8080/dh-web/common/uploadPicUrl.do" method="post">
                    <input name="file" type="file" />
                    <input type="submit" value="Submit" />
                </form>

                <form action="{{ url('admin/video') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题">
                    <br>
                    <input type="text" name="source" class="form-control" required="required" placeholder="请输入视频源">
                    <br>
                    <textarea name="description" rows="10" class="form-control" required="required" placeholder="请输入内容"></textarea>
                    <br>
                    <button class="btn btn-lg btn-info">新增视频</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection