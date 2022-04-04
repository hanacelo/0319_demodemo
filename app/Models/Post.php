<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Userテーブルとのリレーション （従テーブル側）
     public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    use HasFactory;
    
     // Userテーブルとの多対多リレーション
     public function favo_user() {
        return $this->belongsToMany('App\Models\User');
    }
    
    public function favo($post_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $post = Post::find($post_id);
        
        //リレーションの登録
        $post->favo_user()->attach($user);
        
        return redirect('/');
        
    }
    
}
