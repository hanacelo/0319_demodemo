@extends('layouts.app')

@section('content')
<h1>詳細確認</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>タイトル</th>
      <th>内容</th>
      <th>作成日</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $post->post_title }}</td>
      <td>{{ $post->post_desc }}</td>
      <td>{{ $post->created_at }}</td>
    </tr>
  </tbody>
</table>
<td><a href="{{ url('/') }}" type="button" class="btn btn-primary">戻る</a></td>
@endsection