@extends('layouts.app')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table"> 
    <caption>buckets</caption> 
    <thead> 
        <tr> 
            <th>名称</th> 
            <th>描述</th> 
            <th>域名</th> 
        </tr> 
    </thead> 
    <tbody> 
    @foreach($buckets as $bucket)
    	<tr> 
            <td>{{$bucket->name}}</td> 
            <td>{{$bucket->description}}</td>
            <td>{{$bucket->domain}}</td>
            <td>
            <form action="{{ url('admin/bucket/'.$bucket->id) }}" method="POST" style="display: inline;">
                                {{--{{ method_field('DELETE') }}--}}
                                {{--{{ csrf_field() }}--}}
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
            </td> 
        </tr>
    @endforeach
    </tbody> 
</table>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<form action={{ url('admin/bucket') }} method="POST" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="text" name="name" placeholder="请输入七牛bucket名称">
			<input type="text" name="description" placeholder="请输入描述">
            <input type="text" name="domain" placeholder="请输入地址">
			<input type="submit" name="" value="新增">
		</form>
		</div>
	</div>
            </div>
        </div>
    </div>
@endsection