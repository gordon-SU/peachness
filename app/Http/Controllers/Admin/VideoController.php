<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Video;
use Illuminate\Support\Facades\View;
// use Input;
// use Request;

require_once  '../vendor/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

use App\Bucket;

class VideoController extends Controller {

    public $uploadVideoName;

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
		return view('admin.video.create')->withBuckets(Bucket::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        //========== 获取token
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = 'KBQS1guwt8wOIHl7LlqhFudQ0EreS_Qj6P6kb3ZN';
        $secretKey = 'pBiC8ySwoLwlbO7inv9Yzds2K-r1V6xTssPCQIHq';

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        $uploadMgr = new UploadManager();

        // 要上传的空间
        // $bucket = 'video01';
        $bucket = $request->get('bucket');
        // echo $bucket;
        // exit();

        // 生成上传 Token
        $token = $auth->uploadToken($bucket, null, 3600, null);

        //============= 上传图片
        if(!$request->hasFile('image') || !$request->hasFile('video')){
            exit('封面或视频为空！');
        }
        $files = $request->files->all();
        $names = array();
        foreach ($files as $file) {
            $names[] = $file;
        }
       echo print_r($names, true);
        $file = $request->file('image');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('图片文件不存在！');
        }
        $imageFileName = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();
        $savePath = 'cover/'.$imageFileName;
        Storage::disk('uploads')->put($savePath, file_get_contents($file->getRealPath()));
        list($ret, $err) = $uploadMgr->putFile($token, $imageFileName, $file);
        if ($err !== null) {
           var_dump($err);
        } 
        //
//================= 上传视频
        $videoFile = $request->file('video');
        if(!$videoFile->isValid()){
            exit('视频文件不存在！');
        }
        $key = md5(time().rand(0,10000)).'.'.$videoFile->getClientOriginalExtension();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $videoFile);
        if ($err !== null) {
           var_dump($err);
        } else {
//            var_dump('http://obqn513dp.bkt.clouddn.com/'.$ret['key']);
        }
//==================== 保存到数据库
        //
		$title = $request->input('title');
		$source = $request->input('source');
		$description = $request->input('description');
		$video = new Video;
		$video->title = $title;
		$video->description = $description;
		$video->videourl = $key;
        $video->videokey = $key;
        $video->imgurl = $savePath;
        $video->imgkey = $imageFileName;
        $video->bucket = $bucket;
        if ($video->save())
        {
            return redirect('admin/video');
        }else{
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }

	}
	public function upload(Request $request)
    {
        if(!$request->hasFile('file')){
            exit('上传视频为空！');
        }
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = 'KBQS1guwt8wOIHl7LlqhFudQ0EreS_Qj6P6kb3ZN';
        $secretKey = 'pBiC8ySwoLwlbO7inv9Yzds2K-r1V6xTssPCQIHq';

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucket = 'video01';

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        $file = $request->file('file');
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        $key = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();

        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);
        if ($err !== null) {
            echo($err);
        } else {
            $this->uploadVideoName = $key;
//            return view('admin.video.create');
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

	public function uploadImage(Request $requset)
    {
        return redirect('admin/video');
    }

}
