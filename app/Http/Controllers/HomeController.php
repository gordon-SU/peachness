<?php namespace App\Http\Controllers {
    use Illuminate\Http\Request;
    require_once  '../vendor/autoload.php';
    use Qiniu\Auth;
    use Qiniu\Storage\UploadManager;

    use App\Video;
    use App\Bucket;

    class HomeController extends Controller {

        /*
        |--------------------------------------------------------------------------
        | Home Controller
        |--------------------------------------------------------------------------
        |
        | This controller renders your application's "dashboard" for users that
        | are authenticated. Of course, you are free to change or remove the
        | controller as you wish. It is just here to get your app started!
        |
        */

        /**
         * Create a new controller instance.
         *
         * @return void
         */
//	public function __construct()
//	{
//		$this->middleware('auth');
//	}

        /**
         * Show the application dashboard to the user.
         *
         * @return Response
         */
        public function index()
        {
            $banners = Video::where('bucket','banner')->get();
            $videos = array();
            $buckets = Bucket::all();
            foreach ($buckets as $key => $bucket) {
                if (strpos($bucket->name, 'video') !== false ) {
                    $bucketVideos = Video::where('bucket',$bucket->name)->get();
                    $bucketAndVideos = array('bucket' => $bucket, 'videos' => $bucketVideos);
                    $videos[] = $bucketAndVideos;
                }
                
            }
            // return view('home')->withVideos($videos);
            return view('home')->with([
                        'banners'=> $banners,
                        'videos'=> $videos,
                    ]);
        }

        public function qiniu()
        {
            $bucket = 'devtest';
            $accessKey = 'KBQS1guwt8wOIHl7LlqhFudQ0EreS_Qj6P6kb3ZN';
            $secretKey = 'pBiC8ySwoLwlbO7inv9Yzds2K-r1V6xTssPCQIHq';
            $auth = new Auth($accessKey, $secretKey);
            $policy = array(
                'returnUrl' => 'http://127.0.0.1/demo/simpleuploader/fileinfo.php',
                'returnBody' => '{"fname": $(fname)}',
            );
            $upToken = $auth->uploadToken($bucket, null, 3600, $policy);
//            echo $upToken;
            return view('qiniu')->with('token',$upToken);
        }

        public function store(Request $request)
        {
//            $token = $request->input("token");
            // 需要填写你的 Access Key 和 Secret Key
            $accessKey = 'KBQS1guwt8wOIHl7LlqhFudQ0EreS_Qj6P6kb3ZN';
            $secretKey = 'pBiC8ySwoLwlbO7inv9Yzds2K-r1V6xTssPCQIHq';

            // 构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);

            // 要上传的空间
            $bucket = 'video01';

            // 生成上传 Token
            $token = $auth->uploadToken($bucket);

            $key = $request->input("key");
            $filePath = $request->file('file');

            $uploadMgr = new UploadManager();
            // 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            echo "\n====> putFile result: \n";
            if ($err !== null) {
                echo "==error:==";
                var_dump($err);
            } else {
                var_dump($ret);
            }

        }

    }
}
