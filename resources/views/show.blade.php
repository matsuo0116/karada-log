@extends('layout.header')

@section('title', 'HOME')

@section('content')

<main id="detail">
  <div class="wrapper">
  <div class="content">
    <div class="icon">
      @if($log->user->avatar == null)
      <img class="prof_img" src="/storage/uploads/no_image.png" alt="">
      @else
      <img class="prof_img" src="{{ asset($log->user->avatar) }}" alt="">
      @endif
    </div>
    <div>
      <h2 class="user_name">
        <p>{{ $log->user->name }}</p>
      </h2>
        @if($log->weight && $log->fat_per )
                  
                  <p class="log_body_info">体重:{{ $log->weight }}kg / 体脂肪:{{ $log->fat_per }}%</p>

                  @endif
        <ul class="training_list">
          @foreach($log->types as $type)
          <li>
            {{ $type->name }}
            {{ ($type->pivot->weight) == 0 ? '' : ($type->pivot->weight).'kg' }}
            {{ $type->pivot->count }}回
            {{ $type->pivot->sets }}セット
          </li>

          @endforeach
          @foreach($log->exercises as $exercise)
          <li>
            {{ $exercise->type->name }}
            {{ $exercise->time }}分
            {{ $exercise->distance }}km
          </li>
          @endforeach
        </ul>
        <p class="log_comment">{{ $log->comment }}</p>
    </div>
  </div>

  

    <div class="sub_info">
      <p class="log_time">
        {{ $log->created_at->format(('Y年m月d日 G時i分')) }}
      </p>
      @auth
      <div id="like">
        <form action="{{ route('like.add', ['id' => $log->id ]) }}" method="post">
          @csrf
          <button type="submit" class="like-button {{ $my_like[$log->id] ? 'like' : 'dislike' }}">いいね♡</button>
                  <span>{{ $like_counts }}</span>
        </form>
      </div>
      @endauth
      
    </div>

    
  <div class="comment_area">
  @auth
    <form action="{{ route('log.comment', ['id' => $log->id ]) }}" method="POST">
      @csrf
      <input type="text" name="comment" placeholder="応援コメントを入力"  class="comment_form">
      <input class="green_btn" type="submit" value="送信">
    </form>
    @endauth
    <ul class="comment_list">
    @foreach($log->comments as $comment)
    <li>
      <div class="user_img">
        @if($comment->user->avatar == null)
        <img class="prof_img" src="/storage/uploads/no_image.png" alt="">
        @else
        <img class="prof_img" src="{{ asset( $comment->user->avatar ) }}" alt="">
        @endif
      </div>
      <div>
        <p class="user_name">{{ $comment->user->name }}</p>
        <p>{{ $comment->text }}</p>
      </div>
      </li>
    @endforeach
    </ul>    
  </div>
  </div>
</main>

@endsection