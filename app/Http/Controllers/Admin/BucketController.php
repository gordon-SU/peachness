<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Bucket;

class BucketController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.bucket')->withBuckets(Bucket::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$name = $request->input('name');
		$description = $request->input('description');
		$domain = $request->input('domain');
		if (!empty($name) && !empty($description)) {
			$bucket = new Bucket();
			$bucket->name = $name;
			$bucket->description = $description;
			$bucket->domain = $domain;
			if ($bucket->save()) {
				return redirect('admin/bucket');
			}else
			{
				echo "保存失败";
			}
		}else
		{
			echo "名字或者描述不能为空";
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Bucket::find($id)->delete();
        return redirect('admin/bucket');
	}

}
