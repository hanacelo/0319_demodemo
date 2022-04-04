<!-- resources/views/posts.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            投稿フォーム
        </div>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム -->
        <form action="{{ url('posts') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- 投稿のタイトル -->
            <div class="form-group">
                投稿のタイトル
                <div class="col-sm-6">
                    <input type="text" name="post_title" class="form-control">
                </div>
            </div>
            <!-- 投稿の本文 -->
            <div class="form-group">
                投稿の本文
                <div class="col-sm-6">
                    <input type="text" name="post_desc" class="form-control">
                </div>
            </div>
        
            <div class="form-group">
                画像の選択
                <input id="fileUploader" type="file" name="img" accept='image/' enctype="multipart/form-data" multiple="multiple" required autofocus>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- 全ての投稿リスト -->
    
@endsection
git fetch
                                   <div>{{ $post->user->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div></div>
                                </td>
                               <td><a href="{{ route('show', ['id'=>$post->id]) }}" class="btn btn-primary">詳細</a></td>
 				<!-- お気に入りボタン -->
                                <td class="table-text">
                                    <form action="{{ url('post/'.$post->id) }}" method="POST">
                                    	{{ csrf_field() }}
                                    	<button type="submit" class="btn btn-danger">
                                    	    お気に入り
                                    	</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>		
    @endif