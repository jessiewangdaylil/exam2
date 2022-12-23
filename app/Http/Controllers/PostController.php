<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return '所有文章';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modes = ['recommend' => '編輯精選', 'season' => '當季商品', 'cp' => '超值商品'];
        $mode = 'cp';
        return view('posts.create', compact('modes', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        // dd($request->file('pic'));
        //return $request->all();
        //驗證示範
        // $validator = Validator::make($request->all(),[
        //     'title' => 'required | max:10',
        //     'desc' => 'required'
        // ]);

        // if($validator->fails()){
        //     return $validator;
        // }

        if ($request->hasFile('pic')) {
            $file = $request->file('pic'); //獲取UploadFile例項
            if ($file->isValid()) { //判斷檔案是否有效
                //$filename = $file->getClientOriginalName(); //檔案原名稱
                $extension = $file->getClientOriginalExtension(); //副檔名
                $fileName = time() . "." . $extension; //重新命名
                $data['pic'] = $fileName;
                $path = $file->storeAs('public/pic', $fileName); //儲存至指定目錄
            }
        }

        return '所有文章';
        //return $data;

        //return $request->all();
        //返回到index頁面
        //return redirect(url('posts/' . 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('posts');
    }
}