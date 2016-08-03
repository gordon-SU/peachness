@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>
			</div>
		</div>
	</div>
	@foreach($videos as $video )
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
				    <div class="panel-heading"><img src={{$video->imgurl}}></div>
				    <div CLASS="panel-info">{{$video->title}}.{{$video->description}}</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
@endsection
