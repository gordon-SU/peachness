<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;


require '../vendor/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

use App\Bucket;

class Video extends Model {
    public function videoPath()
    {
        $accessKey = 'KBQS1guwt8wOIHl7LlqhFudQ0EreS_Qj6P6kb3ZN';
        $secretKey = 'pBiC8ySwoLwlbO7inv9Yzds2K-r1V6xTssPCQIHq';

        //初始化Auth状态
        $auth = new Auth($accessKey, $secretKey);

        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);

        
        $bucketName = $this->bucket;
        $bucketM = Bucket::where('name',$bucketName)->first();
        //你要测试的空间， 并且这个key在你空间中存在
        $key = $this->videourl;

        $baseUrl =  'http://'.$bucketM->domain.'/'.$key;
        $downloadUrl = $auth->privateDownloadUrl($baseUrl,3600);

        return $downloadUrl;

    }

    public function imagePath(){
        $accessKey = 'KBQS1guwt8wOIHl7LlqhFudQ0EreS_Qj6P6kb3ZN';
        $secretKey = 'pBiC8ySwoLwlbO7inv9Yzds2K-r1V6xTssPCQIHq';

        //初始化Auth状态
        $auth = new Auth($accessKey, $secretKey);

        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);

        
        $bucketName = $this->bucket;
        $bucketM = Bucket::where('name',$bucketName)->first();
        $baseUrl =  'http://'.$bucketM->domain.'/'.$this->imgkey;
        $downloadUrl = $auth->privateDownloadUrl($baseUrl,3600);

        return  $downloadUrl;

    }
}
