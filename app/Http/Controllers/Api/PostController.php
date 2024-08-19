<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Throwable;
class PostController extends Controller
{

    private function makeJSON($status,$data,$msg)
    {
        //確保中文不會變Unicode
        return response()->json(['status'=>$status,'data'=>$data,'message'=>$msg])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::get();
        if(isset($posts) && count($posts) > 0){
            $data=['posts'=>$posts];
            return $this->makeJson(1,$data,null);
        }else{
            return $this->makeJson(0,null,'找不到任何文章');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=['title'=>$request->title,'content'=> $request->content];
        $post=Post::create($input);
        if(isset($post)){
            $data=['post'=>$post];
            return $this->makeJSON(1,$data,'新增文章成功');
        }else{
            return $this->makeJSON(0,null,'新增文章失敗');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        if(isset($post)){
            $data=['post'=>$post];
            return $this->makeJSON(1,$data,null);
        }else{
            return $this->makeJSON(0,null,'找不到該文章');
        }
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
        try{
            $post=Post::findOrFail($id);
            $post->title=$request->title;
            $post->content=$request->content;
            $post->save();

        }catch (Throwable $e){
            //更新失敗
            $data=['post'=>$post];
            return $this->makeJSON(0,null,'更新文章失敗');
        }

        $data=['post'=>$post];
        return $this->makeJSON(1,$data,'更新文章成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $post = Post::findOrFail($id);
            $post->delete();
        }catch(throwable $e){
            return $this->makeJSON(0,null,'刪除文章失敗');
        }

        return $this->makeJSON(1,null,'刪除文章成功');
    }
}
