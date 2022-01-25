<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Content;

class MainController extends Controller
{
    public $cacheName = 'HomeCache';

    /**
     * Display a listing of the data.
     *
     * @return View
     */
    public function index()
    {
        return view('index', ['data'=>$this->getListData()]);
    }

    /**
     * Store a newly created data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate post data
        $validator = Validator::make($request->all(), ['data'=>'required']);
        if ($validator->fails() || !is_array($request->data)) {
            // Output error
            return response()->json([
                'status' => false,
                'message' => 'Data is invalid',
            ]);
        }

        $no = 0;
        $insertData = [];

        foreach ($request->data as $k=>$v) {
            $no++;
            $insertData[] = ['priority'=>$no,'title'=>$v['title'], 'colour'=>$v['colour']];
        }

        Content::query()->delete();
        $content = Content::insert($insertData);

        Cache::forget($this->cacheName);
        $this->getListData();

        // Output reponse
        return response()->json([
            'status' => true,
            'message' => 'Updated',
        ]);
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit()
    {
        return view('edit', ['data'=>$this->getListData()]);
    }

    // Return the content data
    public function getListData()
    {
        $HomeCache = Cache::get($this->cacheName);

        if (!$HomeCache) {
            $data = Content::select('priority','title','colour')->orderBy('priority','asc')->get();
            if ($data->isNotEmpty()) {
                // Cache the data if not empty to prevent data not refresh after running the seeder command
                Cache::put($this->cacheName, $data, now()->addMinutes(5));
            }
        } else {
            $data = $HomeCache;
        }

        return $data;
    }
}
