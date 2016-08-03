<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Video;
use Illuminate\Support\Facades\View;

class VideoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.video.index')->withVideos(Video::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.video.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$title = $request->input('title');
		$source = $request->input('source');
		$description = $request->input('description');
		$video = new Video;
		$video->title = $title;
		$video->description = $description;
		$video->videourl = $source;
        $video->imgurl = "http://www.yn.xinhuanet.com/auto/2015-07/16/134419408_14370551106431n.jpg";
        if ($video->save())
        {
            return redirect('admin/video');
        }else{
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('admin/video/edit')->withVideo(Video::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
        $video = Video::find($id);
        $video->title =  $request->get('title');
        $video->description =  $request->get('description');
        if ($video->save()) {
            return redirect('admin/video');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Video::find($id)->delete();
        return redirect('admin/video');
	}

}
