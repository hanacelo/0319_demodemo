<?php

namespace App\Http\Controllers;


use App\Models\Post; //この行を上に追加
use App\Models\User;//この行を上に追加


use Illuminate\Support\Str; //画像追加処理のやつ

use Auth;//この行を上に追加
use Validator;//この行を上に追加
use Illuminate\Http\Request;




class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 全ての投稿を取得
        $posts = Post::get();
        
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
             $favo_posts = Auth::user()->favo_posts()->get();
             
              return view('posts',[
            'posts'=> $posts,
            'favo_posts'=>$favo_posts
            ]);
            
        }else{
            
            return view('posts',[
            'posts'=> $posts
            ]);
            
        }
        
        //画像アップローダー表示
        $posts = Auth::user();
    
        return view('img_upload',[
        'post'=>$post
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'post_title' => 'required|max:255',
            'post_desc' => 'required|max:255',
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $posts = new Post;
        $posts->post_title = $request->post_title;
        $posts->post_desc = $request->post_desc;
        $posts->img_url = $request->img_url;
        $posts->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $posts->save();
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * 詳細画面の表示
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('show', compact('post'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    // 画像アップロード処理
    public function upload(Request $request){

       // バリデーション 
        $validator = $request->validate( [
            'img' => 'required|file|image|max:2048', 
        ]);
    
        // 画像ファイル取得
        $file = $request->img;
    
        // ログインユーザー取得
        $user = Auth::user();
    
        if ( !empty($file) ) {
    
            // ファイルの拡張子取得
            $ext = $file->guessExtension();
    
            //ファイル名を生成
            $fileName = Str::random(32).'.'.$ext;
    
            // 画像のファイル名を任意のDBに保存
            $post->img_url = $fileName;
            $post->save();
    
            //public/uploadフォルダを作成
            $target_path = public_path('/uploads/');
    
            //ファイルをpublic/uploadフォルダに移動
            $file->move($target_path,$fileName);
    
        }else{
    
            return redirect('/home');
        }
    
        return redirect('/img');
    
    }
    
    
    
}

