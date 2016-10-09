<script type="text/javascript">
function goFullscreen(id) {
var element = document.getElementById(id);
if (element.requestFullScreen) {
element.requestFullScreen();
} else if (element.mozRequestFullScreen) {
element.mozRequestFullScreen();
} else if (element.webkitRequestFullScreen) {

element.webkitRequestFullScreen();
}
else if (element.msRequestFullscreen) {
element.msRequestFullscreen();
} else if (element.webkitRequestFullscreen) {

element.webkitRequestFullscreen();
} else {

alert("can not play");
}
}
</script>
@extends('app')
@section('content')
    <div class="container">
        <div class="row" onclick="goFullscreen('player{{$video->id}}')">
            <video poster="{{$video->imagePath()}}" width="100%" height="100" id="player{{$video->id}}">
                <source src="{{$video->videoPath()}}" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>

    </div>

@endsection