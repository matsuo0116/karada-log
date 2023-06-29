@extends('layout.header')

@section('title', 'お知らせ')

@section('content')
<main id="notification">
  <div class="wrapper">
<h2>お知らせ</h2>
@if($notifications->isEmpty())
<p>お知らせはありません</p>
@else
@foreach($notifications as $item) 
  <a href="{{ route('notification.read', ['id' => $item->id ]) }}">
  <p>{{ $item->comment->user->name }}さんがコメントしました
    <br><span>{{ $item->comment->text }}</span>
  </p>
</a>
@endforeach
@endif
</div>
</main>

@endsection