@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">qiniu test</div>
                </div>
            </div>
            <form action="{{ url('/uptoken') }}" method="post" enctype="multipart/form-data" >
                <table>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <tr>
                        <td>Upload Token(<a href="">生成Token的代码</a>):</td>
                        <td><input id="id_token" name="token" type="text" value={{$token}}/></td>
                    </tr>
                    <tr>
                        <td>上传文件名:</td>
                        <td><input id="id_key" name="key" type="text" value="test.png"/></td>
                    </tr>
                    <tr>
                        <td>上传后文件外链(<a href="http://developer.qiniu.com/docs/v6/api/overview/dn/security.html">外链规则</a>):</td>
                        <td><a id="id_url" href=""/></a></td>
                    </tr>
                    <tr>
                        <td>文件（小于4MB）:</td>
                        <td><input id="id_file" name="file" type="file" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="上传"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection